<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/psl-config.php';
$mysqli->set_charset("utf8");
$dependencia='';
$val='1';
if (isset($_POST['nombre'], $_POST['apellidoP'])) {
    // Sanitize and validate the data passed in
    $nombre=filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido_paterno=filter_input(INPUT_POST, 'apellidoP', FILTER_SANITIZE_STRING);
    $apellido_materno=filter_input(INPUT_POST, 'apellidoM', FILTER_SANITIZE_STRING);
    $titulo=filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
    $fechaNacimiento=filter_input(INPUT_POST, 'fechaNacimiento', FILTER_SANITIZE_STRING);
    $partido=filter_input(INPUT_POST, 'partido', FILTER_SANITIZE_STRING);
    $calle=filter_input(INPUT_POST, 'calle', FILTER_SANITIZE_STRING);
    $numInt=filter_input(INPUT_POST, 'numInt', FILTER_SANITIZE_STRING);
    $numExt=filter_input(INPUT_POST, 'numExt', FILTER_SANITIZE_STRING);
    $colonia=filter_input(INPUT_POST, 'colonia', FILTER_SANITIZE_STRING);
    $municipio=filter_input(INPUT_POST, 'municipio', FILTER_SANITIZE_STRING);
    $localidad=filter_input(INPUT_POST, 'localidad', FILTER_SANITIZE_STRING);
    $TelCel=filter_input(INPUT_POST, 'TelCel', FILTER_SANITIZE_STRING);
    $TelOfc=filter_input(INPUT_POST, 'TelOfc', FILTER_SANITIZE_STRING);
    $Email=filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING);
    $codigo_postal=filter_input(INPUT_POST, 'codigo_postal', FILTER_SANITIZE_STRING);

    

        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO contactos (nombre, apellido_paterno, apellido_materno, titulo, 
            fecha_nacimiento, fk_id_partido, calle, numero_int, numero_ext, colonia, municipio, localidad, tel_Oficina, celular, email, codigo_postal) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssssssssssssssss', $nombre, $apellido_paterno, $apellido_materno, $titulo, $fechaNacimiento, $partido, $calle, $numInt, $numExt, $colonia, $municipio, $localidad, $TelCel, $TelOfc, $Email, $codigo_postal);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                echo "Error al agregar el contacto";
            } echo "1";
        } 

$id_contacto = $mysqli->insert_id;
$sub=filter_input(INPUT_POST, 'sub', FILTER_SANITIZE_STRING);

if ($sub=="1"&&isset($_POST['dep1'])) {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep1', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo1', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI1', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT1', FILTER_SANITIZE_STRING);
}
if ($sub=="2"&&isset($_POST['dep2'])) {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep2', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo2', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI2', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT2', FILTER_SANITIZE_STRING);
}
if ($sub=="3"&&isset($_POST['dep3'])) {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep3', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo3', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI3', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT3', FILTER_SANITIZE_STRING);
}
if ($sub=="4"&&isset($_POST['dep4'])) {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep4', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo4', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI4', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT4', FILTER_SANITIZE_STRING);
}
if ($sub=="6"&&isset($_POST['dep6'])) {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep6', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo6', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI6', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT6', FILTER_SANITIZE_STRING);
}
if ($sub=="8"&&isset($_POST['dep8'])) {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep8', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo8', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI8', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT8', FILTER_SANITIZE_STRING);
}
if ($sub=="11"&&isset($_POST['dep11'])) {
    // Sanitize and validate the data passed in
    $dependencia=filter_input(INPUT_POST, 'dep11', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo11', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI11', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT11', FILTER_SANITIZE_STRING);
}


if ($dependencia!='') {
        // Insert values into the database 
        if ($uno = $mysqli->prepare("INSERT INTO cargos (id_contacto, cargo, id_dependencia,id_subcomision, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $cargo, $dependencia, $sub, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
            }
        }
}
if ($sub=="6"&&isset($_POST['Secretaria'])) {
    $secretaria=filter_input(INPUT_POST, 'Secretaria', FILTER_SANITIZE_STRING);
$temp1='Secretaria';
        if ($uno = $mysqli->prepare("INSERT INTO campos (fk_id_contacto, campo, valor, valido) VALUES (?, ?, ?, ?)")) {
            $uno->bind_param('ssss', $id_contacto, $temp1, $secretaria, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
}

if ($sub=="5"&&isset($_POST['municipioEM'])) {
    // Sanitize and validate the data passed in
    $EM=filter_input(INPUT_POST, 'municipioEM', FILTER_SANITIZE_STRING);
    $UAR=filter_input(INPUT_POST, 'UAR', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI5', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT5', FILTER_SANITIZE_STRING);

$temp1='Enlace Municipal';
$temp2='UAR';
            // Insert values into the database 
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $temp1, $EM, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO campos (fk_id_contacto, campo, valor, valido) VALUES (?, ?, ?, ?)")) {
            $uno->bind_param('ssss', $id_contacto, $temp2, $UAR, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
}



if ($sub=="7"&&isset($_POST['municipioPM'])) {
    // Sanitize and validate the data passed in
    $PM=filter_input(INPUT_POST, 'municipioPM', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI7', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT7', FILTER_SANITIZE_STRING);


$temp1='Presidente Municipal';
            // Insert values into the database 
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $temp1, $PM, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
}

if ($sub=="9"&&isset($_POST['Cargo9'])) {
    // Sanitize and validate the data passed in
    $puesto=filter_input(INPUT_POST, 'Cargo9', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI9', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT9', FILTER_SANITIZE_STRING);

$cargo='Regidor';
            // Insert values into the database 
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $cargo, $puesto, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
}

if ($sub=="10"&&isset($_POST['Cargo10'])) {
    // Sanitize and validate the data passed in
    $extra=filter_input(INPUT_POST, 'Cargo10', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI10', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT10', FILTER_SANITIZE_STRING);

$cargo='Diputado';
            // Insert values into the database 
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $cargo, $extra, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
}

}


?>