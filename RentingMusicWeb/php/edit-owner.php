<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    //to check if owner is submitted
    if (isset($_POST['eachOwner_id']) && isset($_POST['eachOwner_name']) && isset($_POST['eachOwner_phone'])) {
        //get data from post request and store both in var
        $name = $_POST['eachOwner_name'];
        $phone = $_POST['eachOwner_phone'];
        $id = $_POST['eachOwner_id'];

        //simple form validation
        if (empty($name) && empty($phone)) {
            $em = "The Field is Required";
            header("Location: ../edit-owner.php?error=$em&id=$id");
            exit;
        } else {
            //update into database
            $sql = "UPDATE owner SET name=?, phone_number=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name, $phone, $id]);

            //if no error happens while insert data
            if ($res) {
                //success message
                $sm = "Successfully updated!";
                header("Location: ../edit-owner.php?success=$sm&id=$id");
                exit;
            } else {
                //error message
                $em = "Unknown Error Occured!";
                header("Location: ../edit-owner.php?error=$em&id=$id");
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