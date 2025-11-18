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
          fontFamily: {
            sans: ['Poppins', 'sans-serif']
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

  <?php include('includes/header.php'); ?>

  <!-- BACKGROUND C/ TEXTO PRINCIPAL -->
  <section class="relative h-[85vh] w-full overflow-hidden bg-gray-900">
    <img src="img/gas-bg.png" alt="Distribuição de Gás A.J.B.P." class="absolute inset-0 w-full h-full object-cover brightness-50 blur-sm">
    <div class="relative z-10 flex flex-col items-center justify-center text-center text-white h-full">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Distribuição de Gás com Segurança e Confiança</h1>
      <p class="text-lg md:text-xl mb-6">Serviço rápido e seguro ao domicílio — A.J.B.P. Gás ao seu dispor!</p>
    </div>
  </section>

  <!-- SECÇÃO "PRECISA DE GÁS" -->
  <section class="py-20 px-[10%] text-center bg-white">
    <h2 class="text-3xl font-semibold text-orange-500 mb-4">Precisa de gás com urgência?</h2>
    <p class="text-lg max-w-2xl mx-auto mb-8 text-gray-700">
      Entregamos botijas de gás ao domicílio em toda a região — rápido, seguro e com a qualidade que nos distingue há mais de 25 anos.
    </p>
    <div class="flex justify-center gap-4 flex-wrap">
      <a href="encomendar.php" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-md font-semibold transition">
        Encomendar Agora
      </a>
      <a href="sobre.php" class="bg-teal-700 hover:bg-teal-800 text-white px-6 py-3 rounded-md font-semibold transition">
        Saber Mais Sobre Nós
      </a>
    </div>
  </section>

  <!-- SECÇÃO "PORQUE ESCOLHER A.J.B.P. " -->
  <section class="py-20 px-[10%] bg-gray-100 text-center">
    <h2 class="text-3xl font-semibold text-orange-500 mb-10">Porquê escolher a A.J.B.P.?</h2>
    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
      
      <!-- Segurança -->
      <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3l7.5 4.5v9L12 21l-7.5-4.5v-9L12 3z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12l7.5-4.5M12 12v9m0-9L4.5 7.5" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-gray-800">Segurança Garantida</h3>
        <p class="text-gray-600">Cumprimos todas as normas de segurança e qualidade no transporte e instalação de gás.</p>
      </div>

      <!-- Rapidez -->
      <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1M12 8h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-gray-800">Rapidez na Entrega</h3>
        <p class="text-gray-600">Serviço ágil e eficiente.</p>
      </div>

      <!-- Equipa -->
      <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition">
        <div class="flex justify-center mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5V8H2v12h5m10 0H7" />
            <circle cx="9" cy="10" r="2" />
            <circle cx="15" cy="10" r="2" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-2 text-gray-800">Equipa Profissional</h3>
        <p class="text-gray-600">Contamos com técnicos qualificados e formação contínua para garantir o melhor serviço.</p>
      </div>
    </div>
  </section>

  <!-- SECÇÃO "EXPERIÊNCIA" -->
  <section class="py-20 px-[10%] text-center bg-white">
    <h2 class="text-3xl font-semibold text-orange-500 mb-6">Mais de 25 anos de experiência</h2>
    <p class="text-lg text-gray-700 max-w-3xl mx-auto mb-10">
      A A.J.B.P. Gás é uma empresa 100% portuguesa com uma trajetória sólida no setor energético.
      Trabalhamos em parceria com a <strong>Rubis Gás</strong>, uma das principais marcas nacionais,
      garantindo qualidade, segurança e fiabilidade em todos os nossos serviços.
    </p>

    <div class="flex justify-center mt-10">
      <div class="bg-white shadow-lg rounded-2xl p-8 border border-gray-200 hover:shadow-2xl transition duration-300">
        <img src="img/rubisgas-logo.png" alt="Rubis Gás" class="h-24 md:h-32 mx-auto opacity-95 hover:opacity-100 transition duration-300">
      </div>
    </div>
  </section>

  <?php include('includes/footer.php'); ?>

</body>
</html>
