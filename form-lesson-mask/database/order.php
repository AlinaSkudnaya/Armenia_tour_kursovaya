<?php

    session_start();
    require_once 'connect.php';

    $name = filter_var( trim($_POST['user_name']),FILTER_SANITIZE_STRING);
$phone = filter_var( trim($_POST['user_phone']),FILTER_SANITIZE_STRING);
$email = filter_var( trim( $_POST['user_email']),FILTER_SANITIZE_STRING);
$tour = filter_var( trim($_POST['tour']),FILTER_SANITIZE_STRING);
    if ($password === $password_confirm) {

        $path = 'uploads/' . time() . $_FILES['avatar']['name'];
        if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
            $_SESSION['message'] = 'Ошибка при загрузке сообщения';
            header('Location: ../register.php');
        }

        $password = md5($password);

        mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email', '$password', '$path')");

        $_SESSION['message'] = 'Регистрация прошла успешно!';
        header('Location: ../index.php');


    } else {
        $_SESSION['message'] = 'Пароли не совпадают';
        header('Location: ../register.php');
    }

?>
