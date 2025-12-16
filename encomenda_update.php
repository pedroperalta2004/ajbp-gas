<?php
require 'includes/admin_auth.php';
require 'includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("Location: admin.php?erro=encomenda_metodo");
  exit;
}

$csrf = $_POST['csrf_token'] ?? '';
if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf)) {
  header("Location: admin.php?erro=encomenda_csrf");
  exit;
}

$id = (int)($_POST['id'] ?? 0);
$estado = trim($_POST['estado'] ?? '');

if ($id <= 0 || $estado === '') {
  header("Location: admin.php?erro=encomenda_campos");
  exit;
}

$allowed = ['Recebida', 'Pendente', 'Em processamento', 'Entregue', 'Cancelada'];

if (!in_array($estado, $allowed, true)) {
  header("Location: admin.php?erro=encomenda_estado_invalido");
  exit;
}

try {
  $stmt = $pdo->prepare("
    UPDATE encomendas
    SET estado = ?, updated_at = NOW()
    WHERE id = ?
    LIMIT 1
  ");
  $stmt->execute([$estado, $id]);

  if ($stmt->rowCount() === 0) {
    $chk = $pdo->prepare("SELECT id FROM encomendas WHERE id = ? LIMIT 1");
    $chk->execute([$id]);
    if (!$chk->fetch()) {
      header("Location: admin.php?erro=encomenda_nao_encontrada");
      exit;
    }
    header("Location: admin.php?ok=encomenda_sem_alteracoes#encomendas");
    exit;
  }

  header("Location: admin.php?ok=encomenda_atualizada#encomendas");
  exit;

} catch (Throwable $e) {
  header("Location: admin.php?erro=encomenda_update");
  exit;
}
