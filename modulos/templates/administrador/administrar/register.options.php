<?php
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/psl-config.php';
$mysqli->set_charset("utf8");
$tipo=filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);

if ($tipo=="1"&&isset($_POST['tiposDependenciaNombre'])) {
    // Sanitize and validate the data passed in
    $nombre=filter_input(INPUT_POST, 'tiposDependenciaNombre', FILTER_SANITIZE_STRING);
    $tipoDependencia=filter_input(INPUT_POST, 'subDependencia', FILTER_SANITIZE_STRING);

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO dependencias (nombre_dependencia, tipo_dependencia)
            VALUES (?, ?)")) {
            $insert_stmt->bind_param('ss', $nombre, $tipoDependencia);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "Error al agregar la dependencia";
            } echo "1";
        } 
}

if ($tipo=="2"&&isset($_POST['tiposSubcomisionNombre'])) {
    // Sanitize and validate the data passed in
    $nombre=filter_input(INPUT_POST, 'tiposSubcomisionNombre', FILTER_SANITIZE_STRING);

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO subcomisiones (nombre_subcomision)
            VALUES (?)")) {
            $insert_stmt->bind_param('s', $nombre);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "Error al agregar la subcomision";
            } echo "1";
        } 
}

if ($tipo=="3"&&isset($_POST['tiposPartidoNombre'])) {
    // Sanitize and validate the data passed in
    $nombre=filter_input(INPUT_POST, 'tiposPartidoNombre', FILTER_SANITIZE_STRING);
    $siglas=filter_input(INPUT_POST, 'tiposPartidoSiglas', FILTER_SANITIZE_STRING);

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO partidos (nombre_partido, siglas)
            VALUES (?, ?)")) {
            $insert_stmt->bind_param('ss', $nombre, $siglas);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "Error al agregar el partido";
            } echo "1";
        } 
}


?>