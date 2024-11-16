<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    //to check if instrument id is set
    if (isset($_GET['id'])) {
        //get data from get request and store it in var
        $id = $_GET['id'];

        //simple form validation
        if (empty($id)) {
            $em = "An Error occured!";
            header("Location: ../admin.php?error=$em");
            exit;
        } else {
            // GET book from Database
            $sql2 = "SELECT * FROM instrument WHERE id=?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute([$id]);
            $the_instrument = $stmt2->fetch();

            if ($stmt2->rowCount() > 0) {
                //delete instrument in database
                $sql = "DELETE FROM instrument WHERE id=?";
                $stmt = $conn->prepare($sql);
                $res = $stmt->execute([$id]);

                //if no error happens while deleting data
                if ($res) {
                    //delete the current instrument_cover and file
                    $cover = $the_instrument['cover'];
                    $file = $the_instrument['file'];
                    $c_b_c = "../uploads/cover/$cover";
                    $c_f = "../uploads/files/$cover";
                    unlink($c_b_c);
                    unlink($c_f);

                    //success message
                    $sm = "Successfully removed!";
                    header("Location: ../admin.php?success=$sm");
                    exit;
                } else {
                    //error message
                    $em = "Unknown Error Occured!";
                    header("Location: ../admin.php?error=$em");
                    exit;
                }
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