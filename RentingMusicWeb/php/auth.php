<?php
session_start();

    if (isset($_POST['email']) && isset($_POST['password'])) {


        # Database Connection File
        include "../db_conn.php";

        # Validate helper function
        include "validateFunc.php";

        //Get data from post request and store them in var
        $email = $_POST['email'];
        $password = $_POST['password'];

        # simple form validation
        $text = "Email";
        $location = "../login.php";
        $ms = "error";
        is_empty($email, $text, $location, $ms, "");

        $text = "Password";
        $location = "../login.php";
        $ms = "error";
        is_empty($password, $text, $location, $ms, "");

        # search for the email
        $sql = "SELECT * FROM admin WHERE email=?";

        $stmt = $conn -> prepare($sql);
        $stmt -> execute([$email]);

        # if the email is exist
        if ($stmt -> rowCount() === 1) {
            $user = $stmt->fetch();

            $user_id = $user['id'];
            $user_email = $user['email'];
            $user_password = $user['password'];

            if ($email === $user_email) {
                if (password_verify($password, $user_password)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    header("Location: ../admin.php");
                } else {
                    # error messg
                    $em = "Incorrect Email or Password";
                    header("Location: ../login.php?error=$em");
                }
            } else {
                # error messg
                $em = "Incorrect Email or Password";
                header("Location: ../login.php?error=$em");
            }
        } else {
            # error message

            $em = "Incorrect Email or Password";
            header("Location: ../login.php?error=$em");
        }

    } else {
        # Redirect to "../login.php"
        header("Location: ../login.php");
    }

?>