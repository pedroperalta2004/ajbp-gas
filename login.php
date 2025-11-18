<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | A.J.B.P. Gás</title>
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

<body class="font-sans text-gray-800">

  <!-- SECÇÃO DE LOGIN -->
  <section class="relative min-h-screen flex items-center justify-center px-4 py-20">
    <div class="bg-teal-700 absolute inset-0 w-full h-full object-cover brightness-50"></div>

    <!-- Card de login -->
    <div class="relative z-10 bg-white/90 rounded-2xl shadow-2xl p-10 w-full max-w-md text-center">
      <img src="img/logo.png" alt="Logotipo AJBP Gás" class="mx-auto h-20 mb-6 drop-shadow-md">
      <h1 class="text-3xl font-bold text-orange-500 mb-6">Login</h1>

      <form action="cliente.php" method="POST" class="space-y-5">
        <div class="text-left">
          <label for="username" class="block font-medium mb-1">Nome de Utilizador</label>
          <input type="text" id="username" name="username" required placeholder="Insira o seu nome de utilizador" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
        </div>

        <div class="text-left">
          <label for="password" class="block font-medium mb-1">Palavra-passe</label>
          <input type="password" id="password" name="password" required placeholder="Insira a sua palavra-passe" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
        </div>

        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-md transition flex justify-center items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
          </svg>
          Entrar
        </button>
      </form>

      <div class="mt-6 text-sm">
        <a href="index.php" class="text-orange-500 hover:text-orange-600 font-medium transition">← Voltar ao Início</a>
      </div>
    </div>
  </section>

</body>
</html>
