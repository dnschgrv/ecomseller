<?php
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$number = $_POST['name'];
$email = $_POST['email'];

use PHPMailer\PHPMailer\PHPMailer;
$files = [
    [
        'name'=>'Ecomseller_presentation_V2.pdf',
        'path'=>'Ecomseller_presentation_V2.pdf'
    ],
    [
        'name'=>'Всесезонные товары к запуску на МП.xlsx',
        'path'=>'Всесезонные товары к запуску на МП.xlsx'
    ]
];

$mail = new PHPMailer;
$mail->CharSet = "utf-8";
$mail->setFrom('d.chigarev@sellecom.ru');
$mail->addAddress($email);

$mail->Subject = 'EcomSeller. Презентация.';
$mail->Body = "Добро пожаловать - это Еком Селлер. Во вложении наша презентация.\n\nС уважением,\n\nКоманда Еком Селлер";

foreach($files as $file){
    $mail->addAttachment($file['path'], $file['name']);
}

if(!$mail->send()) {
    echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent.';
}
?>