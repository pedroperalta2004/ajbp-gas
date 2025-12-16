<?php
require 'includes/auth.php';
require 'includes/connection.php';

$userId = (int)($_SESSION['user_id'] ?? 0);

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'send_message') {
  $csrf = $_POST['csrf_token'] ?? '';
  if (!hash_equals($_SESSION['csrf_token'], $csrf)) {
    header("Location: cliente.php?msg=csrf");
    exit;
  }

  $assunto  = trim($_POST['assunto'] ?? '');
  $mensagem = trim($_POST['mensagem'] ?? '');

  if ($assunto === '' || $mensagem === '') {
    header("Location: cliente.php?msg=campos");
    exit;
  }

  if (mb_strlen($assunto) > 100) $assunto = mb_substr($assunto, 0, 100);
  if (mb_strlen($mensagem) > 5000) $mensagem = mb_substr($mensagem, 0, 5000);

  $stmt = $pdo->prepare("INSERT INTO mensagens (user_id, assunto, mensagem) VALUES (?, ?, ?)");
  $stmt->execute([$userId, $assunto, $mensagem]);

  header("Location: cliente.php?msg=enviada#mensagens");
  exit;
}

$stmt = $pdo->prepare("
  SELECT
    e.id,
    e.tipo_gas,
    e.modalidade,
    e.quantidade,
    e.estado,
    e.created_at,
    e.morada,
    e.observacoes,
    z.nome AS zona_nome,
    e.preco_unit,
    e.valor_total
  FROM encomendas e
  LEFT JOIN zonas z
    ON z.id = e.zona_id
  WHERE e.user_id = ?
  ORDER BY e.created_at DESC
");
$stmt->execute([$userId]);
$encomendas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("
  SELECT id, assunto, mensagem, resposta, created_at, responded_at
  FROM mensagens
  WHERE user_id = ?
  ORDER BY created_at DESC
");
$stmt->execute([$userId]);
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
  return '<span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold '.$cls.'">'.htmlspecialchars((string)$text).'</span>';
}

function estadoEncomendaType($estado) {
  $e = mb_strtolower(trim((string)$estado));
  if (str_contains($e, 'receb')) return 'blue';
  if (str_contains($e, 'process')) return 'orange';
  if (str_contains($e, 'pend')) return 'red';
  if (str_contains($e, 'entreg')) return 'green';
  if (str_contains($e, 'cancel')) return 'gray';
  return 'gray';
}

function euro($v) {
  if ($v === null || $v === '' || !is_numeric($v)) return '—';
  return number_format((float)$v, 2, ',', '.') . ' €';
}

function toFloat($v) {
  $s = trim((string)$v);
  if ($s === '') return 0.0;
  $s = str_replace([' ', '€'], '', $s);
  $s = str_replace(',', '.', $s);
  if (!is_numeric($s)) return 0.0;
  return (float)$s;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Área de Cliente | A.J.B.P. Gás</title>
  <link rel="icon" href="img/logo.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script>
    tailwind.config = {
      theme: { extend: { fontFamily: { sans: ['Poppins','sans-serif'] } } }
    }
  </script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">

  <?php include('includes/header.php'); ?>

  <main class="flex-1 w-full">
    <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">

      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
          <h1 class="text-3xl font-bold text-teal-800">Área de Cliente</h1>
          <p class="text-gray-600">Consulte as suas encomendas e fala connosco através das mensagens.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3">
          <a href="#encomendas" class="px-4 py-2 rounded-md bg-white border border-gray-200 hover:bg-gray-50 transition font-medium">
            Encomendas
          </a>
          <a href="#mensagens" class="px-4 py-2 rounded-md bg-white border border-gray-200 hover:bg-gray-50 transition font-medium">
            Mensagens
          </a>
        </div>
      </div>

      <!-- Alertas -->
      <?php if(isset($_GET['ok']) && $_GET['ok'] === 'encomenda_enviada'): ?>
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
          Encomenda enviada com sucesso.
        </div>
      <?php endif; ?>

      <?php if(isset($_GET['msg'])): ?>
        <?php if($_GET['msg'] === 'enviada'): ?>
          <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            Mensagem enviada com sucesso.
          </div>
        <?php elseif($_GET['msg'] === 'campos'): ?>
          <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
            Preenche o assunto e a mensagem.
          </div>
        <?php elseif($_GET['msg'] === 'csrf'): ?>
          <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-red-800">
            Pedido inválido. Tenta novamente.
          </div>
        <?php endif; ?>
      <?php endif; ?>

      <div class="space-y-8">

        <!-- Encomendas -->
        <section id="encomendas" class="bg-white rounded-2xl shadow-md overflow-hidden">
          <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-xl font-semibold">Encomendas</h2>
            <span class="text-sm text-gray-500"><?= count($encomendas) ?> registos</span>
          </div>

          <div class="overflow-x-auto max-h-[520px] overflow-y-auto">
            <table class="min-w-full text-left">
              <thead class="bg-gray-50">
                <tr class="text-sm text-gray-600">
                  <th class="px-6 py-3 font-semibold">Data</th>
                  <th class="px-6 py-3 font-semibold">Zona</th>
                  <th class="px-6 py-3 font-semibold">Tipo de Gás</th>
                  <th class="px-6 py-3 font-semibold">Modalidade</th>
                  <th class="px-6 py-3 font-semibold">Quantidade</th>
                  <th class="px-6 py-3 font-semibold">Morada</th>
                  <th class="px-6 py-3 font-semibold">Observações</th>
                  <th class="px-6 py-3 font-semibold">Valor</th>
                  <th class="px-6 py-3 font-semibold">Estado</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100">
                <?php if(count($encomendas) === 0): ?>
                  <tr>
                    <td colspan="9" class="px-6 py-10 text-center text-gray-500">Ainda não existem encomendas.</td>
                  </tr>
                <?php else: ?>
                  <?php foreach($encomendas as $e): ?>
                    <?php
                      $qtd      = toFloat($e['quantidade'] ?? 0);
                      $unit     = is_numeric($e['preco_unit'] ?? null) ? (float)$e['preco_unit'] : null;
                      $total    = is_numeric($e['valor_total'] ?? null) ? (float)$e['valor_total'] : null;
                      $zonaNome = $e['zona_nome'] ?? null;

                      if ($total === null && $unit !== null) {
                        $total = $unit * $qtd;
                      }
                    ?>
                    <tr class="hover:bg-gray-50 transition align-top">
                      <td class="px-6 py-4 text-sm whitespace-nowrap"><?= htmlspecialchars((string)$e['created_at']) ?></td>

                      <td class="px-6 py-4 text-sm whitespace-nowrap">
                        <?= $zonaNome ? htmlspecialchars($zonaNome) : '<span class="text-gray-400">—</span>' ?>
                      </td>

                      <td class="px-6 py-4 text-sm whitespace-nowrap"><?= htmlspecialchars((string)$e['tipo_gas']) ?></td>

                      <td class="px-6 py-4 text-sm whitespace-nowrap">
                        <?= htmlspecialchars((string)($e['modalidade'] ?? '—')) ?>
                      </td>

                      <td class="px-6 py-4 text-sm whitespace-nowrap"><?= htmlspecialchars((string)$e['quantidade']) ?></td>

                      <td class="px-6 py-4 text-sm">
                        <?php if(!empty($e['morada'])): ?>
                          <div class="max-w-xs break-words"><?= nl2br(htmlspecialchars((string)$e['morada'])) ?></div>
                        <?php else: ?>
                          <span class="text-gray-400">—</span>
                        <?php endif; ?>
                      </td>

                      <td class="px-6 py-4 text-sm">
                        <?php if(!empty($e['observacoes'])): ?>
                          <div class="max-w-xs break-words"><?= nl2br(htmlspecialchars((string)$e['observacoes'])) ?></div>
                        <?php else: ?>
                          <span class="text-gray-400">—</span>
                        <?php endif; ?>
                      </td>

                      <td class="px-6 py-4 text-sm whitespace-nowrap font-semibold">
                        <?= euro($total) ?>
                        <?php if($unit === null && $total === null): ?>
                          <div class="text-xs text-gray-400 font-normal">sem preço definido</div>
                        <?php endif; ?>
                      </td>

                      <td class="px-6 py-4 text-sm whitespace-nowrap">
                        <?= badge($e['estado'], estadoEncomendaType($e['estado'])); ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>

        <!-- Mensagens -->
        <section id="mensagens" class="bg-white rounded-2xl shadow-md overflow-hidden">
          <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-xl font-semibold">Mensagens</h2>
            <p class="text-sm text-gray-500 mt-1">Envie uma mensagem ao suporte e acompanhe as respostas.</p>
          </div>

          <div class="p-6 border-b border-gray-100">
            <form method="POST" class="space-y-4">
              <input type="hidden" name="action" value="send_message">
              <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

              <div>
                <label class="block font-medium mb-1">Assunto</label>
                <input type="text" name="assunto" required maxlength="100" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Ex.: Dúvida sobre entrega">
              </div>

              <div>
                <label class="block font-medium mb-1">Mensagem</label>
                <textarea name="mensagem" required rows="5" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Escreva a sua mensagem..."></textarea>
              </div>

              <div>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-md transition">
                  Enviar Mensagem
                </button>
              </div>
            </form>
          </div>

          <div class="overflow-x-auto max-h-[520px] overflow-y-auto">
            <table class="min-w-full text-left">
              <thead class="bg-gray-50">
                <tr class="text-sm text-gray-600">
                  <th class="px-6 py-3 font-semibold">Data</th>
                  <th class="px-6 py-3 font-semibold">Assunto</th>
                  <th class="px-6 py-3 font-semibold">Estado</th>
                  <th class="px-6 py-3 font-semibold">Resposta</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100">
                <?php if(count($mensagens) === 0): ?>
                  <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">Ainda não tem mensagens.</td>
                  </tr>
                <?php else: ?>
                  <?php foreach($mensagens as $m): ?>
                    <tr class="hover:bg-gray-50 transition align-top">
                      <td class="px-6 py-4 text-sm whitespace-nowrap">
                        <?= htmlspecialchars((string)$m['created_at']) ?>
                      </td>

                      <td class="px-6 py-4">
                        <div class="font-medium break-all"><?= htmlspecialchars((string)$m['assunto']) ?></div>
                        <div class="text-sm text-gray-500 mt-1 whitespace-pre-wrap break-all max-h-40 min-w-40 overflow-auto pr-2"><?= htmlspecialchars((string)$m['mensagem']) ?></div>
                      </td>

                      <td class="px-6 py-4 text-sm whitespace-nowrap">
                        <?= !empty($m['resposta']) ? badge('Respondida','teal') : badge('Aberta','orange'); ?>
                      </td>

                      <td class="px-6 py-4 text-sm">
                        <?php if(!empty($m['resposta'])): ?>
                          <div class="rounded-lg border border-teal-100 bg-teal-50 p-3 text-sm text-teal-900">
                            <div class="font-semibold mb-1">Resposta</div>
                            <div class="whitespace-pre-wrap break-all max-h-40 overflow-auto min-w-40 pr-2 text-gray-700"><?= htmlspecialchars((string)$m['resposta']) ?></div>
                            <?php if(!empty($m['responded_at'])): ?>
                              <div class="text-xs text-teal-700 mt-2">
                                Respondida em: <?= htmlspecialchars((string)$m['responded_at']) ?>
                              </div>
                            <?php endif; ?>
                          </div>
                        <?php else: ?>
                          <span class="text-gray-400">—</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
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
