<?php
require 'includes/auth.php';
require 'includes/connection.php';

$user_id = $_SESSION['user_id'];
$assunto = trim($_POST['assunto'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');

if ($assunto === '' || $mensagem === '') {
    header("Location: contactos.php?erro=1");
    exit;
}

$stmt = $pdo->prepare(
  "INSERT INTO mensagens (user_id, assunto, mensagem)
   VALUES (?, ?, ?)"
);
$stmt->execute([$user_id, $assunto, $mensagem]);

header("Location: cliente.php?msg=enviada");
exit;
