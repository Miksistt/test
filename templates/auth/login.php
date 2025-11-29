<?php
session_start();

$file = 'users.json';
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$message = '';

if (isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    foreach ($users as $user) {
        if (strtolower($user['email']) === strtolower($email) && password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['name'];
            header('Location: /index.php');
            exit;
        }
    }
    $message = "Неверный email или пароль.";
}
?>

<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Вход</title>
    <link rel="stylesheet" href="/public/css/autorization.css" />

</head>
<body>
<div class="auth-container">
    <div class="auth-title">Вход</div>
    <?php if (!empty($message)): ?>
    <div class="auth-error"><?=htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form class="auth-form" method="post" autocomplete="off">
        <label for="login-email">Email</label>
        <input id="login-email" type="email" name="email" required maxlength="64" autocomplete="username">

        <label for="login-pass">Пароль</label>
        <input id="login-pass" type="password" name="password" required maxlength="64" autocomplete="current-password">

        <button class="sumbit-btn" type="submit" name="login">Войти</button>
    </form>
    <p>Нет аккаунта? <a class="auth-link" href="register.php">Зарегистрироваться</a></p>
</div>
</body>
</html>
