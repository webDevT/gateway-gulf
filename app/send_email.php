<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];

    $mail = new PHPMailer(true);

    try {
        // Настройки SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_temp_email@gmail.com'; // Временный Gmail
        $mail->Password = 'your_email_password'; // Пароль Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // От кого
        $mail->setFrom('your_temp_email@gmail.com', 'Your Name');

        // Кому
        $mail->addAddress('karinadesyatnik27@gmail.com', 'Recipient Name');

        // Тема письма
        $mail->Subject = 'New Form Submission';

        // Тело письма
        $mailContent = "
            <h2>Form Details</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Job Title:</strong> $job_title</p>
            <p><strong>Company Name:</strong> $company_name</p>
            <p><strong>Location:</strong> $location</p>
        ";
        $mail->Body = $mailContent;
        $mail->isHTML(true);

        // Отправка письма
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
