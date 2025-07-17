<?php

session_start();
include("../db.php");

$name = "не определено";
$phone = "не определен";
$email = "не определен";
$password = "не определен";
$confirm_password = "не определен";


if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    try{
        //Поиск схожих email
        $checkingMail = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $checkingMail->execute([$email]);

        //Поиск схожего номера
        $checkingPhone = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
        $checkingPhone->execute([$phone]);
        
        //Сравнение пароля и повторенного пароля
        if($password !== $confirm_password){
            header('Location: /registration/registrationForm.php?error=password');
        }
        //Почта занята
        elseif($checkingMail->rowCount() > 0) {
            header('Location: /registration/registrationForm.php?error=email');
        }
        //Номер занят
        elseif($checkingPhone->rowCount() > 0) {
            header('Location: /registration/registrationForm.php?error=number');
        }
        //Успешная регистрация
        else{
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO users (name, phone, email, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name,$phone, $email, $hashPassword]);

            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['name'] = $name;
            $_SESSION['phone'] = $phone;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $hashPassword;

            header('Location: /index.php');
            exit;
        }

    }catch(Exception $e){
        $error = 'Ошибка при регистрации: ' . $e->getMessage();
    }
}


