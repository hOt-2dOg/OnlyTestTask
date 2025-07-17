<header style="display: flex; align-items: center; justify-content: space-between; padding: 10px 20px; background-color: #f8f8f8; border-bottom: 1px solid #ddd; font-family: sans-serif;">
    <form action="/index.php">
        <button type="submit" style="background: none; border: none; font-size: 16px; cursor: pointer;">Главная</button>
    </form>

    <div style="display: flex; gap: 15px; align-items: center;">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <form action="/authorization/authorizationForm.php">
                <button type="submit" style="padding: 8px 16px; border: 1px solid #ccc; border-radius: 4px; background-color: #fff; cursor: pointer;">Войти</button>
            </form>
        <?php endif; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
            <form action="/personal/AccountForm.php">
                <button type="submit" style="padding: 8px 16px; border: 1px solid #ccc; border-radius: 4px; background-color: #fff; cursor: pointer;">Личный кабинет</button>
            </form>
            <form action="/personal/logout.php">
                <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Выйти</button>
            </form>
        <?php endif; ?>
</header>