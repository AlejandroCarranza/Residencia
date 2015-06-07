
<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
 
sec_session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <!-- Le damos la habilidad al archivo para ser Responsivo -->
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
  <!-- Llamamos a normalizse.css para quitar los estilos que el navegador otorga predefinidamente -->
  <link rel="stylesheet" href="../../statics/css/estilos.css">
  <!-- Llamamos a estilos.css para darle el diseño al sitio web -->
  <link rel="stylesheet" href="../../statics/css/normalize.css">
  <title>Mapa</title>
    <style type="text/css">
          html, body, #map-canvas {
        height: 400px;
        margin: 0px;
        padding: 0px
      }
      .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
  </style>

</head>
<body onload="up206b.initialize()">
  <!-- Código php para dar seguridad y solo permitir que los usuarios autorizados accedan a este archivo-->
  <?php if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')): ?>
  <header>
    <figure class="logo">
      <img src="../../statics/images/logo-mini.png" alt="">
    </figure>
    <div class="titular">
      <h2 class="titulo">Sistema para la administración de contactos</h2>
    </div>
    <div class="info">
      <img src="../../statics/images/user.png" alt="usuario" class="avatar">
      <div class="usuario">
        <span class="nombre"><?php echo $_SESSION['username']; ?></span>
        <a class="cerrarSesion" href="../../../includes/logout.php">Cerrar Sesión</a>
      </div>
    </div>
      

  </header>
  <nav>
    <ul class="menu">
            <li><a href="admin.php" id="btnInicio">Inicio</a></li>
            <li><a href="#" id="btnInsertar">Insertar</a></li>
            <li class="li_submenu"><a href="#">Consultar</a>
                <div class="sub">
                    <ul class="ul_submenu">
                        <li><a href="#" id="btnConsulta1">Nombre</a></li>
                        <li><a href="#" id="btnConsulta2">Subcomité</a></li>
                    </ul>
                </div>
            </li>
            <li class="li_submenu"><a href="#">Reportes</a>
                <div class="sub">
                    <ul class="ul_submenu">
                        <li><a href="#" id="btnReporte1">Subcomité</a></li>
                        
                    </ul>
                </div>
            </li>
            <li class="li_submenu"><a href="#">Administrar</a>
                <div class="sub">
                    <ul class="ul_submenu">
                        <li><a href="#" id="btnCrearUsuario">Nuevo Usuario</a></li>
                        <li><a href="#" id="btnCrearTipos">Opciones</a></li>
                        <li><a href="#" id="btnActualizarCat">Catálogos</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="mapa.php" id="btnMapa">Mapa</a></li>   
           </ul>
  </nav>


  <div id="contenido">
    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
    <div id="map-canvas"></div>
    
  </div>
    <?php else : ?>
            <p>
                <span class="error">No estás autorizado para ver esta página.</span>
            </p>
        <?php endif; ?>

    <!-- Llamamos los scripts que usaremos para la transición de las páginas -->
  <script src="../../statics/js/jquery-2.1.0.min.js"></script>
    <script src="../../statics/js/AJAX.js"></script>
    <script src="../../statics/js/inicioM.js"></script>
  <script src="../../statics/js/buscador.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script type="text/javascript">
  inicio();
  </script>
    <script>

// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

function initialize() {

  var markers = [];
  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(24.0059, -104.7034),
      new google.maps.LatLng(24.0705, -104.6505));
  map.fitBounds(defaultBounds);

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</body>
</html>