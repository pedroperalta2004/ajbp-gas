<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'includes/connection.php';

function redirectWithError(string $msg, string $query = ''): void {
  $_SESSION['flash_error'] = $msg;
  header("Location: encomendar.php" . ($query ? ("?" . $query) : ""));
  exit;
}

if (empty($_SESSION['user_id'])) {
  $_SESSION['flash_error'] = 'Tens de iniciar sessão para fazer uma encomenda.';
  header("Location: login.php?next=" . urlencode("encomendar.php"));
  exit;
}

$user_id = (int)$_SESSION['user_id'];

$csrf = $_POST['csrf_token'] ?? '';
if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $csrf)) {
  redirectWithError('Pedido inválido. Atualiza a página e tenta novamente.', 'erro=csrf');
}

$nome        = trim($_POST['nome'] ?? '');
$email       = trim($_POST['email'] ?? '');
$telefone    = trim($_POST['telefone'] ?? '');
$morada      = trim($_POST['morada'] ?? '');
$zona_id     = (int)($_POST['zona_id'] ?? 0);
$tipo_gas    = trim($_POST['tipo'] ?? '');
$quantidade  = (int)($_POST['quantidade'] ?? 0);
$observacoes = trim($_POST['observacoes'] ?? '');
$modalidade = 'Domicilio';

if ($nome === '' || $email === '' || $telefone === '' || $morada === '' || $tipo_gas === '' || $zona_id <= 0 || $quantidade <= 0) {
  redirectWithError('Preenche todos os campos obrigatórios para enviar a encomenda.', 'erro=campos');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  redirectWithError('O email introduzido não é válido.', 'erro=email');
}

$telefone_digits = preg_replace('/\D+/', '', $telefone);
if ($telefone_digits === '' || strlen($telefone_digits) < 9) {
  redirectWithError('O número de telefone não é válido.', 'erro=telefone');
}

$TIPOS_PERMITIDOS = ['Propano 11kg', 'Propano 45kg', 'Butano 13kg', 'Light 12kg'];
if (!in_array($tipo_gas, $TIPOS_PERMITIDOS, true)) {
  redirectWithError('Tipo de gás inválido.', 'erro=tipo');
}

if ($tipo_gas === 'Propano 45kg' && $modalidade !== 'Domicilio') {
  redirectWithError('Propano 45kg apenas disponível para entrega ao domicílio.', 'erro=modalidade');
}

$stmtPreco = $pdo->prepare("
  SELECT preco_unit
  FROM precos
  WHERE zona_id = ? AND tipo_gas = ? AND modalidade = ?
  LIMIT 1
");
$stmtPreco->execute([$zona_id, $tipo_gas, $modalidade]);
$preco_unit = $stmtPreco->fetchColumn();

if ($preco_unit === false || $preco_unit === null || $preco_unit === '') {
  redirectWithError('Preço indisponível para a zona/tipo selecionados. Contacta o administrador.', 'erro=preco');
}

$preco_unit = (float)$preco_unit;
$valor_total = $preco_unit * $quantidade;

$stmt = $pdo->prepare("
  INSERT INTO encomendas
    (user_id, zona_id, nome, email, telefone, morada, tipo_gas, modalidade, quantidade, observacoes, preco_unit, valor_total)
  VALUES
    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$ok = $stmt->execute([
  $user_id,
  $zona_id,
  $nome,
  $email,
  $telefone_digits, 
  $morada,
  $tipo_gas,
  $modalidade,
  $quantidade,
  $observacoes !== '' ? $observacoes : null,
  number_format($preco_unit, 2, '.', ''),
  number_format($valor_total, 2, '.', ''),
]);

if (!$ok) {
  redirectWithError('Ocorreu um erro ao guardar a encomenda. Tenta novamente.', 'erro=guardar');
}

$_SESSION['flash_success'] = 'Encomenda enviada com sucesso.';
header("Location: cliente.php?encomenda=ok#encomendas");
exit;
