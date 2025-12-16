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
        extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] } }
      }
    }
  </script>
</head>

<body class="text-gray-800 font-sans bg-gray-100 min-h-screen flex flex-col">

<?php include('includes/header.php'); ?>

<main class="flex-1">
  <!-- HERO -->
  <section class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-teal-900 via-teal-800 to-gray-100"></div>
      <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-orange-500/25 blur-3xl"></div>
      <div class="absolute top-10 -right-32 h-96 w-96 rounded-full bg-white/10 blur-3xl"></div>
      <div class="absolute bottom-0 left-1/2 -translate-x-1/2 h-40 w-[80%] bg-white/20 blur-2xl rounded-full"></div>

    <div class="relative z-10 px-4 py-16 md:py-20">
      <div class="max-w-5xl mx-auto">
        <div class="text-center mb-10">
          <p class="inline-flex items-center gap-2 text-sm text-white/80 bg-white/10 border border-white/10 px-4 py-2 rounded-full">
            Área de Cliente • Gestão de encomendas
          </p>
          <h1 class="mt-5 text-4xl md:text-5xl font-extrabold text-white tracking-tight">
            Login
          </h1>
          <p class="mt-3 text-white/80 max-w-xl mx-auto">
            Inicie sessão para acompanhar encomendas e mensagens.
          </p>
        </div>

        <!-- Card -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/50 p-7 md:p-10 w-full max-w-md mx-auto text-center">
          <img src="img/logo.png" alt="Logotipo AJBP Gás" class="mx-auto h-16 md:h-20 mb-5 drop-shadow-md">

          <?php if (isset($_GET['erro'])): ?>
            <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-700 text-sm">
              Email ou palavra-passe incorretos.
            </div>
          <?php endif; ?>

          <?php if (isset($_GET['registo']) && $_GET['registo'] === 'ok'): ?>
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-700 text-sm">
              Conta criada com sucesso. Pode iniciar sessão.
            </div>
          <?php endif; ?>

          <form action="login_action.php" method="POST" class="space-y-5 text-left">

            <div>
              <label class="block font-semibold text-gray-800 mb-1">Email</label>
              <input type="email" name="email" required placeholder="Introduza o seu email" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 outline-none transition">
            </div>

            <div>
              <label class="block font-semibold text-gray-800 mb-1">Palavra-passe</label>
              <input type="password" name="password" required placeholder="Introduza a sua palavra-passe" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 outline-none transition">
            </div>

            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 bg-teal-700 hover:bg-teal-800 text-white py-3 rounded-xl font-medium shadow-md hover:shadow-lg transition">
              Entrar
            </button>

            <p class="text-sm text-center text-gray-600 pt-2">
              Ainda não tem conta?
              <a href="registar.php" class="text-teal-600 font-semibold hover:underline">
                Registe-se
              </a>
            </p>

          </form>
        </div>

      </div>
    </div>
  </section>
</main>

<?php include('includes/footer.php'); ?>

</body>
</html>
