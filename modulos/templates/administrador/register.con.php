<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
include_once '../../../includes/functions.php';

sec_session_start();

if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

$mysqli->set_charset("utf8");
$dependencia=''; // Recibirá el nombre de la dependencia, si no lo recibe no insertará el cargo o puesto
$val='1'; 
if (isset($_POST['nombre'], $_POST['apellidoP'])) {
    // Saneamiento de los datos recibidos 
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


        // Inserta el nuevo contacto únicamente en la tabla de contactos
        // Primero se prepara la sentencia, se dejan los valores listo para asignarse
        if ($insert_stmt = $mysqli->prepare("INSERT INTO contactos (nombre, apellido_paterno, apellido_materno, titulo, 
            fecha_nacimiento, fk_id_partido, calle, numero_int, numero_ext, colonia, municipio, localidad, tel_Oficina, celular, email, codigo_postal) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
            // Se asignan los valores de las variables a la sentencia
            $insert_stmt->bind_param('ssssssssssssssss', $nombre, $apellido_paterno, $apellido_materno, $titulo, $fechaNacimiento, $partido, $calle, $numInt, $numExt, $colonia, $municipio, $localidad, $TelCel, $TelOfc, $Email, $codigo_postal);
            // Ejecuta la sentencia preparada
            if (! $insert_stmt->execute()) {
                echo "Error al agregar el contacto"; // Si ocurrió algún error se enviará como respuesta. Esto no se muestra en la página.
            } echo "1"; // Si se ejecutó de manera correcta mandará como respuesta "1".
        } 

$id_contacto = $mysqli->insert_id; // Guarda en una variable el id del último contacto guardado
$sub=filter_input(INPUT_POST, 'sub', FILTER_SANITIZE_STRING); // Recoge el valor del tipo de contacto

if ($sub=="1"&&isset($_POST['dep1'])) {
    // Saneamiento de los datos recibidos
    $dependencia=filter_input(INPUT_POST, 'dep1', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo1', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI1', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT1', FILTER_SANITIZE_STRING);
}
if ($sub=="2"&&isset($_POST['dep2'])) {
    $dependencia=filter_input(INPUT_POST, 'dep2', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo2', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI2', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT2', FILTER_SANITIZE_STRING);
}
if ($sub=="3"&&isset($_POST['dep3'])) {
    $dependencia=filter_input(INPUT_POST, 'dep3', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo3', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI3', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT3', FILTER_SANITIZE_STRING);
}
if ($sub=="4"&&isset($_POST['dep4'])) {
    $dependencia=filter_input(INPUT_POST, 'dep4', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo4', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI4', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT4', FILTER_SANITIZE_STRING);
}
if ($sub=="6"&&isset($_POST['dep6'])) {
    $dependencia=filter_input(INPUT_POST, 'dep6', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo6', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI6', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT6', FILTER_SANITIZE_STRING);
}
if ($sub=="8"&&isset($_POST['dep8'])) {
    $dependencia=filter_input(INPUT_POST, 'dep8', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo8', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI8', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT8', FILTER_SANITIZE_STRING);
}
if ($sub=="11"&&isset($_POST['dep11'])) {
    $dependencia=filter_input(INPUT_POST, 'dep11', FILTER_SANITIZE_STRING);
    $cargo=filter_input(INPUT_POST, 'Cargo11', FILTER_SANITIZE_STRING);
    $fechaI=filter_input(INPUT_POST, 'fechaI11', FILTER_SANITIZE_STRING);
    $fechaT=filter_input(INPUT_POST, 'fechaT11', FILTER_SANITIZE_STRING);
}


if ($dependencia!='') { // Si se recibió un nombre de dependencia entonces se guardará el cargo del contacto
        // Preparación de la sentencia
        if ($uno = $mysqli->prepare("INSERT INTO cargos (id_contacto, cargo, id_dependencia,id_subcomision, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $cargo, $dependencia, $sub, $fechaI, $fechaT, $val);
            // Ejecución de la sentencia.
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
            }
        }
        // Aquí se actualiza la tabla de contactos indicando que el contacto tiene un cargo, esto mediante el campo "pc", el '1' significa que es cargo
        if ($uno = $mysqli->prepare("UPDATE contactos SET pc = '1' WHERE id_contacto = ?")) {
            $uno->bind_param('s', $id_contacto);
            if (! $uno->execute()) {
                echo 'Error en sentencia para tabla campos ';
            }
        }
}
// El tipo de contacto 6 tiene el campo extra secretaria. Aquí se ejecuta una sentencia para agregar este valor.
if ($sub=="6"&&isset($_POST['Secretaria'])) {
    $secretaria=filter_input(INPUT_POST, 'Secretaria', FILTER_SANITIZE_STRING);
$temp1='Secretaria';
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

        if ($uno = $mysqli->prepare("INSERT INTO puestos (id_contacto, id_subcomision, puesto, extra, fecha_inicio, fecha_termino, valido) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $uno->bind_param('sssssss', $id_contacto, $sub, $cargo, $extra, $fechaI, $fechaT, $val);
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


}
}
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php }

?>