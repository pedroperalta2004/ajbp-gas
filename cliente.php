<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Área de Cliente | A.J.B.P. Gás</title>
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

<body class="min-h-screen flex bg-gray-100 font-sans">

  <!-- SIDEBAR -->
  <aside class="w-64 bg-teal-800 text-white flex flex-col justify-between p-6 shadow-lg">

    <div>
      <div class="flex justify-center mb-6">
        <img src="img/logo_white.png" alt="Logotipo A.J.B.P. Gás" class="h-16">
      </div>

      <h2 class="text-xl font-semibold mb-4">Área de Cliente</h2>

      <nav class="space-y-2">
        <!-- Encomendas -->
        <a href="#encomendas" class="flex items-center gap-2 px-3 py-3 rounded-lg bg-teal-900 font-medium text-white">
          <svg xmlns="http://www.w3.org/2000/svg" 
              viewBox="0 0 24 24" 
              class="h-5 w-5">
            <path fill="#D6A77A" d="M3 7l9-4 9 4-9 4z"/>
            <path fill="#C29267" d="M12 11l9-4v9l-9 4z"/>
            <path fill="#B07F57" d="M12 11L3 7v9l9 4z"/>
          </svg>
          Encomendas
        </a>

        <!-- Faturas -->
        <a href="#faturas" 
          class="flex items-center gap-2 px-3 py-3 rounded-lg hover:bg-teal-900 transition font-medium text-white">
          <svg xmlns="http://www.w3.org/2000/svg" 
              viewBox="0 0 24 24" 
              class="h-5 w-5">
            <path fill="#E4E4E4" d="M6 2h9l5 5v15H6z"/>
            <path fill="#CCCCCC" d="M15 2v5h5z"/>
          </svg>
          Faturas
        </a>
      </nav>
    </div>

    <div class="mt-6 text-center">
      <a href="index.php" class="inline-block bg-white text-teal-800 font-semibold px-5 py-2 rounded-lg shadow-md hover:bg-teal-600 hover:text-white transition">
         Sair
      </a>
    </div>

  </aside>

  <!-- CONTEÚDO PRINCIPAL -->
  <main class="flex-1 p-8">

    <!-- Histórico de Encomendas -->
    <section id="encomendas" class="bg-white rounded-xl p-6 shadow-md mb-10">
      <h1 class="text-2xl font-semibold text-orange-500 mb-4">Histórico de Encomendas</h1>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-orange-500 text-white">
              <th class="p-3 font-medium">Data</th>
              <th class="p-3 font-medium">Tipo de Gás</th>
              <th class="p-3 font-medium">Quantidade</th>
              <th class="p-3 font-medium">Estado</th>
            </tr>
          </thead>

          <tbody class="text-gray-700">
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">20/10/2025</td>
              <td class="p-3">Gás Butano</td>
              <td class="p-3">2 Botijas</td>
              <td class="p-3">Entregue</td>
            </tr>

            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">08/09/2025</td>
              <td class="p-3">Gás Propano</td>
              <td class="p-3">1 Botija</td>
              <td class="p-3">Em processamento</td>
            </tr>

            <tr class="hover:bg-gray-50">
              <td class="p-3">22/08/2025</td>
              <td class="p-3">Gás Canalizado</td>
              <td class="p-3">Mensal</td>
              <td class="p-3">Pago</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Faturas -->
    <section id="faturas" class="bg-white rounded-xl p-6 shadow-md">
      <h1 class="text-2xl font-semibold text-orange-500 mb-4">Faturas</h1>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-orange-500 text-white">
              <th class="p-3 font-medium">Nº Fatura</th>
              <th class="p-3 font-medium">Data</th>
              <th class="p-3 font-medium">Valor (€)</th>
              <th class="p-3 font-medium">Estado</th>
            </tr>
          </thead>

          <tbody class="text-gray-700">
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">FT-1023</td>
              <td class="p-3">20/10/2025</td>
              <td class="p-3">34,50</td>
              <td class="p-3">Pago</td>
            </tr>

            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">FT-0987</td>
              <td class="p-3">08/09/2025</td>
              <td class="p-3">17,25</td>
              <td class="p-3">Pendente</td>
            </tr>

            <tr class="hover:bg-gray-50">
              <td class="p-3">FT-0921</td>
              <td class="p-3">22/08/2025</td>
              <td class="p-3">28,00</td>
              <td class="p-3">Pago</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

  </main>

</body>
</html>
