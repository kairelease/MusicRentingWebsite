<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {

    # Database Connection File
    include "../db_conn.php";

    // Check if admin data is submitted
    if (isset($_POST['fullName'], $_POST['email'], $_POST['password'])) {
        // Get data from POST request
        $fullName = trim($_POST['fullName']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Simple form validation
        if (empty($fullName) || empty($email) || empty($password)) {
            $em = "All fields are required!";
            header("Location: ../add-admin.php?error=$em");
            exit;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $em = "Invalid email format!";
            header("Location: ../add-admin.php?error=$em");
            exit;
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insert admin into the database
            $sql = "INSERT INTO admin (fullName, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $res = $stmt->execute([$fullName, $email, $hashed_password]);

            if ($res) {
                $sm = "Admin successfully created!";
                header("Location: ../add-admin.php?success=$sm");
                exit;
            } else {
                $em = "An unknown error occurred!";
                header("Location: ../add-admin.php?error=$em");
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
?>
