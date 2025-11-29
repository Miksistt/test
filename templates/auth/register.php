<?php
session_start();

$file = '/storage/users.json';
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$message = '';

if (isset($_POST['register'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($name && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 6) {
        foreach ($users as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                $message = "Пользователь с таким email уже существует.";
                break;
            }
        }
        if (!$message) {
            $users[] = [
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));


            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $name;

            header('/index.php');
            exit;
        }
    } else {
        $message = "Проверьте правильность введённых данных.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Регистрация</title>
    <link rel="stylesheet" href="/public/css/autorization.css" />
</head>
<body>
<div class="auth-container">
    <div class="auth-title">Регистрация</div>
    <?php if (!empty($message)): ?>
        <div class="auth-error"><?=htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form class="auth-form" method="post" autocomplete="off">
        <label for="register-name">Имя</label>
        <input id="register-name" type="text" name="name" required maxlength="64">

        <label for="register-email">Email</label>
        <input id="register-email" type="email" name="email" required maxlength="64">

        <label for="register-pass">Пароль(мин. 6 символов)</label>
        <input id="register-pass" type="password" name="password" required minlength="6" maxlength="64">

        <button class="sumbit-btn" type="submit" name="register">Зарегестрироваться</button>
    </form>
    <p>Уже зарегистрированы? <a href="/templates/auth/login.php">Войти</a></p>
</div>

</body>
</html>
