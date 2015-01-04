<?php
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php';

//Inicia la funcion 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

// Recepción de datos del formulario
$id_contacto = $_POST['id_contacto'];
$nombre = $_POST['nombre'];
$apellido_paterno = $_POST['apellido_paterno'];
$apellido_materno = $_POST['apellido_materno'];
$titulo = $_POST['titulo'];
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

$mysqli->set_charset("utf8");
$dependencia=''; // Si no cambia su valor entonces no se cambio la dependencia
$val='1'; // "val" se usa para determinar si contacto tiene cargo o puesto o en el momento actual, "0" significa que tuvo el cargo o puesto en el pasado, "1" es que tiene el cargo o puesto actualmente.

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Campos para lograr que utf-8 funcione perfectamente
$acentos = $con->query("SET NAMES 'utf8'");
mysqli_set_charset($con,"utf8");

// Realiza la actualización de datos en la base de datos conforme a lo que se recibió en las variables
        $update = mysqli_query($con, "UPDATE contactos SET nombre='$nombre', apellido_paterno='$apellido_paterno', apellido_materno='$apellido_materno',tel_oficina = '$tel_oficina', celular = '$celular', 
            email = '$email', titulo='$titulo', calle = '$calle', numero_int = '$numero_int', numero_ext = '$numero_ext',
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
    // Sanneamiento y asignación de datos
    $dependencia=filter_input(INPUT_POST, 'dep1', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo1', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI1', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT1', FILTER_SANITIZE_STRING);
}
if ($sub=="2"&&isset($_POST['dep2'])) {
    // Sanneamiento y asignación de datos
    $dependencia=filter_input(INPUT_POST, 'dep2', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo2', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI2', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT2', FILTER_SANITIZE_STRING);
}
if ($sub=="3"&&isset($_POST['dep3'])) {
    // Sanneamiento y asignación de datos
    $dependencia=filter_input(INPUT_POST, 'dep3', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo3', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI3', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT3', FILTER_SANITIZE_STRING);
}
if ($sub=="4"&&isset($_POST['dep4'])) {
    // Sanneamiento y asignación de datos
    $dependencia=filter_input(INPUT_POST, 'dep4', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo4', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI4', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT4', FILTER_SANITIZE_STRING);
}
if ($sub=="6"&&isset($_POST['dep6'])) {
    // Sanneamiento y asignación de datos
    $dependencia=filter_input(INPUT_POST, 'dep6', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo6', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI6', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT6', FILTER_SANITIZE_STRING);
}
if ($sub=="8"&&isset($_POST['dep8'])) {
    // Sanneamiento y asignación de datos
    $dependencia=filter_input(INPUT_POST, 'dep8', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo8', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI8', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT8', FILTER_SANITIZE_STRING);
}
if ($sub=="11"&&isset($_POST['dep11'])) {
    // Sanneamiento y asignación de datos
    $dependencia=filter_input(INPUT_POST, 'dep11', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo11', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI11', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT11', FILTER_SANITIZE_STRING);
}


if ($dependencia!='') { // Si se recibió un valor de dependencia entonces se actualiza en la base de datos
        
        if ($uno = $mysqli->prepare("UPDATE cargos SET valido = '0' WHERE id_contacto = ?")) { // Preparación de la sentencia. Aquí se invalida el cargo anterior
            $uno->bind_param('s', $id_contacto);
            // Ejecución de la sentencia
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO cargos (id_contacto, cargo, id_dependencia,id_subcomision, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) { // Se asigna un nuevo cargo
            $uno->bind_param('sssssss', $id_contacto, $cargo, $dependencia, $sub, $fechaI, $fechaT, $val);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla cargos ';
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '1' WHERE id_contacto = ?")) { // Se indica que el contacto ahora tiene un cargo
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla actualizar pc de contacto ';
            }
        }
}



if ($sub=="6"&&isset($_POST['Secretaria'])) { // El campo secretaria es extra, con la siguiente sentencia se agrega este valor
    $secretaria=filter_input(INPUT_POST, 'Secretaria', FILTER_SANITIZE_STRING);
$temp1='Secretaria';
        if ($uno = $mysqli->prepare("UPDATE campos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }

        if ($uno = $mysqli->prepare("INSERT INTO campos (fk_id_contacto, campo, valor, valido) VALUES (?, ?, ?, ?)")) {
            $uno->bind_param('ssss', $id_contacto, $temp1, $secretaria, $val);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
}

if ($sub=="5"&&isset($_POST['municipioEM'])) {
    $EM=filter_input(INPUT_POST, 'municipioEM', FILTER_SANITIZE_STRING);
    $UAR=filter_input(INPUT_POST, 'UAR', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI5', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT5', FILTER_SANITIZE_STRING);

$temp1='Enlace Municipal';
$temp2='UAR';
        if ($uno = $mysqli->prepare("UPDATE campos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("UPDATE puestos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }

        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $temp1, $EM, $fechaI, $fechaT, $val);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO campos (fk_id_contacto, campo, valor, valido) VALUES (?, ?, ?, ?)")) {
            $uno->bind_param('ssss', $id_contacto, $temp2, $UAR, $val);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
            }
        }
}



if ($sub=="7"&&isset($_POST['municipioPM'])) {
    $PM=filter_input(INPUT_POST, 'municipioPM', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI7', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT7', FILTER_SANITIZE_STRING);


$temp1='Presidente Municipal';
        if ($uno = $mysqli->prepare("UPDATE puestos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $temp1, $PM, $fechaI, $fechaT, $val);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
            }
        }
}

if ($sub=="9"&&isset($_POST['Cargo9'])) {
    $puesto=filter_input(INPUT_POST, 'Cargo9', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI9', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT9', FILTER_SANITIZE_STRING);

$cargo='Regidor';
        if ($uno = $mysqli->prepare("UPDATE puestos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $cargo, $puesto, $fechaI, $fechaT, $val);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
            }
        }
}

if ($sub=="10"&&isset($_POST['Cargo10'])) {
    $extra=filter_input(INPUT_POST, 'Cargo10', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI10', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT10', FILTER_SANITIZE_STRING);

$cargo='Diputado';
        if ($uno = $mysqli->prepare("UPDATE puestos SET valido = '0' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para actualizar cargo ';
            }
        }
        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $cargo, $extra, $fechaI, $fechaT, $val);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos '.$sub;
            }
        }
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '0' WHERE id_contacto = ?")) {
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
            }
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
?>












