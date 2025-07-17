<?php
session_start();
require '../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /index.php');
    exit;
}

$error = '';

//Текущие данные пользователя
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $email_changed = $user['email'] !== $email;
    $phone_changed = $user['phone'] !== $phone;

    //Введен ли новый email
    if ($email_changed) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND id != ?");
        $stmt->execute([$email, $user_id]);

        //Email занят
        if ($stmt->rowCount() > 0) {
            $error = 'Этот email уже используется другим пользователем';
            header('Location: /personal/updateAccountForm.php?error=email');
        }
    }

    //Введен ли новый номер
    if ($phone_changed) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ? AND id != ?");
        $stmt->execute([$phone, $user_id]);

        //Телефон занят
        if ($stmt->rowCount() > 0) {
            $error = 'Этот телефон уже используется другим пользователем';
            header('Location: /personal/updateAccountForm.php?error=phone');
        }
    }

    //Проверка пароля
    if (!empty($new_password) && $new_password !== $confirm_password) {
        $error = 'Пароли не совпадают';
        header('Location: /personal/updateAccountForm.php?error=password');
    }
    
    //Ошибок не найдено
     if ($error === '') {
        //Пароль поменялся
         if (!empty($new_password)) {
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = ?, email = ?, phone = ?, password_hash = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $phone, $password_hash, $user_id]);
        }
        //Пароль остался прежним
        else {
            $sql = "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $phone, $user_id]);
        }

        //Обновляем данные в сессии
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['phone'] = $phone;

        header('Location: /personal/accountForm.php?success=true');
     }
}
?>
