<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Serviços | A.J.B.P. Comércio e Distribuição de Gás, Lda.</title>
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

<body class="bg-gray-100 text-gray-800 font-sans">

  <?php include('includes/header.php'); ?>

  <!-- PAGE HEADER -->
  <section class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-6 md:px-10 py-10">
      <div class="text-sm text-gray-500 mb-3">
        <a href="index.php" class="hover:text-gray-700">Início</a>
        <span class="mx-2">/</span>
        <span class="text-gray-700">Serviços</span>
      </div>

      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
          <h1 class="text-4xl md:text-5xl font-bold text-teal-800 leading-tight">Serviços</h1>
          <p class="mt-3 text-gray-600 max-w-2xl">
            Soluções completas em gás: entregas ao domicílio, instalação e manutenção de redes com segurança e eficiência.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="py-14">
    <div class="max-w-7xl mx-auto px-6 md:px-10">

      <!-- Título secção -->
      <div class="text-center mb-10">
        <h2 class="text-3xl font-semibold text-orange-500">Soluções completas em gás</h2>
        <p class="mt-3 text-gray-600 max-w-2xl mx-auto">
          Serviços focados em rapidez, confiança e conformidade com as normas de segurança.
        </p>
      </div>

      <!-- Cards serviços -->
      <div class="grid gap-8 lg:grid-cols-2">

        <!-- Entrega de Gás Engarrafado -->
        <div class="bg-white rounded-2xl shadow-md p-8 text-left hover:shadow-lg transition border border-gray-100">
          <div class="flex items-start gap-4 mb-4">
            <div class="shrink-0 rounded-xl bg-orange-50 p-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7M9 12h6" />
              </svg>
            </div>

            <div>
              <h3 class="text-2xl font-semibold">Entrega de Gás Engarrafado</h3>
              <p class="text-gray-500 mt-1">Em loja e ao domicílio</p>
            </div>
          </div>

          <p class="text-gray-700 leading-relaxed mb-5">
            A <strong>A.J.B.P.</strong> realiza entregas seguras de botijas de gás em loja e ao domicílio.
            Garantimos a disponibilidade imediata dos produtos e o cumprimento rigoroso das normas de segurança.
          </p>

          <ul class="text-gray-700 space-y-2">
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Entregas ao domicílio em Tarouca / Armamar, Castro Daire e Lamego</span>
            </li>
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Entregas na nossa loja em Tarouca</span>
            </li>
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Botijas de várias capacidades (butano e propano)</span>
            </li>
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Verificação de fugas e estado do equipamento</span>
            </li>
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Atendimento rápido e personalizado</span>
            </li>
          </ul>
        </div>

        <!-- Instalação e Manutenção de Redes de Gás -->
        <div class="bg-white rounded-2xl shadow-md p-8 text-left hover:shadow-lg transition border border-gray-100">
          <div class="flex items-start gap-4 mb-4">
            <div class="shrink-0 rounded-xl bg-orange-50 p-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3m9-9h-3M6 12H3m15.364-7.364l-2.121 2.121M7.757 16.243l-2.121 2.121M16.243 16.243l2.121 2.121M7.757 7.757L5.636 5.636" />
              </svg>
            </div>

            <div>
              <h3 class="text-2xl font-semibold">Instalação e Manutenção de Redes de Gás</h3>
              <p class="text-gray-500 mt-1">Residencial, comercial e industrial</p>
            </div>
          </div>

          <p class="text-gray-700 leading-relaxed mb-5">
            Dispomos de técnicos certificados para a montagem e manutenção de redes e sistemas de gás canalizado,
            tanto em residências como em estabelecimentos comerciais e industriais.
          </p>

          <ul class="text-gray-700 space-y-2">
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Projetos e instalação de redes de gás canalizado</span>
            </li>
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Verificação técnica e certificação de segurança</span>
            </li>
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Manutenção preventiva e corretiva</span>
            </li>
            <li class="flex gap-3">
              <span class="mt-2 h-2 w-2 rounded-full bg-orange-500 shrink-0"></span>
              <span>Serviço autorizado pela Rubis Gás</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- CTA -->
      <section class="mt-12">
        <div class="rounded-2xl bg-white border border-gray-100 shadow-md p-10 text-center">
          <h2 class="text-2xl font-semibold text-orange-500 mb-3">Precisa de um serviço?</h2>
          <p class="text-gray-700 mb-6 max-w-2xl mx-auto">
            Contacte-nos para agendar uma instalação, pedir um orçamento ou solicitar a entrega de gás.
          </p>
          <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="encomendar.php" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-md font-medium transition">
              Encomendar Gás
            </a>
            <a href="contactos.php" class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-800 px-6 py-3 rounded-md font-medium transition">
              Fale Connosco
            </a>
          </div>
        </div>
      </section>

    </div>
  </main>

  <?php include('includes/footer.php'); ?>

</body>
</html>
