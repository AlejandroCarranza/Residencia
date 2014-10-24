<?php
include_once '../includes/db_connect.php';
include_once '../includes/psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['nombre'], $_POST['titulo'])) {
    // Sanitize and validate the data passed in
    $nombre=filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido_paterno=filter_input(INPUT_POST, 'apellidoP', FILTER_SANITIZE_STRING);
    $apellido_materno=filter_input(INPUT_POST, 'apellidoM', FILTER_SANITIZE_STRING);
    $titulo=filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO contactos (nombre, apellido_paterno, apellido_materno, titulo) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $nombre, $apellido_paterno, $apellido_materno, $titulo);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "Error";
            }
        } echo $nombre;

}
?>
