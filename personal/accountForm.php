<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: /index.php');
    exit;
}

$success = $_GET['success'] ?? '';

include("../template/header.php");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .account-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success-message {
            color: green;
            background-color: #e6ffe6;
            border: 1px solid #b2ffb2;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
        }

        .user-info p {
            margin: 0;
            font-size: 16px;
        }

        .user-info strong {
            min-width: 100px;
            display: inline-block;
            color: #333;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
        }

        .btn-edit:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
  <div class="account-container">
      <?php if ($success): ?>
        <p style="color: green;"><?= htmlspecialchars("Данные успешно обновлены") ?></p>
      <?php endif; ?>

      <h2>Личный кабинет</h2>

      <div class="user-info">
        <p><strong>Имя:</strong> <?= htmlspecialchars($_SESSION['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['email']) ?></p>
        <p><strong>Телефон:</strong> <?= htmlspecialchars($_SESSION['phone']) ?></p>
      </div>

      <form action="updateAccountForm.php" method="get">
        <button type="submit" class="btn btn-edit">Редактировать</button>
      </form>
  </div>
</body>

