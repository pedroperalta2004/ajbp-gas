<?php
session_start();
require 'includes/connection.php';

header('Content-Type: application/json; charset=utf-8');

function out($arr, $code = 200) {
  http_response_code($code);
  echo json_encode($arr);
  exit;
}

$zona_id   = isset($_GET['zona_id']) ? (int)$_GET['zona_id'] : 0;
$tipo_gas  = trim($_GET['tipo_gas'] ?? '');
$modalidade = trim($_GET['modalidade'] ?? 'Domicilio');

if ($zona_id <= 0 || $tipo_gas === '') {
  out(['ok' => false, 'error' => 'Parâmetros inválidos.'], 400);
}

$modalidade = ($modalidade === 'Domicílio') ? 'Domicilio' : $modalidade;

if ($modalidade !== 'Domicilio') {
  out(['ok' => false, 'error' => 'Modalidade inválida.'], 400);
}

try {
  $stmt = $pdo->prepare("
    SELECT preco_unit
    FROM precos
    WHERE zona_id = ? AND tipo_gas = ? AND modalidade = ?
    LIMIT 1
  ");
  $stmt->execute([$zona_id, $tipo_gas, $modalidade]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    out(['ok' => true, 'price' => null]);
  }

  out(['ok' => true, 'price' => (float)$row['preco_unit']]);
} catch (Throwable $e) {
  out(['ok' => false, 'error' => 'Erro interno.'], 500);
}
