<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    //to check if category is submitted
    if (isset($_POST['category_name']) && isset($_POST['category_id'])) {
        //get data from post request and store both in var
        $name = $_POST['category_name'];
        $id = $_POST['category_id'];

        //simple form validation
        if (empty($name)) {
            $em = "The Field is Required";
            header("Location: ../edit-category.php?error=$em&id=$id");
            exit;
        } else {
            //update into database
            $sql = "UPDATE categories SET name=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name, $id]);

            //if no error happens while update data
            if ($res) {
                //success message
                $sm = "Successfully updated!";
                header("Location: ../edit-category.php?success=$sm&id=$id");
                exit;
            } else {
                //error message
                $em = "Unknown Error Occured!";
                header("Location: ../edit-category.php?error=$em&id=$id");
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