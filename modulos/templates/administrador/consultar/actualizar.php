<?php
$id_contacto = $_POST['id_contacto'];
$tel_oficina = $_POST['tel_oficina'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$calle = $_POST['calle'];
$numero_int = $_POST['numero_int'];
$numero_ext = $_POST['numero_ext'];
$colonia = $_POST['colonia'];
$municipio = $_POST['municipio'];
$localidad = $_POST['localidad'];
$codigo_postal = $_POST['codigo_postal'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$fk_id_partido = $_POST['fk_id_partido'];

include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';

$mysqli->set_charset("utf8");
$dependencia='';
$val='1';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
        $update = mysqli_query($con, "UPDATE contactos SET tel_oficina = '$tel_oficina', celular = '$celular', 
            email = '$email', calle = '$calle', numero_int = '$numero_int', numero_ext = '$numero_ext',
			colonia = '$colonia', municipio = '$municipio', localidad = '$localidad', codigo_postal = '$codigo_postal',
            fecha_nacimiento='$fecha_nacimiento', fk_id_partido = '$fk_id_partido'
            WHERE id_contacto = '$id_contacto' ")
	        
        or die(mysql_error());
        if ($update){
        echo "1";
        }else{
        echo "Error al actualizar los datos del contacto";
        }
mysqli_close($con);


$sub=filter_input(INPUT_POST, 'opcionSubcomision', FILTER_SANITIZE_STRING);

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
        if ($uno = $mysqli->prepare("UPDATE cargos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO cargos (id_contacto, cargo, id_dependencia,id_subcomision, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $cargo, $dependencia, $sub, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla cargos ';
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '1' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla actualizar pc de contacto ';
            }
        }
}



if ($sub=="6"&&isset($_POST['Secretaria'])) {
    $secretaria=filter_input(INPUT_POST, 'Secretaria', FILTER_SANITIZE_STRING);
$temp1='Secretaria';
        if ($uno = $mysqli->prepare("UPDATE campos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }

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
        if ($uno = $mysqli->prepare("UPDATE campos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("UPDATE puestos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }

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
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
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
        if ($uno = $mysqli->prepare("UPDATE puestos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $temp1, $PM, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
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
        if ($uno = $mysqli->prepare("UPDATE puestos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $cargo, $puesto, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
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
        if ($uno = $mysqli->prepare("UPDATE puestos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $cargo, $extra, $fechaI, $fechaT, $val);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            // Execute the prepared query.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
            }
        }
}
?>












