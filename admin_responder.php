<?php
require 'includes/admin_auth.php';
require 'includes/connection.php';

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// CSRF
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// ID da mensagem (GET)
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    header("Location: admin.php");
    exit;
}

// Buscar mensagem
$stmt = $pdo->prepare("
    SELECT m.*, u.nome, u.email
    FROM mensagens m
    JOIN utilizadores u ON u.id = m.user_id
    WHERE m.id = ?
");
$stmt->execute([$id]);
$mensagem = $stmt->fetch();

if (!$mensagem) {
    header("Location: admin.php");
    exit;
}

// SUBMISSÃO DO FORMULÁRIO
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        die("CSRF inválido");
    }

    $resposta = trim($_POST['resposta'] ?? '');

    if ($resposta === '') {
        $erro = "A resposta não pode estar vazia.";
    } else {
        $stmt = $pdo->prepare("
            UPDATE mensagens
            SET resposta = ?, responded_at = NOW()
            WHERE id = ?
        ");
        $stmt->execute([$resposta, $id]);

        header("Location: admin.php?ok=resposta_enviada");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responder Mensagem | Administração</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

  <?php include 'includes/header.php'; ?>

  <main class="flex-1 w-full px-4 py-8 sm:py-12">
    <div class="max-w-3xl mx-auto">
      <div class="bg-white rounded-2xl shadow-md p-5 sm:p-8">
        <h1 class="text-xl sm:text-2xl font-bold text-teal-800 mb-6">
          Responder Mensagem
        </h1>

        <div class="mb-6 border rounded-lg p-4 bg-gray-50">
          <p class="font-semibold break-words"><?= htmlspecialchars($mensagem['nome']) ?></p>
          <p class="text-sm text-gray-500 break-words"><?= htmlspecialchars($mensagem['email']) ?></p>

          <div class="mt-4">
            <p class="font-medium">Assunto:</p>
            <p class="text-gray-800 break-words"><?= htmlspecialchars($mensagem['assunto']) ?></p>
          </div>

          <div class="mt-4">
            <p class="font-medium">Mensagem:</p>
            <div class="text-gray-800 whitespace-pre-wrap break-words"><?= htmlspecialchars($mensagem['mensagem']) ?></div>
          </div>
        </div>

        <?php if (!empty($erro)): ?>
          <div class="mb-4 bg-red-100 text-red-800 px-4 py-2 rounded">
            <?= htmlspecialchars($erro) ?>
          </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

          <div>
            <label class="block font-medium mb-1">Resposta</label>
            <textarea name="resposta" rows="6" class="w-full border rounded-md px-4 py-2 focus:ring-2 focus:ring-teal-600" required><?= htmlspecialchars($mensagem['resposta'] ?? '') ?></textarea>
          </div>

          <div class="flex flex-col sm:flex-row gap-3">
            <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white px-6 py-2 rounded-md font-semibold w-full sm:w-auto">
              Enviar Resposta
            </button>

            <a href="admin.php" class="px-6 py-2 rounded-md border border-gray-300 hover:bg-gray-50 text-center w-full sm:w-auto">
              Cancelar
            </a>
          </div>
        </form>

      </div>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>

</body>
</html>
