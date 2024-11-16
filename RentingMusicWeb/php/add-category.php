<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    //to check if category is submitted
    if (isset($_POST['category_name'])) {
        //get data from post request and store it in var
        $name = $_POST['category_name'];

        //simple form validation
        if (empty($name)) {
            $em = "Please fill in the Fields";
            header("Location: ../add-category.php?error=$em");
            exit;
        } else {
            #insert into database
            $sql = "INSERT INTO categories (name) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name]);

            //if no error happens while insert data
            if ($res) {
                //success message
                $sm = "Successfully created!";
                header("Location: ../add-category.php?success=$sm");
                exit;
            } else {
                //error message
                $em = "Unknown Error Occured!";
                header("Location: ../add-category.php?error=$em");
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