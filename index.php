<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>A.J.B.P. Comércio e Distribuição de Gás, Lda.</title>
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

  <!-- BANNER -->
  <section class="relative h-[85vh] w-full overflow-hidden bg-gray-900">
    <img src="img/rubis1.jpg" alt="Distribuição de Gás A.J.B.P." class="absolute inset-0 w-full h-full object-cover brightness-50 blur-sm">
    <div class="relative z-10 flex flex-col items-center justify-center text-center text-white h-full px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">
        Distribuição de Gás com Segurança e Confiança
      </h1>
      <p class="text-lg md:text-xl mb-6">
        Serviço rápido e seguro ao domicílio - A.J.B.P. Gás ao seu dispor!
      </p>

      <!-- CTA -->
      <div class="flex justify-center gap-3 flex-wrap mt-2">
        <a href="encomendar.php" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-full font-medium shadow-md hover:shadow-lg transition">
          Encomendar Agora
        </a>
        <a href="sobre.php" class="bg-white/10 hover:bg-white/15 text-white px-6 py-3 rounded-full font-medium border border-white/20 backdrop-blur transition">
          Saber Mais Sobre Nós
        </a>
      </div>
    </div>
  </section>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="bg-gray-100">

    <section class="relative py-16 md:py-20">
      <div class="absolute inset-0 pointer-events-none"
        style="background-image:
          radial-gradient(circle at 10% 20%, rgba(20,184,166,.12), transparent 40%),
          radial-gradient(circle at 90% 10%, rgba(249,115,22,.12), transparent 38%),
          radial-gradient(circle at 70% 90%, rgba(20,184,166,.10), transparent 40%);">
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto">
          <p class="text-sm tracking-wide text-teal-800/80 mb-2">Serviço ao domicílio</p>
          <h2 class="text-3xl md:text-4xl font-extrabold text-teal-900">
            Porque escolher a <span class="text-orange-500">A.J.B.P.</span>?
          </h2>
          <p class="mt-4 text-gray-600 leading-relaxed">
            Entregas rápidas, serviço seguro e apoio próximo com a confiança de uma empresa com experiência na região.
          </p>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-3">
          <!-- Segurança -->
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7 hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-4">
              <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2l7 4v6c0 5-3 9-7 10-4-1-7-5-7-10V6l7-4z"/>
                </svg>
              </span>
              <h3 class="text-lg font-semibold text-gray-900">Segurança Garantida</h3>
            </div>
            <p class="text-gray-700 leading-relaxed">
              Cumprimos todas as normas de segurança e qualidade no transporte e fornecimento de gás.
            </p>
          </div>

          <!-- Rapidez -->
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7 hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-4">
              <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M13 2L3 14h7l-1 8 12-14h-7l-1-6z"/>
                </svg>
              </span>
              <h3 class="text-lg font-semibold text-gray-900">Rapidez na Entrega</h3>
            </div>
            <p class="text-gray-700 leading-relaxed">
              Serviço ágil e eficiente ao domicílio com resposta rápida na sua zona.
            </p>
          </div>

          <!-- Equipa -->
          <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-7 hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-4">
              <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M16 11c1.66 0 3-1.57 3-3.5S17.66 4 16 4s-3 1.57-3 3.5S14.34 11 16 11zM8 11c1.66 0 3-1.57 3-3.5S9.66 4 8 4 5 5.57 5 7.5 6.34 11 8 11z"/>
                  <path d="M8 13c-2.67 0-8 1.34-8 4v3h10v-3c0-1.49.82-2.77 2.06-3.66C10.93 13.13 9.46 13 8 13zM16 13c-.34 0-.73.02-1.16.06 1.68 1.02 2.66 2.29 2.66 3.94v3H24v-3c0-2.66-5.33-4-8-4z"/>
                </svg>
              </span>
              <h3 class="text-lg font-semibold text-gray-900">Equipa Profissional</h3>
            </div>
            <p class="text-gray-700 leading-relaxed">
              Técnicos qualificados e proximidade no atendimento para garantir o melhor serviço.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Como funciona -->
    <section class="py-14 md:py-16 bg-white border-y border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
          <div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-teal-900">Como funciona</h2>
            <p class="text-gray-600 mt-2">Em 3 passos simples, recebe a botija em casa.</p>
          </div>

          <a href="encomendar.php" class="inline-flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-full font-semibold shadow-md hover:shadow-lg transition">
            Encomendar Agora
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
          </a>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-3">
          <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
            <div class="text-sm font-semibold text-teal-800">Passo 1</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">Escolha o tipo de gás</div>
            <div class="mt-2 text-gray-600">Propano, Butano ou Light e a quantidade pretendida.</div>
          </div>
          <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
            <div class="text-sm font-semibold text-teal-800">Passo 2</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">Indique a morada</div>
            <div class="mt-2 text-gray-600">Preencha os dados para entrega e, se necessário, observações.</div>
          </div>
          <div class="rounded-2xl border border-gray-100 bg-gray-50 p-6">
            <div class="text-sm font-semibold text-teal-800">Passo 3</div>
            <div class="mt-1 text-lg font-semibold text-gray-900">Receba em casa</div>
            <div class="mt-2 text-gray-600">Confirmamos e entregamos com rapidez e segurança.</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Experiência + Rubis -->
    <section class="py-16 md:py-20 bg-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
          <div>
            <p class="text-sm tracking-wide text-teal-800/80 mb-2">Confiança na região</p>
            <h2 class="text-3xl md:text-4xl font-extrabold text-teal-900 leading-tight">
              Mais de <span class="text-orange-500">25 anos</span> de experiência
            </h2>
            <p class="mt-4 text-gray-700 leading-relaxed">
              A A.J.B.P. Gás é uma empresa 100% portuguesa com uma trajetória sólida no setor energético.
              Trabalhamos em parceria com a <span class="font-semibold text-gray-900">Rubis Gás</span>,
              garantindo qualidade, segurança e fiabilidade em todos os nossos serviços.
            </p>

            <div class="mt-6 flex flex-wrap gap-3">
              <span class="inline-flex items-center rounded-full bg-white px-4 py-2 shadow-sm border border-gray-100 text-sm text-gray-700">
                <span class="h-2 w-2 rounded-full bg-teal-600 mr-2"></span>
                Entrega ao domicílio
              </span>
              <span class="inline-flex items-center rounded-full bg-white px-4 py-2 shadow-sm border border-gray-100 text-sm text-gray-700">
                <span class="h-2 w-2 rounded-full bg-orange-500 mr-2"></span>
                Atendimento próximo
              </span>
              <span class="inline-flex items-center rounded-full bg-white px-4 py-2 shadow-sm border border-gray-100 text-sm text-gray-700">
                <span class="h-2 w-2 rounded-full bg-teal-600 mr-2"></span>
                Serviço seguro
              </span>
            </div>
          </div>

          <div class="flex justify-center lg:justify-end">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-md p-10 w-full max-w-md text-center">
              <div class="text-sm text-gray-500 mb-4">Parceiro</div>
              <img src="img/rubisgas-logo.png" alt="Rubis Gás" class="mx-auto h-20 md:h-24 object-contain">
              <div class="mt-6 text-gray-600 text-sm">
                Qualidade e confiança reconhecidas.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA final -->
    <section class="py-14 bg-teal-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl bg-white/10 border border-white/15 p-8 md:p-10 text-center backdrop-blur">
          <h3 class="text-2xl md:text-3xl font-extrabold text-white">
            Precisa de gás com urgência?
          </h3>
          <p class="mt-3 text-white/80 max-w-2xl mx-auto">
            Faça a encomenda em poucos segundos e receba no conforto da sua casa.
          </p>

          <div class="mt-7 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="encomendar.php" class="inline-flex items-center justify-center bg-orange-500 hover:bg-orange-600 text-white px-7 py-3 rounded-full font-medium shadow-md transition">
              Encomendar Agora
            </a>
            <a href="sobre.php" class="inline-flex items-center justify-center bg-white/10 hover:bg-white/15 text-white px-7 py-3 rounded-full font-medium border border-white/20 transition">
              Saber mais sobre nós
            </a>
          </div>
        </div>
      </div>
    </section>

  </main>

  <?php include('includes/footer.php'); ?>

</body>
</html>
