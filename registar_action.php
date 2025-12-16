<?php
session_start();
require 'includes/connection.php';

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telemovel = trim($_POST['telemovel'] ?? '');
$password = $_POST['password'] ?? '';

if ($nome === '' || $email === '' || $password === '') {
  header("Location: registar.php?erro=campos");
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header("Location: registar.php?erro=email");
  exit;
}

if (strlen($password) < 6) {
  header("Location: registar.php?erro=password");
  exit;
}

$stmt = $pdo->prepare("SELECT id FROM utilizadores WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
  header("Location: registar.php?erro=existe");
  exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
  "INSERT INTO utilizadores (nome, email, telemovel, password_hash)
   VALUES (?, ?, ?, ?)"
);
$stmt->execute([$nome, $email, $telemovel !== '' ? $telemovel : null, $hash]);

header("Location: login.php?registo=ok");
exit;
