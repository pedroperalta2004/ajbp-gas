<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre Nós | A.J.B.P. Comércio e Distribuição de Gás, Lda.</title>
  <link rel="icon" href="logo.png" type="image/png">
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
        <span class="text-gray-700">Sobre Nós</span>
      </div>

      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
          <h1 class="text-4xl md:text-5xl font-bold text-teal-800 leading-tight">Sobre Nós</h1>
          <p class="mt-3 text-gray-600 max-w-2xl">
            Conheça a nossa história, missão e valores enquanto empresa de distribuição de gás.
          </p>
        </div>  
      </div>
    </div>
  </section>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="py-14">
    <div class="max-w-6xl mx-auto px-6">

      <!-- Bloco "Quem Somos" -->
      <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
          <div>
            <h2 class="text-3xl font-semibold text-orange-500">Quem Somos</h2>
            <div class="mt-3 h-1 w-16 bg-orange-500 rounded-full"></div>
          </div>
        </div>

        <p class="mt-6 text-[17px] leading-relaxed text-gray-700 max-w-4xl">
          A <strong class="text-gray-900 font-semibold">A.J.B.P. Comércio e Distribuição de Gás, Lda.</strong> é uma empresa portuguesa dedicada à
          distribuição de gás engarrafado e instalação de redes de gás, com mais de 25 anos de experiência no setor energético.
          Comprometemo-nos a oferecer um serviço rápido, seguro e de confiança, garantindo sempre a satisfação dos nossos clientes.
        </p>
      </section>

      <!-- Cards -->
      <section class="mt-10 grid gap-6 md:grid-cols-3">

        <!-- Missão -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7 hover:shadow-md transition">
          <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </span>
            <h3 class="text-xl font-medium text-gray-900">Missão</h3>
          </div>
          <p class="text-gray-700 leading-relaxed">
            Garantir o fornecimento de gás com segurança, rapidez e eficiência, respondendo às necessidades dos nossos clientes.
          </p>
        </div>

        <!-- Visão -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7 hover:shadow-md transition">
          <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </span>
            <h3 class="text-xl font-medium text-gray-900">Visão</h3>
          </div>
          <p class="text-gray-700 leading-relaxed">
            Ser reconhecida como uma referência regional em soluções energéticas sustentáveis e de confiança.
          </p>
        </div>

        <!-- Valores -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7 hover:shadow-md transition">
          <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h6m-9 4h12"/>
              </svg>
            </span>
            <h3 class="text-xl font-medium text-gray-900">Valores</h3>
          </div>
          <p class="text-gray-700 leading-relaxed">
            Segurança, confiança, inovação e proximidade com o cliente são os pilares que sustentam o nosso trabalho diário.
          </p>
        </div>
      </section>

      <!-- CTA -->
      <section class="mt-12">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row items-center justify-between gap-6">
          <div>
            <h4 class="text-xl font-medium text-gray-900">Quer saber como podemos ajudar?</h4>
            <p class="text-gray-600 mt-1">Veja os nossos serviços e escolha a melhor solução.</p>
          </div>
          <a href="servicos.php" class="inline-flex items-center justify-center bg-orange-500 text-white px-6 py-3 rounded-md font-medium hover:bg-orange-600 transition">
            Ver Serviços
          </a>
        </div>
      </section>
    </div>
  </main>

  <?php include('includes/footer.php'); ?>

</body>
</html>
