<?php 

session_start();

include '../template/header.php';

$error = $_GET['error'] ?? '';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <style>
        .auth-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            font-family: Arial, sans-serif;
        }

        .auth-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
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
            margin-top: 10px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
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

        

        .register-link button {
            background: none;
            border: none;
            color: #007bff;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }

        .register-link button:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            border: 1px solid red;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            background-color: #ffe6e6;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>Вход</h2>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php
                    $errorText = 'Произошла ошибка при регистрации.';
                    if (str_contains($error, 'phone')) {
                        $errorText = 'Номер или пароль имеют ошибку';
                    } elseif (str_contains($error, 'email')) {
                        $errorText = 'Email или пароль имеют ошибку';
                    }
                    echo htmlspecialchars($errorText);
                ?>
            </div>
        <?php endif; ?>

        <form action="authorization.php" method="POST">
            <div class="radio-group">
                <label><input type="radio" name="isEmail" value="Email" checked> Email</label>
                <label><input type="radio" name="isEmail" value="Number"> Номер</label>
            </div>

            <label for="text">Email / Номер:</label>
            <input type="text" id="text" name="emailOrPhone" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" class="submit-btn" value="Отправить">
        </form>

        <form action="../registration/registrationForm.php">
            <div class="register-link">
                Нет аккаунта? 
                <button>Регистрация</button>
            </div>
        </form>
    </div>
    
</body>