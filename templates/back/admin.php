<?php
$file = 'users.json';
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

if (isset($_POST['save'])) {
    $id = intval($_POST['id']);
    if (isset($users[$id])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        if ($name && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $users[$id]['name'] = $name;
            $users[$id]['email'] = $email;
            file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
        }
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if (isset($users[$id])) {
        array_splice($users, $id, 1);
        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
    }
    header("Location: admin.php");
    exit;
}

if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editUser = $users[$editId] ?? null;
} else {
    $editId = null;
    $editUser = null;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Управление пользователями</title></head>
<body>
<h1>Пользователи</h1>
<table border="1" cellpadding="4">
<tr><th>ID</th><th>Имя</th><th>Email</th><th>Действия</th></tr>
<?php foreach ($users as $id => $user): ?>
<tr>
    <td><?= $id+1 ?></td>
    <td><?= htmlspecialchars($user['name']) ?></td>
    <td><?= htmlspecialchars($user['email']) ?></td>
    <td>
        <a href="?edit=<?= $id ?>">Редактировать</a>
        <a href="?delete=<?= $id ?>" onclick="return confirm('Удалить?')">Удалить</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php if ($editUser): ?>
<h2>Редактировать пользователя #<?= $editId+1 ?></h2>
<form method="post">
    <input type="hidden" name="id" value="<?= $editId ?>">
    <label>Имя: <input type="text" name="name" value="<?= htmlspecialchars($editUser['name']) ?>" required></label><br>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($editUser['email']) ?>" required></label><br>
    <button type="submit" name="save">Сохранить</button>
</form>
<?php endif; ?>
</body>
</html>
