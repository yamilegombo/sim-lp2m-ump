<?php
declare(strict_types=1);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

if (!verify_csrf($_POST['csrf_token'] ?? '')) {
    $_SESSION['login_error'] = 'Permintaan tidak valid. Silakan coba lagi.';
    header('Location: index.php');
    exit;
}

$email = trim(strtolower($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';

$_SESSION['old_email'] = $email;

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
    $_SESSION['login_error'] = 'Email dan password wajib diisi dengan benar.';
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare(
    'SELECT u.id, u.name, u.email, u.password, u.is_active, r.name AS role
     FROM users u
     INNER JOIN roles r ON r.id = u.role_id
     WHERE u.email = :email
     LIMIT 1'
);
$stmt->execute(['email' => $email]);
$user = $stmt->fetch();

if (!$user || !$user['is_active'] || !password_verify($password, $user['password'])) {
    $_SESSION['login_error'] = 'Email atau password salah, atau akun tidak aktif.';
    header('Location: index.php');
    exit;
}

session_regenerate_id(true);

$_SESSION['user'] = [
    'id'    => (int)$user['id'],
    'name'  => $user['name'],
    'email' => $user['email'],
    'role'  => $user['role']
];

$update = $pdo->prepare('UPDATE users SET last_login = NOW() WHERE id = :id');
$update->execute(['id' => $user['id']]);

unset($_SESSION['old_email']);
header('Location: dashboard.php');
exit;
?>
