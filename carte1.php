
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carte</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Feuille CSS Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"> 
  <!-- Bibliothèque JS Leaflet -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <?php
  // Vérifier si une ville est soumise dans le formulaire
  if(isset($_GET['ville']) && $_GET['ville'] != '') {

    // Récupérer le nom de la ville 
    $ville = $_GET['ville'];
    
    // Appel API GeoApi pour récupérer les infos 
    $api_url = "https://data.economie.gouv.fr/api/explore/v2.1/catalog/datasets/prix-carburants-fichier-instantane-test-ods-copie/records?where='".$ville."'";
    if(file_get_contents($api_url)) {
      $data = file_get_contents($api_url);
      $donnees = json_decode($data,true);
      /* foreach ($donnes["results"] as $value) {
          var_dump($value);
          die();

      } */
    }else{
      $message = "Ville non trouvée ou n'appartient pas à la france";
    }

  }
  ?>
</head>

<body class="bg-gray-500">
  <nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li>
            <a href="/" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Chercher une Ville</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  
  <!-- Div pour contenir la carte -->
  <div id="carte" class="h-[700px]"></div>
  
  <script>
  // Initialiser la carte centrée sur la France
  var carte = L.map('carte').setView([48.8566, 2.3522], 6); 
  var iconeRouge;
  // Ajouter la couche OpenStreetMap  
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - Rendering © <a href="//openstreetmap.org">OSM</a>'
  }).addTo(carte);
  
  //Se positionner sur la ville en question grâce à ses données geographique et affichage du marqueur
  <?php if(isset($donnees) && !empty($donnees["results"])) { 
   foreach ($donnees["results"] as $value) {
        $lat = $value["geom"]['lat'];
        $lon = $value["geom"]['lon'];
    ?>
    iconeRouge = L.icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
    });

    L.marker([<?php echo floatval($lat); ?>, <?php echo floatval($lon); ?>],{ icon: iconeRouge })
        .addTo(carte)
        .bindPopup(
                "<div><strong><span class='text-[13px] font-bold'>Ville </span></strong><br><span><?=$value["ville"]?></span></div> <div><strong><span class='text-[13px] font-bold'>Id</span></strong><br><span><?=$value["id"]?></span></div><div><strong><span class='text-[13px] font-bold'>CP</span></strong><br><span><?=$value["cp"]?></span></div> <div><strong><span class='text-[13px] font-bold'>Adresse </span></strong><br><span><?=$value["adresse"]?></span></div> <div><strong><span class='text-[13px] font-bold'>Prix nom </span></strong><br><span><?=$value["prix_nom"]?></span></div> <div><strong><span class='text-[13px] font-bold'>Prix valeur </span></strong><br><span><?=$value["prix_valeur"]?></span></div>   "
        );
    /* carte.invalidateSize(); */
    <?php
    }
    
    //Definition de l'icon
    } 
  
  //Faire une alerte pour afficher le message et rediriger vars la page de recherche
    if(isset($message)) : ?>
    alert("<?=$message?>");
    window.location.href = "/";
  <?php endif; ?>
  
  </script>
</body>
</html>
