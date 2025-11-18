<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabela de Preços - Tarouca / Armamar | A.J.B.P. Gás</title>
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
  <section class="relative h-[45vh] md:h-[50vh] flex items-center justify-center text-center bg-gray-900">
    <img src="img/gas-bg.png" alt="Tabela de Preços Tarouca/Armamar" class="absolute inset-0 w-full h-full object-cover brightness-50 blur-sm">
    <h1 class="relative z-10 text-4xl md:text-5xl font-extrabold text-white px-4">Tabela de Preços – Tarouca / Armamar</h1>
  </section>


  <!-- CONTEÚDO -->
  <main class="py-20 px-[10%] bg-white text-center">
    <h2 class="text-3xl font-semibold text-orange-500 mb-8">Preços de Gás Engarrafado</h2>
    <p class="text-gray-700 mb-10 max-w-3xl mx-auto">
      A tabela abaixo apresenta os preços atualizados para a cidade de <strong>Tarouca</strong> e <strong>Armamar</strong>, incluindo a entrega ao domicílio.  
      Todos os valores incluem IVA à taxa legal em vigor.
    </p>

    <!-- TABELA -->
    <div class="overflow-x-auto">
      <table class="min-w-full border border-gray-200 rounded-lg shadow-sm">
        <thead class="bg-orange-500 text-white">
          <tr>
            <th class="py-3 px-6 text-left font-semibold">Produto</th>
            <th class="py-3 px-6 text-left font-semibold">Tipo</th>
            <th class="py-3 px-6 text-center font-semibold">Capacidade</th>
            <th class="py-3 px-6 text-center font-semibold">Preço (€)</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <tr class="hover:bg-orange-50 transition">
            <td class="py-3 px-6 text-left">Botija Butano Rubis</td>
            <td class="py-3 px-6 text-left">Doméstico</td>
            <td class="py-3 px-6 text-center">13 kg</td>
            <td class="py-3 px-6 text-center font-semibold text-gray-800">28,50</td>
          </tr>
          <tr class="hover:bg-orange-50 transition">
            <td class="py-3 px-6 text-left">Botija Propano Rubis</td>
            <td class="py-3 px-6 text-left">Doméstico / Comercial</td>
            <td class="py-3 px-6 text-center">11 kg</td>
            <td class="py-3 px-6 text-center font-semibold text-gray-800">26,00</td>
          </tr>
          <tr class="hover:bg-orange-50 transition">
            <td class="py-3 px-6 text-left">Botija Propano Industrial</td>
            <td class="py-3 px-6 text-left">Industrial</td>
            <td class="py-3 px-6 text-center">45 kg</td>
            <td class="py-3 px-6 text-center font-semibold text-gray-800">96,00</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="mt-20">
      <a href="encomendar.php" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-md font-semibold transition">
        Encomendar Gás
      </a>
    </div>
  </main>

  <?php include('includes/footer.php'); ?>

</body>
</html>
