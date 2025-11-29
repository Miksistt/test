<?php
$page = $_GET['page'] ?? 'register';

function renderRegisterForm() {
    ?>
    <h2>Регистрация</h2>
    <form method="post" action="/templates/auth/register.php">
        <label>Имя: <input type="text" name="name" required></label><br>
        <label>Email: <input type="email" name="email" required></label><br>
        <label>Пароль: <input type="password" name="password" required minlength="6"></label><br>
        <button type="submit" name="register">Зарегистрироваться</button>
    </form>
    <?php
}

function renderAdminPanel() {
    include 'templates/back/admin.php';
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сайт с вкладками</title>
    <style>
        nav { margin-bottom: 20px; }
        nav a {
            padding: 10px 15px;
            margin-right: 5px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-bottom: none;
            background: #eee;
            color: black;
        }
        nav a.active {
            background: white;
            font-weight: bold;
            border-bottom: 1px solid white;
        }
        section { padding: 20px; border: 1px solid #ccc; }
    </style>
</head>
<body>
<nav>
    <a href="?page=register" class="<?= $page == 'register' ? 'active' : '' ?>">Регистрация</a>
    <a href="?page=admin" class="<?= $page == 'admin' ? 'active' : '' ?>">Админ-панель</a>
</nav>

<section>
    <?php
    if ($page === 'admin') {
        renderAdminPanel();
    } else {
        renderRegisterForm();
    }
    ?>
</section>
</body>
</html>
