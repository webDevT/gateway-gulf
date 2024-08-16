<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = array('success' => false, 'message' => '');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_temp_email@gmail.com'; // Ваш Gmail адрес
        $mail->Password = 'your_app_password'; // Ваш пароль приложения или основной пароль
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('your_temp_email@gmail.com', 'Your Name');
        $mail->addAddress('karinadesyatnik27@gmail.com', 'Recipient Name');

        $mail->Subject = 'New Form Submission';

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

        $mail->send();
        $response['success'] = true;
        $response['message'] = 'Thank you! Message has been sent';
    } catch (Exception $e) {
        $response['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    echo json_encode($response);
    exit;
}
?>
