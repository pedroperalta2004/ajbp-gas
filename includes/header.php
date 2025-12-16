<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);

$is_logged_in = isset($_SESSION['user_id']);
$user_role = $_SESSION['user_role'] ?? 'user';

$is_prices_page = in_array($current_page, [
    'precos_lamego.php',
    'precos_tarouca_armamar.php',
    'precos_castrodaire.php'
]);
?>

<a id="top"></a>

<header class="bg-white shadow-md py-3 px-6 lg:px-[5%] flex items-center justify-between relative z-[100]">

    <!-- LOGO -->
    <a href="index.php" class="flex items-center">
    <img src="img/logo.png" alt="Logotipo A.J.B.P. Gás" class="h-14 cursor-pointer transition-transform duration-300 hover:scale-105"></a>

    <!-- HAMBURGUER -->
    <button id="menu-btn" class="lg:hidden focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- NAV DESKTOP -->
    <nav class="hidden lg:flex items-center space-x-6">

        <a href="index.php"
           class="text-gray-700 font-medium hover:text-orange-500 transition
           <?php if($current_page=='index.php') echo 'text-orange-600 font-semibold'; ?>">
            Início
        </a>

        <a href="sobre.php"
           class="text-gray-700 font-medium hover:text-orange-500 transition
           <?php if($current_page=='sobre.php') echo 'text-orange-600 font-semibold'; ?>">
            Sobre Nós
        </a>

        <a href="servicos.php"
           class="text-gray-700 font-medium hover:text-orange-500 transition
           <?php if($current_page=='servicos.php') echo 'text-orange-600 font-semibold'; ?>">
            Serviços
        </a>

        <!-- DROPDOWN PREÇOS -->
        <div class="relative group">
            <button class="flex items-center gap-1 font-medium transition
                <?php echo $is_prices_page ? 'text-orange-600 font-semibold' : 'text-gray-700 hover:text-orange-500'; ?>">
                Tabela de Preços
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-[2px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 z-50">
                <a href="precos_castrodaire.php" class="block px-4 py-2 hover:bg-orange-50 hover:text-orange-600">
                    Castro Daire
                </a>
                <a href="precos_lamego.php" class="block px-4 py-2 hover:bg-orange-50 hover:text-orange-600">
                    Lamego
                </a>
                <a href="precos_tarouca_armamar.php" class="block px-4 py-2 hover:bg-orange-50 hover:text-orange-600">
                    Tarouca / Armamar
                </a>
            </div>
        </div>

        <a href="contactos.php" class="text-gray-700 font-medium hover:text-orange-500 transition
           <?php if($current_page=='contactos.php') echo 'text-orange-600 font-semibold'; ?>">
            Contactos
        </a>

        <a href="encomendar.php" class="bg-orange-500 text-white px-5 py-2 rounded-md font-medium hover:bg-orange-600 transition">
            Encomendar Gás
        </a>

        <!-- LOGIN / AVATAR -->
        <?php if ($is_logged_in): ?>
            <?php
              $nome = $_SESSION['user_nome'] ?? 'Utilizador';
              $partes = preg_split('/\s+/', trim($nome));
              $iniciais = strtoupper(
                  mb_substr($partes[0], 0, 1) .
                  (isset($partes[1]) ? mb_substr($partes[1], 0, 1) : '')
              );

              $avatarClass = ($user_role === 'admin') ? 'bg-orange-600 hover:bg-orange-700' : 'bg-teal-700 hover:bg-teal-800';
              $areaLink = ($user_role === 'admin') ? 'admin.php' : 'cliente.php';
              $areaText = ($user_role === 'admin') ? 'Administração' : 'Área de Cliente';
            ?>

            <div class="relative group">
                <!-- Avatar -->
                <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-semibold cursor-pointer transition <?php echo $avatarClass; ?>">
                    <?= $iniciais ?>
                </div>

                <!-- Dropdown -->
                <div class="absolute right-0 mt-[2px] w-52 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 z-50">
                    <div class="px-4 py-3 border-b text-sm text-gray-600">
                        Olá, <?= htmlspecialchars($nome) ?>
                        <?php if ($user_role === 'admin'): ?>
                          <span class="ml-2 inline-flex items-center rounded-full bg-orange-50 text-orange-700 px-2 py-0.5 text-xs font-semibold">
                            ADMIN
                          </span>
                        <?php endif; ?>
                    </div>

                    <a href="<?= $areaLink ?>" class="block px-4 py-2 hover:bg-gray-100 transition font-medium">
                        <?= $areaText ?>
                    </a>

                    <a href="logout.php" class="block px-4 py-2 text-red-600 hover:bg-red-50 transition font-medium">
                        Logout
                    </a>
                </div>
            </div>

        <?php else: ?>
            <a href="login.php" class="bg-white border-4 border-teal-700 text-teal-700 px-5 py-1 rounded-lg font-semibold hover:bg-teal-700 hover:text-white transition">
                Login
            </a>
        <?php endif; ?>

    </nav>
</header>

<!-- MENU MOBILE -->
<nav id="mobile-menu" class="lg:hidden hidden flex-col bg-white shadow-lg border-t border-gray-200 py-4 px-6 space-y-4">
    <a href="index.php" class="block font-medium <?php if($current_page=='index.php') echo 'text-orange-600 font-semibold'; ?>">
        Início
    </a>

    <a href="sobre.php" class="block font-medium <?php if($current_page=='sobre.php') echo 'text-orange-600 font-semibold'; ?>">
        Sobre Nós
    </a>

    <a href="servicos.php" class="block font-medium <?php if($current_page=='servicos.php') echo 'text-orange-600 font-semibold'; ?>">
        Serviços
    </a>

    <!-- DROPDOWN MOBILE PREÇOS -->
    <details class="group">
        <summary class="flex items-center justify-between cursor-pointer font-medium
            <?php echo $is_prices_page ? 'text-orange-600 font-semibold' : 'text-gray-700'; ?>">
            <span>Tabela de Preços</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-open:rotate-180"fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </summary>

        <div class="pl-4 mt-3 space-y-2">  
            <a href="precos_castrodaire.php" class="block hover:text-orange-600">Castro Daire</a>  
            <a href="precos_lamego.php" class="block hover:text-orange-600">Lamego</a>
            <a href="precos_tarouca_armamar.php" class="block hover:text-orange-600">Tarouca / Armamar</a>
        </div>
    </details>

    <a href="contactos.php" class="block font-medium <?php if($current_page=='contactos.php') echo 'text-orange-600 font-semibold'; ?>">
        Contactos
    </a>

    <a href="encomendar.php" class="block text-center bg-orange-500 text-white px-5 py-2 rounded-md font-medium">
        Encomendar Gás
    </a>

    <!-- LOGIN / AREA / LOGOUT MOBILE -->
    <?php if ($is_logged_in): ?>
        <?php
          $areaLinkMobile = ($user_role === 'admin') ? 'admin.php' : 'cliente.php';
          $areaTextMobile = ($user_role === 'admin') ? 'Administração' : 'Área de Cliente';
        ?>
        <a href="<?= $areaLinkMobile ?>" class="block text-center font-semibold text-gray-700">
            <?= $areaTextMobile ?>
        </a>
        <a href="logout.php" class="block text-center bg-teal-700 text-white px-5 py-2 rounded-lg font-semibold">
            Logout
        </a>
    <?php else: ?>
        <a href="login.php" class="block text-center bg-white border-4 border-teal-700 text-teal-700 px-5 py-1 rounded-lg font-semibold">
            Login
        </a>
    <?php endif; ?>
</nav>

<script>
  const btn = document.getElementById("menu-btn");
  const menu = document.getElementById("mobile-menu");

  btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
  });
</script>
