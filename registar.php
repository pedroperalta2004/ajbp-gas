<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (!empty($_SESSION['user_id'])) {
  header("Location: cliente.php");
  exit;
}

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registar | A.J.B.P. Gás</title>
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

<body class="bg-gray-100 text-gray-800 font-sans min-h-screen flex flex-col">
  <?php include('includes/header.php'); ?>

  <main class="flex-1">
    <!-- HERO -->
    <section class="relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-b from-teal-900 via-teal-800 to-gray-100"></div>

      <div class="relative z-10 px-4 py-16 md:py-20">
        <div class="max-w-5xl mx-auto">

          <div class="text-center mb-10">
            <p class="inline-flex items-center gap-2 text-sm text-white/80 bg-white/10 border border-white/10 px-4 py-2 rounded-full">
              Área de Cliente • Criar conta
            </p>
            <h1 class="mt-5 text-4xl md:text-5xl font-extrabold text-white tracking-tight">
              Registar
            </h1>
            <p class="mt-3 text-white/80 max-w-2xl mx-auto">
              Crie a sua conta para facilitar futuras encomendas e acompanhar os seus pedidos.
            </p>
          </div>

          <!-- Card -->
          <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/50 p-7 md:p-10 max-w-3xl mx-auto">

            <?php if(isset($_GET['erro'])): ?>
              <?php
                $msg = '';
                if ($_GET['erro'] === 'campos')   $msg = 'Preencha todos os campos obrigatórios.';
                if ($_GET['erro'] === 'email')    $msg = 'O email introduzido não é válido.';
                if ($_GET['erro'] === 'existe')   $msg = 'Já existe uma conta com esse email.';
                if ($_GET['erro'] === 'password') $msg = 'A palavra-passe deve ter pelo menos 6 caracteres.';
              ?>
              <?php if ($msg): ?>
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-red-800 text-sm">
                  <?= htmlspecialchars($msg) ?>
                </div>
              <?php endif; ?>
            <?php endif; ?>

            <form action="registar_action.php" method="POST" class="space-y-6">
              <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

              <div class="grid md:grid-cols-2 gap-6">
                <div>
                  <label for="nome" class="block font-semibold text-gray-800 mb-1">Nome Completo</label>
                  <input type="text" id="nome" name="nome" required placeholder="Introduza o seu nome completo" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 outline-none transition">
                </div>

                <div>
                  <label for="telemovel" class="block font-semibold text-gray-800 mb-1">Telefone</label>
                  <input type="tel" id="telemovel" name="telemovel" required inputmode="numeric" pattern="^[0-9 ]{9,15}$" title="Use apenas números (pode usar espaços). Ex: 965 000 000" placeholder="Introduza o seu número de telefone"
                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 outline-none transition">
                </div>
              </div>

              <div>
                <label for="email" class="block font-semibold text-gray-800 mb-1">Email</label>
                <input type="email" id="email" name="email" required placeholder="Introduza o seu email"
                  class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 outline-none transition">
              </div>

              <div>
                <label for="password" class="block font-semibold text-gray-800 mb-1">Palavra-passe</label>
                <input type="password" id="password" name="password" required minlength="6" placeholder="Mínimo 6 caracteres"
                  class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-4 focus:ring-teal-500/20 focus:border-teal-500 outline-none transition">
              </div>

              <div class="pt-2 flex flex-col sm:flex-row gap-3 items-center justify-between">
                <p class="text-sm text-gray-600">
                  Ao criar conta, aceita o tratamento dos seus dados para gestão de encomendas e contacto.
                </p>

                <button type="submit" class="inline-flex items-center justify-center gap-2 bg-teal-700 hover:bg-teal-800 text-white px-7 py-3 rounded-xl font-semibold text-base shadow-md hover:shadow-lg transition w-full sm:w-auto">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 8v6" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M22 11h-6" />
                  </svg>
                  Criar Conta
                </button>
              </div>

              <div class="pt-2 text-sm">
                Já tem conta?
                <a href="login.php" class="text-teal-600 font-semibold hover:underline">Faça Login</a>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include('includes/footer.php'); ?>
</body>
</html>
