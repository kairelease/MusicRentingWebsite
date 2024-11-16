<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    //to check if name is submitted
    if (isset($_POST['owner_name']) && isset($_POST['owner_phone'])) {
        //get data from post request and store it in var
        $name = $_POST['owner_name'];
        $phone = $_POST['owner_phone'];

        //simple form validation
        if (empty($name) || empty($phone)) {
            $em = "Please fill in Both Fields";
            header("Location: ../add-owner.php?error=$em");
            exit;
        } else {
            #insert into database
            $sql = "INSERT INTO owner (name, phone_number) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$name, $phone]);

            //if no error happens while insert data
            if ($res) {
                //success message
                $sm = "Successfully created!";
                header("Location: ../add-owner.php?success=$sm");
                exit;
            } else {
                //error message
                $em = "Unknown Error Occured!";
                header("Location: ../add-owner.php?error=$em");
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