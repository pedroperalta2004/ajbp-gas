<?php
require 'includes/admin_auth.php';
require 'includes/connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$TIPOS_GAS = [
  'Propano 11kg',
  'Propano 45kg',
  'Butano 13kg',
  'Light 12kg',
];

$MODALIDADES = ['Loja', 'Domicilio'];

function modalidadePermitida($tipoGas, $modalidade) {
  if ($tipoGas === 'Propano 45kg' && $modalidade === 'Loja') return false;
  return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_prices') {
  $csrf = $_POST['csrf_token'] ?? '';
  if (!hash_equals($_SESSION['csrf_token'], $csrf)) {
    die("Pedido inválido (CSRF).");
  }

  $prices = $_POST['prices'] ?? [];

  $sql = "
    INSERT INTO precos (zona_id, tipo_gas, modalidade, preco_unit)
    VALUES (?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE preco_unit = VALUES(preco_unit)
  ";
  $stmtUpsert = $pdo->prepare($sql);

  foreach ($prices as $zonaId => $byGas) {
    $zonaId = (int)$zonaId;
    if ($zonaId <= 0 || !is_array($byGas)) continue;

    foreach ($TIPOS_GAS as $tipo) {
      if (!isset($byGas[$tipo]) || !is_array($byGas[$tipo])) continue;

      foreach (['Loja','Domicilio'] as $modalidade) {
        if (!modalidadePermitida($tipo, $modalidade)) {
          continue;
        }

        $raw = $byGas[$tipo][$modalidade] ?? null;
        if ($raw === null) continue;

        $raw = trim((string)$raw);
        $raw = str_replace([' ', '€'], '', $raw);
        $raw = str_replace(',', '.', $raw);

        if ($raw === '') continue;
        if (!preg_match('/^\d+(\.\d{1,2})?$/', $raw)) continue;

        $preco = (float)$raw;
        $stmtUpsert->execute([$zonaId, $tipo, $modalidade, number_format($preco, 2, '.', '')]);
      }
    }
  }

  header("Location: admin.php?ok=precos_atualizados");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete_message') {
  $csrf = $_POST['csrf_token'] ?? '';
  if (!hash_equals($_SESSION['csrf_token'], $csrf)) {
    die("Pedido inválido (CSRF).");
  }

  $mid = (int)($_POST['id'] ?? 0);
  if ($mid > 0) {
    $stmt = $pdo->prepare("DELETE FROM mensagens WHERE id = ?");
    $stmt->execute([$mid]);
    header("Location: admin.php?ok=mensagem_eliminada");
    exit;
  }

  header("Location: admin.php?erro=nao_encontrado");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
  $csrf = $_POST['csrf_token'] ?? '';
  if (!hash_equals($_SESSION['csrf_token'], $csrf)) {
    die("Pedido inválido (CSRF).");
  }

  $id = (int)($_POST['id'] ?? 0);

  if ($id === (int)($_SESSION['user_id'] ?? 0)) {
    header("Location: admin.php?erro=nao_pode_apagar_si");
    exit;
  }

  $stmt = $pdo->prepare("SELECT role FROM utilizadores WHERE id = ?");
  $stmt->execute([$id]);
  $u = $stmt->fetch();

  if (!$u) {
    header("Location: admin.php?erro=nao_encontrado");
    exit;
  }

  if (($u['role'] ?? 'user') === 'admin') {
    header("Location: admin.php?erro=nao_pode_apagar_admin");
    exit;
  }

  $stmt = $pdo->prepare("DELETE FROM utilizadores WHERE id = ?");
  $stmt->execute([$id]);

  header("Location: admin.php?ok=apagado");
  exit;
}

$stmt = $pdo->query("SELECT id, nome, email, telemovel, role, created_at FROM utilizadores ORDER BY created_at DESC");
$users = $stmt->fetchAll();

$stmt = $pdo->query("
  SELECT m.id, m.user_id, m.assunto, m.mensagem, m.resposta, m.created_at, m.responded_at,
         u.nome AS user_nome, u.email AS user_email
  FROM mensagens m
  JOIN utilizadores u ON u.id = m.user_id
  ORDER BY m.created_at DESC
");
$mensagens = $stmt->fetchAll();

$stmt = $pdo->query("
  SELECT
    e.id, e.user_id, e.tipo_gas, e.quantidade, e.estado, e.created_at,
    e.morada, e.observacoes, e.zona_id, e.modalidade,
    e.preco_unit AS encomenda_preco_unit,
    e.valor_total AS encomenda_total,
    u.nome AS user_nome, u.email AS user_email,
    e.telefone AS user_telefone,
    z.nome AS zona_nome,
    p.preco_unit AS tabela_preco_unit
  FROM encomendas e
  JOIN utilizadores u ON u.id = e.user_id
  LEFT JOIN zonas z ON z.id = e.zona_id
  LEFT JOIN precos p
    ON p.zona_id    = e.zona_id
   AND p.tipo_gas   = e.tipo_gas
   AND p.modalidade = e.modalidade
  ORDER BY e.created_at DESC
");
$encomendas = $stmt->fetchAll();

$stmt = $pdo->query("SELECT id, nome FROM zonas ORDER BY nome ASC");
$zonas = $stmt->fetchAll();

$stmt = $pdo->query("SELECT zona_id, tipo_gas, modalidade, preco_unit FROM precos");
$rowsPrecos = $stmt->fetchAll();

$precosMap = []; 
foreach ($rowsPrecos as $r) {
  $z = (int)$r['zona_id'];
  $t = (string)$r['tipo_gas'];
  $m = (string)$r['modalidade'];
  $precosMap[$z][$t][$m] = $r['preco_unit'];
}

function badge($text, $type = 'gray') {
  $map = [
    'gray'   => 'bg-gray-100 text-gray-800',
    'teal'   => 'bg-teal-100 text-teal-800',
    'orange' => 'bg-orange-100 text-orange-800',
    'red'    => 'bg-red-100 text-red-800',
    'green'  => 'bg-green-100 text-green-800',
    'blue'   => 'bg-blue-100 text-blue-800',
  ];
  $cls = $map[$type] ?? $map['gray'];
  return '<span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold '.$cls.'">'.htmlspecialchars($text).'</span>';
}

function encomendaBadgeType($estado) {
  $e = mb_strtolower(trim($estado));
  if (str_contains($e, 'receb')) return 'blue';
  if (str_contains($e, 'process')) return 'orange';
  if (str_contains($e, 'pend')) return 'red';
  if (str_contains($e, 'entreg')) return 'green';
  if (str_contains($e, 'cancel')) return 'gray';
  return 'gray';
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administração | A.J.B.P. Gás</title>
  <link rel="icon" href="img/logo.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins','sans-serif'] } } } }
  </script>

  <script>
    document.addEventListener('click', (e) => {
      document.querySelectorAll('details[open]').forEach((d) => {
        if (!d.contains(e.target)) d.removeAttribute('open');
      });
    });
  </script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

  <?php include('includes/header.php'); ?>

  <main class="flex-1 w-full">
    <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">

      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
          <h1 class="text-3xl font-bold text-teal-800">Painel de Administração</h1>
          <p class="text-gray-600">Gestão de utilizadores, encomendas, preços e suporte.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
          <a href="cliente.php" class="px-4 py-2 rounded-md bg-white border border-gray-200 hover:bg-gray-50 transition font-medium">
            Área de Cliente
          </a>
        </div>
      </div>

      <!-- Alertas -->
      <?php if(isset($_GET['ok']) && $_GET['ok'] === 'apagado'): ?>
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
          Utilizador eliminado com sucesso.
        </div>
      <?php endif; ?>

      <?php if(isset($_GET['ok']) && $_GET['ok'] === 'resposta_enviada'): ?>
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
          Resposta enviada com sucesso.
        </div>
      <?php endif; ?>

      <?php if(isset($_GET['ok']) && $_GET['ok'] === 'encomenda_atualizada'): ?>
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
          Estado da encomenda atualizado.
        </div>
      <?php endif; ?>

      <?php if(isset($_GET['ok']) && $_GET['ok'] === 'mensagem_eliminada'): ?>
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
          Mensagem eliminada com sucesso.
        </div>
      <?php endif; ?>

      <?php if(isset($_GET['ok']) && $_GET['ok'] === 'precos_atualizados'): ?>
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
          Preços atualizados com sucesso.
        </div>
      <?php endif; ?>

      <?php if(isset($_GET['erro'])): ?>
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
          <?php
            $e = $_GET['erro'];
            if ($e === 'nao_pode_apagar_si') echo "Não pode eliminar a sua própria conta.";
            elseif ($e === 'nao_pode_apagar_admin') echo "Não é permitido eliminar contas de admin.";
            elseif ($e === 'nao_encontrado') echo "Registo não encontrado.";
            else echo "Ocorreu um erro.";
          ?>
        </div>
      <?php endif; ?>

      <div class="space-y-8">
        <!-- Preços por Zona -->
        <section class="bg-white rounded-2xl shadow-md overflow-hidden">
          <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <div>
              <h2 class="text-xl font-semibold">Preços por Zona</h2>
              <p class="text-sm text-gray-500 mt-1">Loja / Domicílio</p>
            </div>
            <span class="text-sm text-gray-500"><?= count($zonas) ?> zonas</span>
          </div>

          <form method="POST" class="p-6">
            <input type="hidden" name="action" value="update_prices">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <div class="overflow-x-auto">
              <table class="min-w-full text-left">
                <thead class="bg-gray-50">
                  <tr class="text-sm text-gray-600">
                    <th class="px-4 py-3 font-semibold whitespace-nowrap" rowspan="2">Zona</th>
                    <?php foreach ($TIPOS_GAS as $tipo): ?>
                      <th class="px-4 py-3 font-semibold whitespace-nowrap text-center" colspan="2">
                        <?= htmlspecialchars($tipo) ?>
                      </th>
                    <?php endforeach; ?>
                  </tr>
                  <tr class="text-xs text-gray-500">
                    <?php foreach ($TIPOS_GAS as $tipo): ?>
                      <th class="px-4 py-2 font-semibold text-center whitespace-nowrap">Loja</th>
                      <th class="px-4 py-2 font-semibold text-center whitespace-nowrap">Domicílio</th>
                    <?php endforeach; ?>
                  </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                  <?php foreach ($zonas as $z): ?>
                    <?php $zid = (int)$z['id']; ?>
                    <tr class="hover:bg-gray-50 transition align-top">
                      <td class="px-4 py-4 font-medium whitespace-nowrap">
                        <?= htmlspecialchars($z['nome']) ?>
                      </td>

                      <?php foreach ($TIPOS_GAS as $tipo): ?>
                        <?php
                          $valLoja = $precosMap[$zid][$tipo]['Loja'] ?? '';
                          $valDom  = $precosMap[$zid][$tipo]['Domicilio'] ?? '';

                          $lojaPermitida = modalidadePermitida($tipo, 'Loja');
                          $domPermitida  = modalidadePermitida($tipo, 'Domicilio');
                        ?>

                        <td class="px-4 py-4">
                          <?php if ($lojaPermitida): ?>
                            <div class="relative">
                              <input type="text" inputmode="decimal" name="prices[<?= $zid ?>][<?= htmlspecialchars($tipo) ?>][Loja]" value="<?= htmlspecialchars($valLoja) ?>" placeholder="0.00"
                                class="w-24 md:w-28 border border-gray-300 rounded-md px-3 py-2 pr-8 focus:ring-2 focus:ring-teal-600 focus:border-teal-600 outline-none">
                              <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sm text-gray-400">€</span>
                            </div>
                          <?php else: ?>
                            <div class="w-24 md:w-28 text-center text-gray-400">—</div>
                          <?php endif; ?>
                        </td>

                        <td class="px-4 py-4">
                          <?php if ($domPermitida): ?>
                            <div class="relative">
                              <input type="text" inputmode="decimal" name="prices[<?= $zid ?>][<?= htmlspecialchars($tipo) ?>][Domicilio]" value="<?= htmlspecialchars($valDom) ?>" placeholder="0.00"
                                class="w-24 md:w-28 border border-gray-300 rounded-md px-3 py-2 pr-8 focus:ring-2 focus:ring-teal-600 focus:border-teal-600 outline-none">
                              <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-sm text-gray-400">€</span>
                            </div>
                          <?php else: ?>
                            <div class="w-24 md:w-28 text-center text-gray-400">—</div>
                          <?php endif; ?>
                        </td>
                      <?php endforeach; ?>
                    </tr>
                  <?php endforeach; ?>

                  <?php if (count($zonas) === 0): ?>
                    <tr>
                      <td colspan="<?= 1 + (count($TIPOS_GAS) * 2) ?>" class="px-6 py-10 text-center text-gray-500">
                        Sem zonas registadas.
                      </td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div class="mt-5 flex items-center justify-end gap-3">
              <button type="submit" class="px-5 py-2 rounded-md bg-teal-700 text-white font-medium hover:bg-teal-800">
                Guardar Preços
              </button>
            </div>
          </form>
        </section>

        <!-- Utilizadores -->
        <section class="bg-white rounded-2xl shadow-md overflow-hidden">
          <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-xl font-semibold">Utilizadores</h2>
            <span class="text-sm text-gray-500"><?= count($users) ?> registos</span>
          </div>

          <div class="overflow-x-auto max-h-[520px] overflow-y-auto">
            <table class="min-w-full text-left">
              <thead class="bg-gray-50">
                <tr class="text-sm text-gray-600">
                  <th class="px-6 py-3 font-semibold">Nome</th>
                  <th class="px-6 py-3 font-semibold">Email</th>
                  <th class="px-6 py-3 font-semibold">Role</th>
                  <th class="px-6 py-3 font-semibold text-right">Ações</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100">
                <?php foreach($users as $u): ?>
                  <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium"><?= htmlspecialchars($u['nome']) ?></td>
                    <td class="px-6 py-4 text-sm"><?= htmlspecialchars($u['email']) ?></td>
                    <td class="px-6 py-4 text-sm">
                      <?= (($u['role'] ?? 'user') === 'admin') ? badge('admin','teal') : badge('user','gray'); ?>
                    </td>

                    <td class="px-6 py-4 text-right">
                      <?php if(($u['role'] ?? 'user') !== 'admin'): ?>
                        <form method="POST" class="inline" onsubmit="return confirm('Tens a certeza que queres eliminar este utilizador?');">
                          <input type="hidden" name="action" value="delete">
                          <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
                          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                          <button type="submit" class="px-3 py-2 rounded-md bg-red-600 text-white text-sm font-semibold hover:bg-red-700 transition">
                            Eliminar
                          </button>
                        </form>
                      <?php else: ?>
                        <span class="text-sm text-gray-400">—</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>

                <?php if(count($users) === 0): ?>
                  <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">Sem utilizadores registados.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>

        <!-- Encomendas-->
        <section class="bg-white rounded-2xl shadow-md overflow-hidden">
          <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-xl font-semibold">Encomendas</h2>
            <span class="text-sm text-gray-500"><?= count($encomendas) ?> registos</span>
          </div>

          <div class="overflow-x-auto max-h-[520px] overflow-y-auto">
            <table class="min-w-full text-left">
              <thead class="bg-gray-50">
                <tr class="text-sm text-gray-600">
                  <th class="px-6 py-3 font-semibold">Data</th>
                  <th class="px-6 py-3 font-semibold">Cliente</th>
                  <th class="px-6 py-3 font-semibold">Zona</th>
                  <th class="px-6 py-3 font-semibold">Tipo de Gás</th>
                  <th class="px-6 py-3 font-semibold">Quantidade</th>
                  <th class="px-6 py-3 font-semibold">Morada</th>
                  <th class="px-6 py-3 font-semibold">Observações</th>
                  <th class="px-6 py-3 font-semibold whitespace-nowrap">Valor (€)</th>
                  <th class="px-6 py-3 font-semibold">Estado</th>
                  <th class="px-6 py-3 font-semibold text-right">Atualizar</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100">
                <?php foreach($encomendas as $e): ?>
                  <?php
                    $qtd = (int)($e['quantidade'] ?? 0);
                    $unit = $e['encomenda_preco_unit'];
                    $total = $e['encomenda_total'];

                    if ($unit === null && $e['tabela_preco_unit'] !== null) {
                      $unit = $e['tabela_preco_unit'];
                    }
                    if ($total === null && $unit !== null && $qtd > 0) {
                      $total = ((float)$unit) * $qtd;
                    }
                  ?>

                  <tr class="hover:bg-gray-50 transition align-top">
                    <td class="px-6 py-4 text-sm whitespace-nowrap"><?= htmlspecialchars($e['created_at']) ?></td>

                    <td class="px-6 py-4">
                      <div class="font-medium"><?= htmlspecialchars($e['user_nome']) ?></div>
                      <div class="text-sm text-gray-500"><?= htmlspecialchars($e['user_email']) ?></div>
                      <div class="text-sm text-gray-500"><?= !empty($e['user_telefone']) ? htmlspecialchars($e['user_telefone']) : '—' ?></div>
                    </td>

                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                      <?= !empty($e['zona_nome']) ? htmlspecialchars($e['zona_nome']) : '—' ?>
                    </td>

                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                      <?= htmlspecialchars($e['tipo_gas']) ?>
                      <?php if (!empty($e['modalidade'])): ?>
                        <div class="text-xs text-gray-500"><?= htmlspecialchars($e['modalidade']) ?></div>
                      <?php endif; ?>
                    </td>

                    <td class="px-6 py-4 text-sm whitespace-nowrap"><?= htmlspecialchars($e['quantidade']) ?></td>

                    <td class="px-6 py-4 text-sm">
                      <div class="max-w-xs break-words">
                        <?= htmlspecialchars($e['morada'] ?? '—') ?>
                      </div>
                    </td>

                    <td class="px-6 py-4 text-sm">
                      <div class="max-w-xs break-words text-gray-600">
                        <?= !empty($e['observacoes']) ? htmlspecialchars($e['observacoes']) : '—' ?>
                      </div>
                    </td>

                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                      <?php if ($total !== null): ?>
                        <?= number_format((float)$total, 2, ',', '.') ?> €
                        <?php if ($unit !== null): ?>
                          <div class="text-xs text-gray-500">
                            (<?= number_format((float)$unit, 2, ',', '.') ?> € / un.)
                          </div>
                        <?php endif; ?>
                      <?php else: ?>
                        <span class="text-gray-400">—</span>
                      <?php endif; ?>
                    </td>

                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                      <?= badge($e['estado'], encomendaBadgeType($e['estado'])); ?>
                    </td>

                    <td class="px-6 py-4 text-right">
                      <form action="encomenda_update.php" method="POST" class="flex items-center gap-3 justify-end">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                        <input type="hidden" name="id" value="<?= (int)$e['id'] ?>">

                        <select name="estado" class="border border-gray-300 rounded-md px-3 py-2">
                          <option value="Recebida" <?= $e['estado']==='Recebida'?'selected':'' ?>>Recebida</option>
                          <option value="Pendente" <?= $e['estado']==='Pendente'?'selected':'' ?>>Pendente</option>
                          <option value="Em processamento" <?= $e['estado']==='Em processamento'?'selected':'' ?>>Em processamento</option>
                          <option value="Entregue" <?= $e['estado']==='Entregue'?'selected':'' ?>>Entregue</option>
                          <option value="Cancelada" <?= $e['estado']==='Cancelada'?'selected':'' ?>>Cancelada</option>
                        </select>

                        <button type="submit" class="px-4 py-2 rounded-md bg-teal-700 text-white font-medium hover:bg-teal-800">
                          Guardar
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>

                <?php if(count($encomendas) === 0): ?>
                  <tr>
                    <td colspan="10" class="px-6 py-10 text-center text-gray-500">Ainda não existem encomendas.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>

        <!-- Mensagens -->
        <section class="bg-white rounded-2xl shadow-md overflow-hidden">
          <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-xl font-semibold">Mensagens de Clientes</h2>
            <span class="text-sm text-gray-500"><?= count($mensagens) ?> registos</span>
          </div>

          <div class="overflow-x-auto max-h-[520px] overflow-y-auto">
            <table class="min-w-full text-left">
              <thead class="bg-gray-50">
                <tr class="text-sm text-gray-600">
                  <th class="px-6 py-3 font-semibold">Data</th>
                  <th class="px-6 py-3 font-semibold">Cliente</th>
                  <th class="px-6 py-3 font-semibold">Assunto</th>
                  <th class="px-6 py-3 font-semibold">Estado</th>
                  <th class="px-4 py-3 font-semibold">Resposta</th>
                  <th class="px-4 py-3 font-semibold text-right">Ações</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100">
                <?php foreach($mensagens as $m): ?>
                  <tr class="hover:bg-gray-50 transition align-top">
                    <td class="px-6 py-4 text-sm whitespace-nowrap"><?= htmlspecialchars($m['created_at']) ?></td>

                    <td class="px-6 py-4">
                      <div class="font-medium"><?= htmlspecialchars($m['user_nome']) ?></div>
                      <div class="text-sm text-gray-500"><?= htmlspecialchars($m['user_email']) ?></div>
                    </td>

                    <td class="px-4 py-4">
                      <div class="font-medium break-all"><?= htmlspecialchars($m['assunto']) ?></div>
                      <div class="text-sm text-gray-500 mt-1 whitespace-pre-wrap break-all max-h-40 min-w-40 overflow-auto pr-2"><?= htmlspecialchars($m['mensagem']) ?></div>
                    </td>

                    <td class="px-6 py-4 text-sm whitespace-nowrap">
                      <?= !empty($m['resposta']) ? badge('Respondida','teal') : badge('Aberta','orange'); ?>
                    </td>

                    <td class="px-4 py-4">
                      <?php if(!empty($m['resposta'])): ?>
                        <div class="rounded-lg border border-teal-100 bg-teal-50 p-3 text-sm text-teal-900">
                          <div class="font-semibold mb-1">Resposta</div>
                          <div class="whitespace-pre-wrap break-all max-h-40 min-w-40 overflow-auto pr-2"><?= htmlspecialchars($m['resposta']) ?></div>
                          <?php if(!empty($m['responded_at'])): ?>
                            <div class="text-xs text-teal-700 mt-2">
                              Respondida em: <?= htmlspecialchars($m['responded_at']) ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      <?php else: ?>
                        <span class="text-sm text-gray-400">—</span>
                      <?php endif; ?>
                    </td>

                    <td class="px-4 py-4 text-right whitespace-nowrap">
                      <div class="relative inline-block text-left">
                        <details class="group">
                          <summary class="list-none cursor-pointer select-none rounded-lg border border-gray-200 bg-white hover:bg-gray-50 shadow-sm h-10 w-10 p-0 grid place-items-center" aria-label="Ações">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-gray-700">
                              <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                          </summary>

                          <div class="absolute right-0 mt-2 w-44 origin-top-right rounded-xl border border-gray-100 bg-white shadow-lg p-2 z-20">
                            <a href="admin_responder.php?id=<?= (int)$m['id'] ?>" class="flex items-center gap-2 w-full px-3 py-2 rounded-lg hover:bg-gray-50 text-sm font-medium text-teal-800">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10 9V5l-7 7 7 7v-4.1c5 0 8.5 1.6 11 5.1-1-7-4-11-11-11z"/>
                              </svg>
                              Responder
                            </a>

                            <form method="POST" onsubmit="return confirm('Eliminar esta mensagem?');">
                              <input type="hidden" name="action" value="delete_message">
                              <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                              <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                              <button type="submit" class="flex items-center gap-2 w-full px-3 py-2 rounded-lg hover:bg-red-50 text-sm font-medium text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                  <path d="M9 3h6l1 2h5v2H3V5h5l1-2zm1 7h2v9h-2v-9zm4 0h2v9h-2v-9z"/>
                                </svg>
                                Eliminar
                              </button>
                            </form>
                          </div>
                        </details>
                      </div>
                    </td>

                  </tr>
                <?php endforeach; ?>

                <?php if(count($mensagens) === 0): ?>
                  <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">Ainda não existem mensagens.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>

      </div>

    </div>
  </main>

  <?php include('includes/footer.php'); ?>

</body>
</html>
