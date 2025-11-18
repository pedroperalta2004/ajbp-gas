<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contactos | A.J.B.P. Comércio e Distribuição de Gás, Lda.</title>
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
    <img src="img/gas-bg.png" alt="Contactos A.J.B.P." class="absolute inset-0 w-full h-full object-cover brightness-50 blur-sm">
    <h1 class="relative z-10 text-4xl md:text-5xl font-bold">Contacte-nos</h1>
  </section>

  <!-- CONTACTOS -->
  <main class="py-20 px-[10%] bg-white">
    <div class="grid md:grid-cols-2 gap-12 items-start">
      
      <!-- FORMULÁRIO -->
      <div>
        <h2 class="text-3xl font-semibold text-orange-500 mb-6">Envie-nos uma mensagem</h2>
        <p class="text-gray-700 mb-8">Tem dúvidas ou pretende pedir informações? 
          Preencha o formulário abaixo e entraremos em contacto o mais breve possível.</p>

        <form action="enviar.php" method="POST" class="space-y-5">
          <div>
            <label class="block text-left font-medium mb-1">Nome</label>
            <input type="text" name="nome" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
          </div>

          <div class="grid md:grid-cols-2 gap-4">
            <div>
              <label class="block text-left font-medium mb-1">Email</label>
              <input type="email" name="email" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
            <div>
              <label class="block text-left font-medium mb-1">Telefone</label>
              <input type="tel" name="telefone" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>
          </div>

          <div>
            <label class="block text-left font-medium mb-1">Assunto</label>
            <select name="assunto" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
              <option value="">Selecione uma opção</option>
              <option value="entregas">Entregas de Gás</option>
              <option value="instalacoes">Instalações e Manutenção</option>
              <option value="parcerias">Parcerias / Fornecimentos</option>
              <option value="outros">Outros Assuntos</option>
            </select>
          </div>

          <div>
            <label class="block text-left font-medium mb-1">Mensagem</label>
            <textarea name="mensagem" rows="5" required class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
          </div>

          <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-md transition">
            Enviar Mensagem
          </button>
        </form>
      </div>

      <!-- INFORMAÇÕES E MAPA -->
      <div class="space-y-8">
        <div>
          <h2 class="text-3xl font-semibold text-orange-500 mb-4">Os Nossos Contactos</h2>
          <ul class="text-gray-700 space-y-2">
            <li class="flex items-start gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ff6600" class="h-5 w-5 mt-1">
                <path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z"/>
              </svg>
              <strong>Morada:</strong> Av. Vice Almirante Adriano Saavedra, 43 - 3610-130 Tarouca
            </li>


            <li class="flex items-start gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3l2 5-3 2a11 11 0 006 6l2-3 5 2v3a2 2 0 01-2 2h-1C8 21 3 11 3 6V5z"/>
              </svg>
              <strong>Telefone:</strong> 254 679 772
            </li>

            <li class="flex items-start gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff6600" stroke-width="2.3" class="h-5 w-5 mt-1">
                <rect x="7" y="2" width="10" height="20" rx="3" ry="3"/>
              </svg>
              <strong>Telemóvel:</strong> 965 085 929 / 965 350 308
            </li>


            <li class="flex items-start gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/>
              </svg>
              <strong>Email:</strong> ajbp.gas@sapo.pt
            </li>

            <li class="flex items-start gap-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mt-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-.75-12a.75.75 0 011.5 0v4.19l3.03 1.75a.75.75 0 01-.76 1.3l-3.4-1.97a.75.75 0 01-.37-.65V6z" clip-rule="evenodd"/>
              </svg>
              <strong>Horário:</strong> 
              Segunda a Sexta — 9h00 às 19h00 <br>
              Sábados e Feriados — 9h00 às 13h00
            </li>

          </ul>
        </div>

        <div>
          <h3 class="text-2xl font-semibold text-gray-800 mb-4">Onde Estamos</h3>
          <div class="w-full h-[300px] rounded-lg overflow-hidden shadow-md">
            <!-- MAPA -->
           <iframe width="100%" height="100%" style="border:0;" loading="lazy"allowfullscreen referrerpolicy="no-referrer-when-downgrade"
              src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d752.5770551127915!2d-7.775563297498924!3d41.0185122587244!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd3caaa81bb8fef1%3A0xa685847ffef85bba!2sIsabela%20Pinto%2C%20Unipessoal%20Lda.!5e0!3m2!1spt-PT!2spt!4v1763046253563!5m2!1spt-PT!2spt">
           </iframe>
          </div>
        </div>

      </div>
    </div>
  </main>

  <?php include('includes/footer.php'); ?>

</body>
</html>
