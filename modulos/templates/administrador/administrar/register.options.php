<?php
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/functions.php';

//Inicia la funncion 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

$mysqli->set_charset("utf8");
$tipo=filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);

if ($tipo=="1"&&isset($_POST['tiposDependenciaNombre'])) {
    // Saneamiento y recepción de datos
    $nombre=filter_input(INPUT_POST, 'tiposDependenciaNombre', FILTER_SANITIZE_STRING);
    $tipoDependencia=filter_input(INPUT_POST, 'subDependencia', FILTER_SANITIZE_STRING);

        // Preparación de sentencia para insertar los datos
        if ($insert_stmt = $mysqli->prepare("INSERT INTO dependencias (nombre_dependencia, tipo_dependencia)
            VALUES (?, ?)")) {
            $insert_stmt->bind_param('ss', $nombre, $tipoDependencia);
            // Ejecución de la sentencia.
            if (! $insert_stmt->execute()) {
                echo "Error al agregar la dependencia"; 
            } echo "1"; // "1" significa que se realizó la sentencia correctamente
        } 
}

if ($tipo=="2"&&isset($_POST['tiposSubcomisionNombre'])) {
    $nombre=filter_input(INPUT_POST, 'tiposSubcomisionNombre', FILTER_SANITIZE_STRING);

        if ($insert_stmt = $mysqli->prepare("INSERT INTO subcomisiones (nombre_subcomision)
            VALUES (?)")) {
            $insert_stmt->bind_param('s', $nombre);
            if (! $insert_stmt->execute()) {
                echo "Error al agregar la subcomision";
            } echo "1";
        } 
}

if ($tipo=="3"&&isset($_POST['tiposPartidoNombre'])) {

    $nombre=filter_input(INPUT_POST, 'tiposPartidoNombre', FILTER_SANITIZE_STRING);
    $siglas=filter_input(INPUT_POST, 'tiposPartidoSiglas', FILTER_SANITIZE_STRING);

        if ($insert_stmt = $mysqli->prepare("INSERT INTO partidos (nombre_partido, siglas)
            VALUES (?, ?)")) {
            $insert_stmt->bind_param('ss', $nombre, $siglas);
            if (! $insert_stmt->execute()) {
                echo "Error al agregar el partido";
            } echo "1";
        } 
}

}
// Si no se aprueba la sesion muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php
}