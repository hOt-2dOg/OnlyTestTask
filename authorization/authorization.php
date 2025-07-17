<?php

session_start();
include("../db.php");

$phone = "";
$email = "";
$password = "";

$error = "";

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $password = $_POST['password'];
    $isEmail = $_POST['isEmail'];

    //Проверка значения radioButton
    if($isEmail == 'Email') {
        $email = $_POST["emailOrPhone"];
    }else{
        $phone = $_POST["emailOrPhone"];
    }
    //Сценарий авторизации по email
    if(!empty($email)) {
        // Поиск пользователя в БД
        $checkingMail = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $checkingMail->execute([$email]);
        $user = $checkingMail->fetch();

        //Сравнение введенного пароля и пароля в БД
        if($user && password_verify($password, $user["password"])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['password'] = $user['password'];
            header('Location: /index.php');
            exit;

        }else{
            header('Location: /authorization/authorizationForm.php?error=email');
        }
    //Сценарий авторизации по номеру
    }else{
        // Поиск пользователя в БД
        $checkingPhone = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
        $checkingPhone->execute([$phone]);
        $user = $checkingPhone->fetch();

        //Сравнение введенного пароля и пароля в БД
        if($user && password_verify($password, $user["password"])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['password'] = $user['password'];
            header('Location: /index.php');
            exit;

        }else{
            header('Location: /authorization/authorizationForm.php?error=phone');
        }
    }
}