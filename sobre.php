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

  <!-- BANNER C/ TÍTULO -->
  <section class="relative h-[50vh] flex items-center justify-center bg-gray-900 text-white">
    <img src="img/gas-bg.png" alt="Sobre A.J.B.P." class="absolute inset-0 w-full h-full object-cover brightness-50 blur-sm">
    <h1 class="relative z-10 text-4xl md:text-5xl font-bold">Sobre Nós</h1>
  </section>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="py-16 px-[10%] max-w-7xl mx-auto text-center">
    <h2 class="text-3xl font-semibold text-orange-500 mb-6">Quem Somos</h2>
    <p class="text-lg leading-relaxed mb-10">
      A <strong>A.J.B.P. Comércio e Distribuição de Gás, Lda.</strong> é uma empresa portuguesa dedicada à
      distribuição de gás engarrafado e instalação de redes de gás, com mais de 25 anos de experiência no setor energético.
      Comprometemo-nos a oferecer um serviço rápido, seguro e de confiança, garantindo sempre a
      satisfação dos nossos clientes.
    </p>

    <div class="grid gap-8 md:grid-cols-3">
      <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
        <h3 class="text-xl font-semibold mb-3 text-orange-500">Missão</h3>
        <p>Garantir o fornecimento de gás com segurança, rapidez e eficiência, respondendo às necessidades dos nossos clientes.</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
        <h3 class="text-xl font-semibold mb-3 text-orange-500">Visão</h3>
        <p>Ser reconhecida como uma referência regional em soluções energéticas sustentáveis e de confiança.</p>
      </div>
      <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
        <h3 class="text-xl font-semibold mb-3 text-orange-500">Valores</h3>
        <p>Segurança, confiança, inovação e proximidade com o cliente são os pilares que sustentam o nosso trabalho diário.</p>
      </div>
    </div>

    <div class="mt-12">
      <a href="servicos.php" class="inline-block bg-orange-500 text-white px-6 py-3 rounded-md font-semibold hover:bg-orange-600 transition">
        Ver Serviços
      </a>
    </div>
  </main>

  <?php include('includes/footer.php'); ?>

</body>
</html>
