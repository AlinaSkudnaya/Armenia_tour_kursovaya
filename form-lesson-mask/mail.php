<?php 

require_once('phpmailer/PHPMailerAutoload.php');
require_once './database/connect.php';
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$name = filter_var( trim($_POST['user_name']),FILTER_SANITIZE_STRING);
$phone = filter_var( trim($_POST['user_phone']),FILTER_SANITIZE_STRING);
$email = filter_var( trim( $_POST['user_email']),FILTER_SANITIZE_STRING);
$tour = filter_var( trim($_POST['tour']),FILTER_SANITIZE_STRING);

if(mb_strlen($name)<5 || mb_strlen($name)>40){
    echo "The length of the name is not allowed";
    exit();
} else if(mb_strlen($name)==0){
        echo "Enter your phone number";
        exit();
    }
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'june.alya@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'ViPrfP1yI3r{'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('june.alya@mail.ru'); // от кого будет уходить письмо?
$mail->addAddress('artour.tour@mail.ru');     // Кому будет уходить письмо 
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Заявка с сайта на регистрацию тура';
$mail->Body    = '' .$name . ' оставил(-a) заявку, его телефон ' .$phone. '<br>Почта этого пользователя: ' .$email. '<br>Тур пользователя: ' .$tour;
$mail->AltBody = '';

if(!$mail->send()) {
    echo 'Error';
} else {
    header('location: thank-you.html');
}


$mysql = new mysqli('localhost','root','root','booking');
$mysql->query("INSERT INTO `booktour` ( `name`, `phone`, `email`, `tour`) VALUES ('$name','$phone', '$email','$tour')") ;

$mysql->close();


?>

