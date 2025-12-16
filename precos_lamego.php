<?php
require 'includes/connection.php';

$zonaNome = 'Lamego';
$zonaId = null;
$precos = [];

$stmt = $pdo->prepare("SELECT id FROM zonas WHERE nome = ? LIMIT 1");
$stmt->execute([$zonaNome]);
$zona = $stmt->fetch(PDO::FETCH_ASSOC);

if ($zona) {
  $zonaId = (int)$zona['id'];

  $stmt = $pdo->prepare("SELECT tipo_gas, modalidade, preco_unit FROM precos WHERE zona_id = ?");
  $stmt->execute([$zonaId]);

  foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $tipo = (string)$row['tipo_gas'];
    $mod  = (string)$row['modalidade'];
    $precos[$tipo][$mod] = $row['preco_unit'];
  }
}

function euro($v) {
  if ($v === null || $v === '') return '—';
  return number_format((float)$v, 2, ',', '.') . ' €';
}
function preco($precos, $tipo, $modalidade) {
  return $precos[$tipo][$modalidade] ?? null;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Preços - Lamego | A.J.B.P. Gás</title>
  <link rel="icon" href="img/logo.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Poppins', 'sans-serif'] }
        }
      }
    }
  </script>
</head>

<body class="bg-gray-200 text-gray-800 font-sans">
  <?php include('includes/header.php'); ?>

  <!-- CONTEÚDO -->
  <main class="relative py-16 md:py-20 px-[6%] text-center overflow-hidden">
    <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at 20% 10%, rgba(255,255,255,.35), transparent 40%), radial-gradient(circle at 80% 30%, rgba(255,255,255,.25), transparent 45%), radial-gradient(circle at 40% 90%, rgba(255,255,255,.25), transparent 50%);"></div>
    <section class="relative z-10 py-10 md:py-14 px-5 md:px-10 bg-gray-50/95 backdrop-blur rounded-3xl max-w-6xl mx-auto shadow-xl border border-white/40">

      <div class="text-center mb-10">
        <p class="text-sm tracking-wide text-teal-800/80 mb-2">Preços em vigor</p>
        <h2 class="text-3xl md:text-4xl font-extrabold text-teal-800 leading-tight">
          Tabela de Preços
        </h2>
        <p class="text-2xl md:text-3xl font-extrabold text-teal-700 mt-2">
          <?= htmlspecialchars($zonaNome) ?>
        </p>

        <div class="mt-5 flex flex-wrap justify-center gap-2 text-sm text-gray-600">
          <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 shadow-sm border border-gray-100">
            <span class="h-2 w-2 rounded-full bg-orange-500"></span>
            Entrega rápida ao domicílio
          </span>
          <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 shadow-sm border border-gray-100">
            <span class="h-2 w-2 rounded-full bg-teal-600"></span>
            Serviço autorizado Rubis Gás
          </span>
        </div>

        <?php if (!$zonaId): ?>
          <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 text-sm">
            Não foi possível encontrar a zona <strong><?= htmlspecialchars($zonaNome) ?></strong> na base de dados.
          </div>
        <?php endif; ?>
      </div>

      <!-- GRELHA -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-7 md:gap-8 mx-auto">

        <!-- PROPANO 11 KG -->
        <div class="group bg-white rounded-3xl shadow-md border border-gray-100 p-6 flex flex-col sm:flex-row items-center gap-6 hover:shadow-xl hover:-translate-y-0.5 transition duration-300">
          <div class="relative">
            <img src="img/botija_propano_11.png" alt="Propano 11 kg" class="h-32 sm:h-40 object-contain">
          </div>

          <div class="flex-1 text-center sm:text-left">
            <h3 class="text-xl font-semibold">Propano 11 kg</h3>
            <p class="text-sm text-gray-500 mt-1 mb-4">Ideal para uso doméstico.</p>

            <div class="grid grid-cols-2 gap-3">
              <div class="rounded-2xl p-4 text-left border border-gray-100 bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-sm">
                <div class="text-xs uppercase tracking-wide opacity-95">Loja</div>
                <div class="text-2xl font-extrabold leading-tight">
                  <?= euro(preco($precos, 'Propano 11kg', 'Loja')) ?>
                </div>
              </div>

              <div class="rounded-2xl p-4 text-left border border-gray-100 bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-sm">
                <div class="text-xs uppercase tracking-wide opacity-95">Domicílio</div>
                <div class="text-2xl font-extrabold leading-tight">
                  <?= euro(preco($precos, 'Propano 11kg', 'Domicilio')) ?>
                </div>
              </div>
            </div>

            <div class="text-xs text-gray-500 mt-3">* Valores indicativos. IVA incl.</div>
          </div>
        </div>

        <!-- LIGHT 12 KG -->
        <div class="group bg-white rounded-3xl shadow-md border border-gray-100 p-6 flex flex-col sm:flex-row items-center gap-6 hover:shadow-xl hover:-translate-y-0.5 transition duration-300">
          <img src="img/botija_light.png" alt="Light 12 kg" class="h-32 sm:h-40 object-contain">

          <div class="flex-1 text-center sm:text-left">
            <h3 class="text-xl font-semibold">Light 12 kg</h3>
            <p class="text-sm text-gray-500 mt-1 mb-4">Mais leve, fácil de transportar.</p>

            <div class="grid grid-cols-2 gap-3">
              <div class="rounded-2xl p-4 text-left border border-gray-100 bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-sm">
                <div class="text-xs uppercase tracking-wide opacity-95">Loja</div>
                <div class="text-2xl font-extrabold leading-tight">
                  <?= euro(preco($precos, 'Light 12kg', 'Loja')) ?>
                </div>
              </div>

              <div class="rounded-2xl p-4 text-left border border-gray-100 bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-sm">
                <div class="text-xs uppercase tracking-wide opacity-95">Domicílio</div>
                <div class="text-2xl font-extrabold leading-tight">
                  <?= euro(preco($precos, 'Light 12kg', 'Domicilio')) ?>
                </div>
              </div>
            </div>

            <div class="text-xs text-gray-500 mt-3">* Valores indicativos. IVA incl.</div>
          </div>
        </div>

        <!-- BUTANO 13 KG -->
        <div class="group bg-white rounded-3xl shadow-md border border-gray-100 p-6 flex flex-col sm:flex-row items-center gap-6 hover:shadow-xl hover:-translate-y-0.5 transition duration-300">
          <img src="img/botija_butano_13.png" alt="Butano 13 kg" class="h-32 sm:h-40 object-contain">

          <div class="flex-1 text-center sm:text-left">
            <h3 class="text-xl font-semibold">Butano 13 kg</h3>
            <p class="text-sm text-gray-500 mt-1 mb-4">Excelente para cozinhar/aquecimento.</p>

            <div class="grid grid-cols-2 gap-3">
              <div class="rounded-2xl p-4 text-left border border-gray-100 bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-sm">
                <div class="text-xs uppercase tracking-wide opacity-95">Loja</div>
                <div class="text-2xl font-extrabold leading-tight">
                  <?= euro(preco($precos, 'Butano 13kg', 'Loja')) ?>
                </div>
              </div>

              <div class="rounded-2xl p-4 text-left border border-gray-100 bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-sm">
                <div class="text-xs uppercase tracking-wide opacity-95">Domicílio</div>
                <div class="text-2xl font-extrabold leading-tight">
                  <?= euro(preco($precos, 'Butano 13kg', 'Domicilio')) ?>
                </div>
              </div>
            </div>

            <div class="text-xs text-gray-500 mt-3">* Valores indicativos. IVA incl.</div>
          </div>
        </div>

        <!-- PROPANO 45 KG -->
        <div class="group bg-white rounded-3xl shadow-md border border-gray-100 p-6 flex flex-col sm:flex-row items-center gap-6 hover:shadow-xl hover:-translate-y-0.5 transition duration-300">
          <img src="img/botija_propano_45.png" alt="Propano 45 kg" class="h-40 sm:h-48 object-contain">

          <div class="flex-1 text-center sm:text-left">
            <h3 class="text-xl font-semibold">Propano 45 kg</h3>
            <p class="text-sm text-gray-500 mt-1 mb-4">Solução para maior consumo.</p>

            <div class="rounded-2xl p-4 text-left border border-gray-100 bg-gradient-to-r from-teal-600 to-teal-800 text-white shadow-sm">
              <div class="text-xs uppercase tracking-wide opacity-95">Domicílio</div>
              <div class="text-2xl font-extrabold leading-tight">
                <?= euro(preco($precos, 'Propano 45kg', 'Domicilio')) ?>
              </div>
            </div>

            <div class="text-xs text-gray-500 mt-3">* Valores indicativos. IVA incl.</div>
          </div>
        </div>

      </div>

      <!-- CTA -->
      <div class="mt-12 text-center">
        <p class="text-gray-600 mb-5">Quer receber em casa? Faça a encomenda em poucos segundos.</p>
        <a href="encomendar.php" class="inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-7 py-3 rounded-full font-medium shadow-md hover:shadow-lg transition">
          Encomendar Gás
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
          </svg>
        </a>
      </div>

    </section>
  </main>

  <?php include('includes/footer.php'); ?>
</body>
</html>
