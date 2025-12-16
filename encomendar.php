<?php
session_start();
require 'includes/connection.php';

$user = null;

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!empty($_SESSION['user_id'])) {
  $stmt = $pdo->prepare("SELECT nome, email, telemovel FROM utilizadores WHERE id = ? LIMIT 1");
  $stmt->execute([$_SESSION['user_id']]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);
}

$stmt = $pdo->query("SELECT id, nome FROM zonas ORDER BY nome ASC");
$zonas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Encomendar Gás | A.J.B.P. Comércio e Distribuição de Gás, Lda.</title>
  <link rel="icon" href="img/logo.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <script>
    tailwind.config = {
      theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } } }
    }
  </script>
</head>

<body class="text-gray-800 font-sans bg-gray-100 min-h-screen flex flex-col">
  <?php include('includes/header.php'); ?>

  <main class="flex-1">
    <!-- HERO -->
    <section class="relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-b from-orange-500 via-orange-400 to-gray-100"></div>
        <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-orange-500/25 blur-3xl"></div>
        <div class="absolute top-10 -right-32 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 h-40 w-[80%] bg-white/20 blur-2xl rounded-full"></div>

      <div class="relative z-10 px-4 py-16 md:py-20">
        <div class="max-w-5xl mx-auto">
          <div class="text-center mb-10">
            <p class="inline-flex items-center gap-2 text-sm text-white/80 bg-white/10 border border-white/10 px-4 py-2 rounded-full">
              Pedido rápido • Entrega ao domicílio
            </p>
            <h1 class="mt-5 text-4xl md:text-5xl font-extrabold text-white tracking-tight">
              Encomendar Gás
            </h1>
            <p class="mt-3 text-white/80 max-w-2xl mx-auto">
              Preencha os seus dados e receba o gás rapidamente no conforto da sua casa.
            </p>
          </div>

          <!-- Card -->
          <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/50 p-7 md:p-10 max-w-3xl mx-auto">

            <?php if (empty($_SESSION['user_id'])): ?>
              <div class="mb-6 rounded-2xl border border-orange-200 bg-orange-50 px-4 py-3 text-orange-900 text-sm">
                <strong>Nota:</strong> Para enviar uma encomenda precisa de iniciar sessão.
                <a href="login.php" class="underline font-semibold ml-1">Iniciar sessão</a>
              </div>
            <?php endif; ?>

            <form action="encomendar_action.php" method="POST" class="space-y-6">
              <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

              <?php if (!empty($_SESSION['user_id'])): ?>
                <input type="hidden" name="user_id" value="<?= (int)$_SESSION['user_id'] ?>">
              <?php endif; ?>

              <input type="hidden" name="modalidade" value="Domicilio">

              <div class="grid md:grid-cols-2 gap-6">
                <div>
                  <label for="nome" class="block font-semibold text-gray-800 mb-1">Nome</label>
                  <input type="text" id="nome" name="nome" required placeholder="Introduza o seu nome" value="<?= htmlspecialchars($user['nome'] ?? '') ?>"
                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition">
                </div>

                <div>
                  <label for="telefone" class="block font-semibold text-gray-800 mb-1">Telefone</label>
                  <input type="tel" id="telefone" name="telefone" required placeholder="Introduza o seu número de telefone" value="<?= htmlspecialchars($user['telemovel'] ?? '') ?>"
                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition">
                </div>
              </div>

              <div>
                <label for="email" class="block font-semibold text-gray-800 mb-1">Email</label>
                <input type="email" id="email" name="email" required placeholder="Introduza o seu email" value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                  class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition">
              </div>

              <div>
                <label for="zona_id" class="block font-semibold text-gray-800 mb-1">Zona</label>
                <select id="zona_id" name="zona_id" required class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition">
                  <option value="">Selecione a sua zona</option>
                  <?php foreach ($zonas as $z): ?>
                    <option value="<?= (int)$z['id'] ?>"><?= htmlspecialchars($z['nome']) ?></option>
                  <?php endforeach; ?>
                </select>

              </div>

              <div>
                <label for="morada" class="block font-semibold text-gray-800 mb-1">Morada de Entrega</label>
                <textarea id="morada" name="morada" required rows="3" placeholder="Introduza a sua morada" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition"></textarea>
              </div>

              <div class="grid md:grid-cols-2 gap-6">
                <div>
                  <label for="tipo" class="block font-semibold text-gray-800 mb-1">Tipo de Gás</label>
                  <select id="tipo" name="tipo" required class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition">
                    <option value="">Selecione uma opção</option>
                    <option value="Propano 11kg">Gás Propano 11kg</option>
                    <option value="Propano 45kg">Gás Propano 45kg</option>
                    <option value="Butano 13kg">Gás Butano 13kg</option>
                    <option value="Light 12kg">Gás Light 12kg</option>
                  </select>
                </div>

                <div>
                  <label for="quantidade" class="block font-semibold text-gray-800 mb-1">Quantidade</label>
                  <select id="quantidade" name="quantidade" required class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition">
                    <option value="">Selecione</option>
                    <option value="1">1 Botija</option>
                    <option value="2">2 Botijas</option>
                    <option value="3">3 Botijas</option>
                    <option value="4">4 Botijas</option>
                    <option value="5">5 Botijas</option>
                  </select>
                </div>
              </div>

              <!-- PREÇO -->
              <div class="rounded-2xl border border-gray-200 bg-white p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                  <div>
                    <div class="text-sm text-gray-600">Preço estimado (Domicílio)</div>
                    <div class="text-xs text-gray-500" id="unitHint"></div>
                  </div>

                  <div class="text-right">
                    <div class="text-3xl font-extrabold text-teal-800" id="totalPrice">—</div>
                    <div class="text-xs text-gray-500" id="unitPrice"></div>
                  </div>
                </div>

                <div class="mt-3 text-xs text-gray-500">
                  * O preço é calculado pela zona e tipo de gás selecionados.
                </div>
              </div>

              <div>
                <label for="observacoes" class="block font-semibold text-gray-800 mb-1">Observações</label>
                <textarea id="observacoes" name="observacoes" rows="3" placeholder="Indique instruções adicionais..." class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-orange-500/20 focus:border-orange-500 outline-none transition"></textarea>
              </div>

              <div class="pt-2 flex flex-col sm:flex-row gap-3 items-center justify-between">
                <p class="text-sm text-gray-600">
                  Ao enviar, o pedido fica registado para acompanhamento.<br>O pagamento é feito no momento da entrega.
                </p>

                <button type="submit" class="inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-7 py-3 rounded-xl font-semibold text-base shadow-md hover:shadow-lg transition">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                  </svg>
                  Enviar Pedido
                </button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </section>
  </main>

  <?php include('includes/footer.php'); ?>

  <!-- calcula preço final -->
  <script>
    const zonaEl = document.getElementById('zona_id');
    const tipoEl = document.getElementById('tipo');
    const qtdEl  = document.getElementById('quantidade');

    const totalEl = document.getElementById('totalPrice');
    const unitEl  = document.getElementById('unitPrice');
    const unitHintEl = document.getElementById('unitHint');

    function euro(v) {
      if (v === null || v === undefined || isNaN(v)) return '—';
      return v.toLocaleString('pt-PT', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' €';
    }

    async function atualizarPreco() {
      totalEl.textContent = '—';
      unitEl.textContent = '';
      unitHintEl.textContent = '';

      const zona_id = zonaEl.value;
      const tipo_gas = tipoEl.value;
      const qtd = parseInt(qtdEl.value || '0', 10);

      if (!zona_id || !tipo_gas || !qtd) return;

      const modalidade = 'Domicilio';

      try {
        const url = `get_preco.php?zona_id=${encodeURIComponent(zona_id)}&tipo_gas=${encodeURIComponent(tipo_gas)}&modalidade=${encodeURIComponent(modalidade)}`;
        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });

        const raw = await res.text();
        let data;
        try { data = JSON.parse(raw); }
        catch (e) {
          unitHintEl.textContent = 'O servidor não devolveu JSON (confirma get_preco.php).';
          return;
        }

        if (!res.ok || !data || !data.ok) {
          unitHintEl.textContent = (data && data.error) ? data.error : 'Erro ao calcular preço.';
          return;
        }

        if (data.price === null) {
          unitHintEl.textContent = 'Preço indisponível para esta opção.';
          return;
        }

        const unit = Number(data.price);
        const total = unit * qtd;

        totalEl.textContent = euro(total);
        unitEl.textContent = `${euro(unit)} / un.`;
      } catch (e) {
        unitHintEl.textContent = 'Erro ao calcular preço.';
      }
    }

    [zonaEl, tipoEl, qtdEl].forEach(el => el.addEventListener('change', atualizarPreco));
  </script>
</body>
</html>
