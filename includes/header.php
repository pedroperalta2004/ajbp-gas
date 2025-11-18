<?php
  $current_page = basename($_SERVER['PHP_SELF']);
?>

<a id="top"></a>
  <header class="bg-white shadow-md py-3 px-6 lg:px-[5%] flex items-center justify-between relative z-[100]">
      <a href="index.php" class="flex items-center">
          <img src="img/logo.png" alt="Logotipo A.J.B.P. Gás" class="h-14 cursor-pointer transition-transform duration-300 hover:scale-105">
      </a>

      <!-- MENU HAMBURGUER -->
      <button id="menu-btn" class="lg:hidden text-gray-700 focus:outline-none">
          <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
      </button>

      <!-- NAV DESKTOP -->
      <nav class="hidden lg:flex items-center space-x-6">
          <a href="index.php" class="text-gray-700 font-medium hover:text-orange-500 transition <?php if($current_page=='index.php') echo 'text-orange-600 font-semibold'; ?>">
            Início
          </a>
          <a href="sobre.php" class="text-gray-700 font-medium hover:text-orange-500 transition <?php if($current_page=='sobre.php') echo 'text-orange-600 font-semibold'; ?>">
            Sobre Nós
          </a>
          <a href="servicos.php" class="text-gray-700 font-medium hover:text-orange-500 transition <?php if($current_page=='servicos.php') echo 'text-orange-600 font-semibold'; ?>">
            Serviços
          </a>

          <!-- DROPDOWN -->
          <div class="relative group">
              <button class="flex items-center gap-1 font-medium text-gray-700 hover:text-orange-500 transition
                  <?php echo (
                      $current_page=='precos_lamego.php' ||
                      $current_page=='precos_tarouca_armamar.php' ||
                      $current_page=='precos_castrodaire.php') ? 'text-orange-600 font-semibold' : ''; ?>">
                  Tabela de Preços
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-[2px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                  </svg>
              </button>

              <div class="absolute left-0 mt-0 w-56 bg-white border border-gray-200 rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition duration-200 z-50">
                  <a href="precos_tarouca_armamar.php" class="block px-4 py-2 hover:bg-orange-50 hover:text-orange-600">
                    Tarouca / Armamar
                  </a>

                  <a href="precos_lamego.php" class="block px-4 py-2 hover:bg-orange-50 hover:text-orange-600">
                    Lamego
                  </a>

                  <a href="precos_castrodaire.php" class="block px-4 py-2 hover:bg-orange-50 hover:text-orange-600">
                    Castro Daire
                  </a>
              </div>

          </div>

          <a href="contactos.php" class="text-gray-700 font-medium hover:text-orange-500 transition <?php if($current_page=='contactos.php') echo 'text-orange-600 font-semibold'; ?>">
            Contactos
          </a>

          <a href="encomendar.php" class="bg-orange-500 text-white px-5 py-2 rounded-md font-medium hover:bg-orange-600 transition">
              Encomendar Gás
          </a>

          <a href="login.php" class="bg-white border-4 border-teal-700 text-teal-700 px-5 py-1 rounded-lg font-semibold hover:bg-teal-700 hover:text-white transition">
            Login
          </a>
          
      </nav>
  </header>

  <!-- MENU MOBILE -->
  <nav id="mobile-menu"
      class="lg:hidden hidden flex-col bg-white shadow-lg border-t border-gray-200 py-4 px-6 space-y-4">

      <a href="index.php"
        class="block text-gray-700 font-medium <?php if($current_page=='index.php') echo 'text-orange-600 font-semibold'; ?>">
        Início
      </a>

      <a href="sobre.php"
        class="block text-gray-700 font-medium <?php if($current_page=='sobre.php') echo 'text-orange-600 font-semibold'; ?>">
        Sobre Nós
      </a>

      <a href="servicos.php"
        class="block text-gray-700 font-medium <?php if($current_page=='servicos.php') echo 'text-orange-600 font-semibold'; ?>">
        Serviços
      </a>

      <!-- DROPDOWN MOBILE -->
      <details class="group">
          <summary class="flex items-center justify-between cursor-pointer font-medium
              <?php echo $is_prices_page ? 'text-orange-600' : 'text-gray-700'; ?>">
              <span class="<?php echo $is_prices_page ? 'text-orange-600 font-semibold' : ''; ?>">
                  Tabela de Preços
              </span>

              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transition-transform duration-200 group-open:rotate-180 <?php echo $is_prices_page ? 'text-orange-600' : 'text-gray-700'; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
          </summary>

          <div class="pl-4 mt-3 space-y-2">
              <a href="precos_tarouca_armamar.php" class="block font-medium hover:text-orange-600 transition <?php if($current_page=='precos_tarouca_armamar.php') echo 'text-orange-600 font-semibold'; ?>">
                Tarouca / Armamar
              </a>

              <a href="precos_lamego.php" class="block font-medium hover:text-orange-600 transition <?php if($current_page=='precos_lamego.php') echo 'text-orange-600 font-semibold'; ?>">
                Lamego
              </a>

              <a href="precos_castrodaire.php" class="block font-medium hover:text-orange-600 transition <?php if($current_page=='precos_castrodaire.php') echo 'text-orange-600 font-semibold'; ?>">
                Castro Daire
              </a>
          </div>
      </details>

      <a href="contactos.php" class="block text-gray-700 font-medium <?php if($current_page=='contactos.php') echo 'text-orange-600 font-semibold'; ?>">
        Contactos
      </a>

      <a href="encomendar.php" class="block text-center bg-orange-500 text-white px-5 py-2 rounded-md font-medium">
        Encomendar Gás
      </a>

      <a href="login.php" class="block text-center bg-white border-4 border-teal-700 text-teal-700 px-5 py-1 rounded-lg font-semibold">
        Login
      </a>
  </nav>

<script>
  const btn = document.getElementById("menu-btn");
  const menu = document.getElementById("mobile-menu");

  btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
  });
</script>
