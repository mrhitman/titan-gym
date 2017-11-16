<?php 
    if ($_POST) {
        $to      = 'kabalx47@gmail.com';
        $subject = $_POST['subject'];
        $message = $_POST['info'];
        $headers = 'From: ' . $_POST['email'] . "\r\n" .
            'Reply-To: ' . $_POST['email'] . "\r\n";
        mail($to, $subject, $message);
    }    
    header('Location: index.html');
    exit;
?>