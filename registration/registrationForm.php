<?php 

session_start();

$error = $_GET['error'] ?? '';

include '../template/header.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <style>
        .registration-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .error-message {
            color: red;
            background-color: #ffe6e6;
            border: 1px solid #ff9999;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
        }

        .submit-btn {
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h2>Регистрация</h2>

    <?php if (!empty($error)): ?>
        <div class="error-message">
            <?php
                $errorText = 'Произошла ошибка при обновлении.';
                if (str_contains($error, 'phone')) {
                    $errorText = 'Номер уже занят';
                } elseif (str_contains($error, 'email')) {
                    $errorText = 'Email уже занят';
                } elseif (str_contains($error, 'password')) {
                    $errorText = 'Пароль не сходится';
                }
                echo htmlspecialchars($errorText);
            ?>
        </div>
    <?php endif; ?>

    <form action="registration.php" method="POST">
        <div>
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" placeholder="Введите ваше имя" required>
        </div>

        <div>
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" placeholder="+7-999-999-99-99" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="example@example.com" required>
        </div>

        <div>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="confirm_password">Повторите пароль:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>

        <button type="submit" class="submit-btn">Зарегистрироваться</button>
    </form>
    </div>
</body>

