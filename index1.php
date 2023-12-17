<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rechercher</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-center bg-cover bg-no-repeat bg-[url(./assets/images/map.jpg)]  bg-gray-700 bg-blend-multiply">
    <div class="flex justify-center items-center h-screen w-screen p-20">
      <form class="w-1/2" action="carte1.php" method="GET">
          <label for="email-address-icon" class="block mb-2 text-md font-medium text-gray-100 dark:text-white">Rechercher une ville</label>
          <div class="relative">
              <input type="text" id="email-address-icon" name="ville" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 focus:none border-6 block w-full pe-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Paris">
              <button class="z-20 bg-gray-500 rounded-r-[5px] absolute inset-y-0 end-0 flex items-center p-3.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
              </button>
          </div>
      </form>
    </div>
  
</body>
</html>