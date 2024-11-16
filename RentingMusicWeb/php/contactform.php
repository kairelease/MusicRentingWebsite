<?php

if (isset($_POST['submitForm'])) {
    $name = $_PSOT['name'];
    $subject = $_PSOT['subject'];
    $mailFrom = $_PSOT['mail'];
    $message = $_PSOT['message'];

    $mailTo = "kl2304013599@student.uptm.edu.my";
    $headers = "From: ".$mailFrom;
    $txt = "You have received an e-mail from".$name.".\n\n".$message;

    mail($mailTo, $subject, $txt, $headers);
    header("Location: index.php?mailsend");
}
?>