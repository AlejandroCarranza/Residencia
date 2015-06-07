<?php
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/functions.php';

//Inicia la funncion 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

$mysqli->set_charset("utf8");


// Saneamiento y recepción de datos
$valor = filter_input(INPUT_POST, 'nuevanota', FILTER_SANITIZE_STRING);
$idde = filter_input(INPUT_POST, 'notaid', FILTER_SANITIZE_STRING);

    // Preparación de sentencia para insertar los datos
    if ($insert_stmt = $mysqli->prepare("INSERT INTO notas (id_contacto, valor)
        VALUES (?, ?)")) {
        $insert_stmt->bind_param('ss', $idde, $valor);
        // Ejecución de la sentencia.
        if (! $insert_stmt->execute()) {
            echo "Error al agregar la dependencia"; 
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