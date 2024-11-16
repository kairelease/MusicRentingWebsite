<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    # Validate helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";

    //to check if all input filed are filled
    if (isset($_POST['instrument_name'])     && 
        isset($_POST['instrument_desc'])     && 
        isset($_POST['instrument_owner'])    &&
        isset($_POST['instrument_category']) &&
        isset($_FILES['instrument_cover'])   &&
        isset($_FILES['file'])) {

        //get data from post request and store all in var
        $title = $_POST['instrument_name'];
        $desc = $_POST['instrument_desc'];
        $owner = $_POST['instrument_owner'];
        $category = $_POST['instrument_category'];

        //making url data format
        $user_input = 'title='.$title.'&category_id='.$category.
                      '&desc='.$desc.'&owner_id='.$owner;

        //simple form validation
        $text = "Title";
        $location ="../add-instrument.php";
        $ms = "error";
        is_empty($title, $text, $location, $ms, $user_input);

        $text = "Description";
        $location ="../add-instrument.php";
        $ms = "error";
        is_empty($desc, $text, $location, $ms, $user_input);

        $text = "Instrument Owner";
        $location ="../add-instrument.php";
        $ms = "error";
        is_empty($owner, $text, $location, $ms, $user_input);

        $text = "Category";
        $location ="../add-instrument.php";
        $ms = "error";
        is_empty($category, $text, $location, $ms, $user_input);
        
        # instrument cover upload process
        $allowed_image_exs = array("jpg", "jpeg", "png");
        $path = "cover";
        $instrument_cover = upload_file($_FILES['instrument_cover'], $allowed_image_exs, $path);

        # if eeror occured while uploading the book cover

        
        # if error occured while uploading the cover
        if ($instrument_cover['status'] == "error") {
            $em = $instrument_cover['data'];

            # redirect to '../add-instrument.php' and passing error message & user_input
            header("Location: ../add-instrument.php?error=$em&$user_input");
            exit;
        } else {
            # file upload process
            $allowed_file_exs = array("pdf", "docx", "pptx");
            $path = "files";
            $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

            # if error occured while uploading the file
            if ($book_cover['status'] == "error" || $file['status'] == "error") {

            $em = $instrument_cover['data'];

            # redirect to '../add-instrument.php' and passing error message & user_input
            header("Location: ../edit-instrument.php?error=$em&$user_input");
            exit;
        } else {
            # getting the new file name and instrument cover name
            $file_URL = $file['data'];
            $instrument_cover_URL = $instrument_cover['data'];

            # insert data into database
            $sql = "INSERT INTO instrument (title, owner_id, description, category_id, cover, file)
                    VALUES (?, ?, ?, ?, ?, ?)";
                
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$title, $owner, $desc, $category, $instrument_cover_URL, $file_URL]);

            //if no error happens while insert data
            if ($res) {
                //success message
                $sm = "Instrument Successfully Added!";
                header("Location: ../add-instrument.php?success=$sm");
                exit;
            } else {
                //error message
                $em = "Unknown Error Occured!";
                header("Location: ../add-instrument.php?error=$em");
                exit;
            }
            }
        }
    } else {
        header("Location: ../admin.php");
        exit;
    }

} else {
    header("Location: ../login.php");
    exit;
}