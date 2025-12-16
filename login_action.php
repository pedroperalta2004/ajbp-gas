<?php
session_start();
require 'includes/connection.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    header("Location: login.php?erro=1");
    exit;
}

$stmt = $pdo->prepare(
  "SELECT id, nome, password_hash, role
   FROM utilizadores
   WHERE email = ?"
);
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password_hash'])) {
    session_regenerate_id(true);

    $_SESSION['user_id']   = $user['id'];
    $_SESSION['user_nome'] = $user['nome'];
    $_SESSION['user_role'] = $user['role'];

    if ($user['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: cliente.php");
    }
    exit;
}

header("Location: login.php?erro=1");
exit;
