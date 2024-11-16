<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    //to check if owner id is set
    if (isset($_GET['id'])) {
        //get data from get request and store it in var
        $id = $_GET['id'];

        //simple form validation
        if (empty($id)) {
            $em = "An Error occured!";
            header("Location: ../admin.php?error=$em");
            exit;
        } else {
                //delete category in database
                $sql = "DELETE FROM owner WHERE id=?";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$id]);

                //if no error happens while deleting data
                if ($res) {
                    //success message
                    $sm = "Successfully removed!";
                    header("Location: ../admin.php?success=$sm");
                    exit;
            } else {
                $em = "An Error Occured!";
                header("Location: ../admin.php?error=$em");
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