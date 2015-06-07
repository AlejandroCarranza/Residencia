<?php
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/functions.php';

//Inicia la función 
sec_session_start();
// Comprueba que la sesión activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

$mysqli->set_charset("utf8");


// Saneamiento y recepción de datos
$idde = filter_input(INPUT_POST, 'borrarnotaid', FILTER_SANITIZE_STRING);

    // Preparación de sentencia para eliminar datos
    if ($insert_stmt = $mysqli->prepare("DELETE FROM notas WHERE id = ?")) {
        $insert_stmt->bind_param('s', $idde);
        // Ejecución de la sentencia.
        if (! $insert_stmt->execute()) {
            echo "Error"; 
        } echo "1"; // "1" significa que se realizó la sentencia correctamente
    } 



}
// Si no se aprueba la sesion muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php
}