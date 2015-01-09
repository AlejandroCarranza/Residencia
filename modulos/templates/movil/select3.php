<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
include_once '../../../includes/functions.php';

	$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

$result = $con->query(" SELECT * FROM contactos
	LEFT JOIN partidos ON contactos.fk_id_partido =partidos.id_partido

			");

$outp = "{".'"contactos"'.":[";
$temp=$outp;
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != $temp) {
                $outp .= ",";
            }
                $outp .= '{"id_contacto":"'  . $rs["id_contacto"] . '",';
                $outp .= '"nombre":"'  . $rs["nombre"] . '",';
    			$outp .= '"apellido_paterno":"'   . $rs["apellido_paterno"]        . '",';
    			$outp .= '"apellido_materno":"'. $rs["apellido_materno"]     . '",';
    			$outp .= '"titulo":"'  . $rs["titulo"] . '",';
    			$outp .= '"calle":"'  . $rs["calle"] . '",';
    			$outp .= '"numero_int":"'  . $rs["numero_int"] . '",';
    			$outp .= '"numero_ext":"'  . $rs["numero_ext"] . '",';
    			$outp .= '"colonia":"'  . $rs["colonia"] . '",';
    			$outp .= '"municipio":"'  . $rs["municipio"] . '",';
    			$outp .= '"localidad":"'  . $rs["localidad"] . '",';
    			$outp .= '"codigo_postal":"'  . $rs["codigo_postal"] . '",';
    			$outp .= '"tel_oficina":"'  . $rs["tel_oficina"] . '",';
    			$outp .= '"celular":"'  . $rs["celular"] . '",';
    			$outp .= '"email":"'  . $rs["email"] . '",';
    			$outp .= '"fecha_nacimiento":"'  . $rs["fecha_nacimiento"] . '",';
    			$outp .= '"pc":"'  . $rs["pc"] . '",';
                $outp .= '"partido":"'   . $rs["siglas"]        . '"}';
               
            }
$outp .="]}";

$con->close();
echo($outp);
?>