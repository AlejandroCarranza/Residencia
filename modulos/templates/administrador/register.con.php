<<<<<<< HEAD
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/psl-config.php';
$mysqli->set_charset("utf8");

if (isset($_POST['nombre'], $_POST['apellidoP'])) {
    // Sanitize and validate the data passed in
    $nombre=filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido_paterno=filter_input(INPUT_POST, 'apellidoP', FILTER_SANITIZE_STRING);
    $apellido_materno=filter_input(INPUT_POST, 'apellidoM', FILTER_SANITIZE_STRING);
    $titulo=filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $calle=filter_input(INPUT_POST, 'calle', FILTER_SANITIZE_STRING);
    $numInt=filter_input(INPUT_POST, 'numInt', FILTER_SANITIZE_STRING);
    $numExt=filter_input(INPUT_POST, 'numExt', FILTER_SANITIZE_STRING);
    $colonia=filter_input(INPUT_POST, 'colonia', FILTER_SANITIZE_STRING);
    $municipio=filter_input(INPUT_POST, 'municipio', FILTER_SANITIZE_STRING);
    $localidad=filter_input(INPUT_POST, 'localidad', FILTER_SANITIZE_STRING);
    $sub=filter_input(INPUT_POST, 'sub', FILTER_SANITIZE_STRING);
    $TelCel=filter_input(INPUT_POST, 'TelCel', FILTER_SANITIZE_STRING);
    $TelOfc=filter_input(INPUT_POST, 'TelOfc', FILTER_SANITIZE_STRING);
    $Email=filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);
    $Cargo=filter_input(INPUT_POST, 'Cargo', FILTER_SANITIZE_STRING);
    $codigo_postal=filter_input(INPUT_POST, 'codigo_postal', FILTER_SANITIZE_STRING);

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO contactos (nombre, apellido_paterno, apellido_materno, titulo, 
            calle, numero_int, numero_ext, colonia, municipio, localidad, tel_Oficina, celular, email, fk_id_subcomision, cargo, codigo_postal) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssssssssssssss', $nombre, $apellido_paterno, $apellido_materno, $titulo, $calle, $numInt, $numExt, $colonia, $municipio, $localidad, $TelCel, $TelOfc, $Email, $sub, $Cargo, $codigo_postal);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "Error al agregar el contacto";
            } echo "1";
        } 

$id_contacto = $mysqli->insert_id;

if ($sub=="1") {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep1', FILTER_SANITIZE_STRING);

    $temp1="Dependencia";
        // Insert values into the database 
        if ($uno = $mysqli->prepare("INSERT INTO campos (fk_id_contacto, campo, valor) VALUES (?, ?, ?)")) {
            $uno->bind_param('sss', $id_contacto, $temp1, $dependencia);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$temp1.' '.$dependencia;
            }
        }

        

}



}


?>
=======
<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/psl-config.php';
$mysqli->set_charset("utf8");

if (isset($_POST['nombre'], $_POST['apellidoP'], $_POST['apellidoM'])) {
    // Sanitize and validate the data passed in
    $nombre=filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido_paterno=filter_input(INPUT_POST, 'apellidoP', FILTER_SANITIZE_STRING);
    $apellido_materno=filter_input(INPUT_POST, 'apellidoM', FILTER_SANITIZE_STRING);
    $titulo=filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $calle=filter_input(INPUT_POST, 'calle', FILTER_SANITIZE_STRING);
    $numInt=filter_input(INPUT_POST, 'numInt', FILTER_SANITIZE_STRING);
    $numExt=filter_input(INPUT_POST, 'numExt', FILTER_SANITIZE_STRING);
    $colonia=filter_input(INPUT_POST, 'colonia', FILTER_SANITIZE_STRING);
    $municipio=filter_input(INPUT_POST, 'municipio', FILTER_SANITIZE_STRING);
    $localidad=filter_input(INPUT_POST, 'localidad', FILTER_SANITIZE_STRING);
    $sub=filter_input(INPUT_POST, 'sub', FILTER_SANITIZE_STRING);
    $TelCel=filter_input(INPUT_POST, 'TelCel', FILTER_SANITIZE_STRING);
    $TelOfc=filter_input(INPUT_POST, 'TelOfc', FILTER_SANITIZE_STRING);
    $Email=filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO contactos (nombre, apellido_paterno, apellido_materno, titulo, 
            calle, numero_int, numero_ext, colonia, municipio, localidad, tel_Oficina, celular, email, fk_id_subcomision) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssssssssssss', $nombre, $apellido_paterno, $apellido_materno, $titulo, $calle, $numInt, $numExt, $colonia, $municipio, $localidad, $TelCel, $TelOfc, $Email, $sub);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "Error";
            } echo "1";
        } 

$id_contacto = $mysqli->insert_id;

if ($sub=="1") {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep1', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo1', FILTER_SANITIZE_STRING);

    $temp1="Dependencia";
    $temp2="Cargo";
        // Insert values into the database 
        if ($uno = $mysqli->prepare("INSERT INTO campos (fk_id_contacto, campo, valor) VALUES (?, ?, ?),(?, ?, ?)")) {
            $uno->bind_param('ssssss', $id_contacto, $temp1, $dependencia, $id_contacto, $temp2, $cargo);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error';
            }
        }

        

}



}


?>
>>>>>>> origin/master
