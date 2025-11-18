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
    <img src="img/gas-bg.png" alt="Serviços A.J.B.P." class="absolute inset-0 w-full h-full object-cover brightness-50 blur-sm">
    <h1 class="relative z-10 text-4xl md:text-5xl font-bold">Os Nossos Serviços</h1>
  </section>

  <!-- SERVIÇOS PRINCIPAIS -->
  <main class="py-20 px-[10%] bg-white text-center">
    <h2 class="text-3xl font-semibold text-orange-500 mb-10">Soluções completas em gás</h2>
    <div class="grid gap-12 md:grid-cols-2">
      
      <!-- Entrega de Gás Engarrafado -->
      <div class="bg-gray-50 rounded-xl shadow-md p-8 text-left hover:shadow-lg transition">
        <div class="flex items-center gap-4 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M5 7v10a2 2 0 002 2h10a2 2 0 002-2V7M9 12h6" />
          </svg>
          <h3 class="text-2xl font-semibold">Entrega de Gás Engarrafado</h3>
        </div>
        <p class="text-gray-700 leading-relaxed mb-4">
          A <strong>A.J.B.P.</strong> realiza entregas rápidas e seguras de botijas de gás ao domicílio e a empresas.
          Garantimos a disponibilidade imediata dos produtos e o cumprimento rigoroso das normas de segurança.
        </p>
        <ul class="text-left text-gray-600 list-disc ml-6">
          <li>Entregas ao domicílio em Tarouca, Armamar, Castro Daire e Lamego</li>
          <li>Botijas de várias capacidades (butano e propano)</li>
          <li>Verificação de fugas e estado do equipamento</li>
          <li>Atendimento rápido e personalizado</li>
        </ul>
      </div>

      <!-- Instalação de Sistemas de Gás -->
      <div class="bg-gray-50 rounded-xl shadow-md p-8 text-left hover:shadow-lg transition">
        <div class="flex items-center gap-4 mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v3m0 12v3m9-9h-3M6 12H3m15.364-7.364l-2.121 2.121M7.757 16.243l-2.121 2.121M16.243 16.243l2.121 2.121M7.757 7.757L5.636 5.636" />
          </svg>
          <h3 class="text-2xl font-semibold">Instalação e Manutenção de Redes de Gás</h3>
        </div>
        <p class="text-gray-700 leading-relaxed mb-4">
          Dispomos de técnicos certificados para a montagem e manutenção de redes e sistemas de gás canalizado, tanto em residências como em estabelecimentos comerciais e industriais.
        </p>
        <ul class="text-left text-gray-600 list-disc ml-6">
          <li>Projetos e instalação de redes de gás canalizado</li>
          <li>Verificação técnica e certificação de segurança</li>
          <li>Manutenção preventiva e corretiva</li>
          <li>Serviço autorizado pela Rubis Gás</li>
        </ul>
      </div>

    </div>
  </main>

  <!-- SECÇÃO FINAL -->
  <section class="py-16 px-[10%] bg-gray-100 text-center">
    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Precisa de um serviço?</h2>
    <p class="text-gray-700 mb-6">Contacte-nos para agendar uma instalação, pedir um orçamento ou solicitar a entrega de gás.</p>
    <a href="contactos.php" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-md font-semibold transition">
      Fale Connosco
    </a>
  </section>

  <?php include('includes/footer.php'); ?>

</body>
</html>
