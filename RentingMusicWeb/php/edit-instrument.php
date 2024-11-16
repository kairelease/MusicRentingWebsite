<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    # Validate helper function
    include "func-validation.php";

    # File Upload helper function
    include "func-file-upload.php";

    //to check if all input are filled
    if (isset($_POST['instrument_id'])       && 
        isset($_POST['instrument_name'])     && 
        isset($_POST['instrument_desc'])     && 
        isset($_POST['instrument_owner'])    &&
        isset($_POST['instrument_category']) &&
        isset($_FILES['instrument_cover'])   &&
        isset($_FILES['file'])               &&
        isset($_POST['current_cover'])       && 
        isset($_POST['current_file'])) {
        //get data from post request and store both in var
        //get data from post request and store all in var
        $id = $_POST['instrument_id'];
        $title = $_POST['instrument_name'];
        $desc = $_POST['instrument_desc'];
        $owner = $_POST['instrument_owner'];
        $category = $_POST['instrument_category'];
        
        //get current cover & current file from post request and store them in var
        $current_cover = $_POST['current_cover'];
        $current_file = $_POST['current_file'];

        //simple form validation
        $text = "Title";
        $location ="../edit-instrument.php";
        $ms = "id=$id&error";
        is_empty($title, $text, $location, $ms, "");

        $text = "Description";
        $location ="../edit-instrument.php";
        $ms = "id=$id&error";
        is_empty($desc, $text, $location, $ms, "");

        $text = "Instrument Owner";
        $location ="../edit-instrument.php";
        $ms = "id=$id&error";
        is_empty($owner, $text, $location, $ms, "");

        $text = "Category";
        $location ="../edit-instrument.php";
        $ms = "id=$id&error";
        is_empty($category, $text, $location, $ms, "");

        //if the admin try to update the book cover
        if (!empty($_FILES['instrument_cover']['name'])) {

            //if the admin try to update both
            if (!empty($_FILES['file']['name'])) {
                //update both here
                # instrument cover upload process
                $allowed_image_exs = array("jpg", "jpeg", "png");
                $path = "cover";
                $instrument_cover = upload_file($_FILES['instrument_cover'], $allowed_image_exs, $path);

                # instrument cover upload process
                $allowed_file_exs = array("pdf", "docx", "pptx");
                $path = "files";
                $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

                if ($instrument_cover['status'] == "error" || $file['status'] == "error") {
                    $em = $instrument_cover['data'];
        
                    # redirect to '../edit-instrument.php' and passing error message & the id
                    header("Location: ../edit-instrument.php?error=$em&id=$id");
                    exit;
                } else {
                    # current book cover location
                    $c_p_instrument_cover = "../uploads/cover/$current_cover";
                    # current book cover location
                    $c_p_file = "../uploads/files/$current_file";
                    # delete from the server
                    unlink($c_p_instrument_cover);
                    unlink($c_p_file);

                    # getting new file name and the new book cover name
                    $file_URL = $file['data'];
                    $instrument_cover_URL = $instrument_cover['data'];

                    //update just the data
                    $sql = "UPDATE instrument SET title=?, owner_id=?, description=?, category_id=?, cover=?, file=? WHERE id=?";

                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $owner, $desc, $category, $instrument_cover_URL, $file_URL, $id]);

                    //if no error happens while update data
                    if ($res) {
                        //success message
                        $sm = "Successfully updated!";
                        header("Location: ../edit-instrument.php?success=$sm&id=$id");
                        exit;
                    } else {
                        //error message
                        $em = "Unknown Error Occured!";
                        header("Location: ../edit-instrument.php?error=$em&id=$id");
                        exit;
                    }
                }
            } else {
                //update just instrument cover

                # instrument cover upload process
                $allowed_image_exs = array("jpg", "jpeg", "png");
                $path = "cover";
                $instrument_cover = upload_file($_FILES['instrument_cover'], $allowed_image_exs, $path);

                if ($instrument_cover['status'] == "error") {
                    $em = $instrument_cover['data'];
        
                    # redirect to '../edit-instrument.php' and passing error message & the id
                    header("Location: ../edit-instrument.php?error=$em&id=$id");
                    exit;
                } else {
                    # current book cover location
                    $c_p_instrument_cover = "../uploads/cover/$current_cover";
                    # delete from the server
                    unlink($c_p_instrument_cover);

                    # getting new file name and the new book cover name
                    $instrument_cover_URL = $instrument_cover['data'];

                    //update just the data
                    $sql = "UPDATE instrument SET title=?, owner_id=?, description=?, category_id=?, cover=? WHERE id=?";

                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $owner, $desc, $category, $instrument_cover_URL, $id]);

                    //if no error happens while update data
                    if ($res) {
                        //success message
                        $sm = "Successfully updated!";
                        header("Location: ../edit-instrument.php?success=$sm&id=$id");
                        exit;
                    } else {
                        //error message
                        $em = "Unknown Error Occured!";
                        header("Location: ../edit-instrument.php?error=$em&id=$id");
                        exit;
                    }
                }
            }
        }
        //if the admin try to update both
        else if (!empty($_FILES['file']['name'])) {
            //update just instrument file

                # instrument cover upload process
                $allowed_file_exs = array("pdf", "docx", "pptx");
                $path = "files";
                $file = upload_file($_FILES['file'], $allowed_file_exs, $path);

                if ($file['status'] == "error") {
                    $em = $file['data'];
        
                    # redirect to '../edit-instrument.php' and passing error message & the id
                    header("Location: ../edit-instrument.php?error=$em&id=$id");
                    exit;
                } else {
                    # current file location
                    $c_p_file = "../uploads/files/$current_file";
                    # delete from the server
                    unlink($c_p_file);

                    # getting new file name and the new instrument cover name
                    $file_URL = $file['data'];

                    //update just the data
                    $sql = "UPDATE instrument SET title=?, owner_id=?, description=?, category_id=?, file=? WHERE id=?";

                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([$title, $owner, $desc, $category, $file_URL, $id]);

                    //if no error happens while update data
                    if ($res) {
                        //success message
                        $sm = "Successfully updated!";
                        header("Location: ../edit-instrument.php?success=$sm&id=$id");
                        exit;
                    } else {
                        //error message
                        $em = "Unknown Error Occured!";
                        header("Location: ../edit-instrument.php?error=$em&id=$id");
                        exit;
                    }
                }
        } else {
            //update just the data
            $sql = "UPDATE instrument SET title=?, owner_id=?, description=?, category_id=? WHERE id=?";

            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$title, $owner, $desc, $category, $file_URL, $id]);

            //if no error happens while update data
            if ($res) {
                //success message
                $sm = "Successfully updated!";
                header("Location: ../edit-instrument.php?success=$sm&id=$id");
                exit;
            } else {
                //error message
                $em = "Unknown Error Occured!";
                header("Location: ../edit-instrument.php?error=$em&id=$id");
                exit;
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