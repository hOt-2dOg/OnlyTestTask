<?php 

session_start();

include '../template/header.php';

$error = $_GET['error'] ?? '';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать профиль</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .edit-profile-container {
            max-width: 600px;
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
            display: flex;
            flex-direction: column;
            font-size: 14px;
            color: #555;
        }

        label strong {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
        }

        .save-changes-btn {
            align-self: flex-start;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .save-changes-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
  <div class="edit-profile-container">
    <h2>Редактировать профиль</h2>

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

    <form action="updateAccount.php" method="POST">
        <label>
            <strong>Имя:</strong>
            <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['name']) ?>" required>
        </label>

        <label>
            <strong>Email:</strong>
            <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['email']) ?>" required>
        </label>

        <label>
            <strong>Телефон:</strong>
            <input type="tel" name="phone" value="<?= htmlspecialchars($_SESSION['phone']) ?>" required>
        </label>

        <label>
            <strong>Новый пароль (оставьте пустым, если не хотите менять):</strong>
            <input type="password" name="new_password">
        </label>

        <label>
            <strong>Подтвердите пароль:</strong>
            <input type="password" name="confirm_password">
        </label>

        <button type="submit" class="save-changes-btn">Сохранить изменения</button>
    </form>
  </div>
</body>

