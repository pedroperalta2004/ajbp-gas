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
      theme: {
        extend: {
          fontFamily: { 
            sans: ['Poppins', 'sans-serif'] },
        }
      }
    }
  </script>
</head>

<body class="text-gray-800 font-sans bg-gray-100">

  <?php include('includes/header.php'); ?>

  <!-- SEÇÃO COM IMAGEM DE FUNDO -->
  <section class="relative min-h-screen flex items-center justify-center px-4 py-20 bg-gray-900">
    <img src="img/gas-bg.png" alt="Encomendar Gás" class="absolute inset-0 w-full h-full object-cover brightness-50 blur-sm">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl p-10 max-w-3xl w-full">
      <h1 class="text-4xl font-bold text-orange-500 text-center mb-6">Encomendar Gás</h1>
      <p class="text-gray-700 text-center mb-8">Preencha os seus dados e receba o gás rapidamente no conforto da sua casa.</p>

      <form action="#" method="POST" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <label for="nome" class="block font-medium mb-1">Nome Completo</label>
            <input type="text" id="nome" name="nome" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
          </div>
          <div>
            <label for="telefone" class="block font-medium mb-1">Telefone</label>
            <input type="tel" id="telefone" name="telefone" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
          </div>
        </div>

        <div>
          <label for="email" class="block font-medium mb-1">Email</label>
          <input type="email" id="email" name="email" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
        </div>

        <div>
          <label for="morada" class="block font-medium mb-1">Morada de Entrega</label>
          <textarea id="morada" name="morada" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"></textarea>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
          <div>
            <label for="tipo" class="block font-medium mb-1">Tipo de Gás</label>
            <select id="tipo" name="tipo" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
              <option value="">Selecione uma opção</option>
              <option value="butano">Gás Butano</option>
              <option value="propano">Gás Propano</option>
            </select>
          </div>

          <div>
            <label for="quantidade" class="block font-medium mb-1">Quantidade</label>
            <select id="quantidade" name="quantidade" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
              <option value="">Selecione</option>
              <option value="1">1 Botija</option>
              <option value="2">2 Botijas</option>
              <option value="3">3 Botijas</option>
              <option value="4+">4 ou mais</option>
            </select>
          </div>
        </div>

        <div>
          <label for="observacoes" class="block font-medium mb-1">Observações</label>
          <textarea id="observacoes" name="observacoes" placeholder="Indique instruções adicionais..." class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition"></textarea>
        </div>

        <div class="text-center">
          <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-md font-semibold text-lg inline-flex items-center gap-2 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            Enviar Pedido
          </button>
        </div>
      </form>
    </div>
  </section>

  <?php include('includes/footer.php'); ?>

</body>
</html>
