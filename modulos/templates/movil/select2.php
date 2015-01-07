<?PHP
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
include_once '../../../includes/functions.php';

	$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

$result = $con->query(" SELECT * FROM contactos");

$outp = "{".'"contactos"'.":[";
		while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    		if ($outp != "{".'"contactos"'.":[") {
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
    			$outp .= '"fk_id_partido":"'  . $rs["fk_id_partido"] . '",';
    			$outp .= '"pc":"'  . $rs["pc"] . '",';
    			$outp .= '"foto":"'. $rs["foto"]     . '"}';

			}
$outp .="]}";


$result = $con->query(" SELECT * FROM campos");

$outp .= "{".'"campos"'.":[";
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != "{".'"campos"'.":[") {
                $outp .= ",";
            }
                $outp .= '{"id_campo":"'  . $rs["id_campo"] . '",';
                $outp .= '"fk_id_contacto":"'  . $rs["fk_id_contacto"] . '",';
                $outp .= '"campo":"'   . $rs["campo"]        . '",';
                $outp .= '"valor":"'. $rs["valor"]     . '",';
                $outp .= '"valido":"'  . $rs["valido"] . '"}';

            }
$outp .="]}";

$result = $con->query(" SELECT * FROM cargos");

$outp .= "{".'"cargos"'.":[";
$temp=$outp;
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != $temp) {
                $outp .= ",";
            }
                $outp .= '{"id_cargo":"'  . $rs["id_cargo"] . '",';
                $outp .= '"id_contacto":"'  . $rs["id_contacto"] . '",';
                $outp .= '"id_subcomision":"'   . $rs["id_subcomision"]        . '",';
                $outp .= '"cargo":"'. $rs["cargo"]     . '",';
                $outp .= '"id_dependencia":"'  . $rs["id_dependencia"] . '",';
                $outp .= '"fecha_inicio":"'  . $rs["fecha_inicio"] . '",';
                $outp .= '"fecha_termino":"'  . $rs["fecha_termino"] . '",';
                $outp .= '"valido":"'  . $rs["valido"] . '"}';
               
            }
$outp .="]}";


$result = $con->query(" SELECT * FROM dependencias");

$outp .= "{".'"dependencias"'.":[";
$temp=$outp;
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != $temp) {
                $outp .= ",";
            }
                $outp .= '{"id_dependencia":"'  . $rs["id_dependencia"] . '",';
                $outp .= '"nombre_dependencia":"'  . $rs["nombre_dependencia"] . '",';
                $outp .= '"tipo_dependencia":"'   . $rs["tipo_dependencia"]        . '"}';
               
            }
$outp .="]}";

$result = $con->query(" SELECT * FROM partidos");

$outp .= "{".'"partidos"'.":[";
$temp=$outp;
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != $temp) {
                $outp .= ",";
            }
                $outp .= '{"id_partido":"'  . $rs["id_partido"] . '",';
                $outp .= '"nombre_partido":"'  . $rs["nombre_partido"] . '",';
                $outp .= '"siglas":"'   . $rs["siglas"]        . '"}';
               
            }
$outp .="]}";

$result = $con->query(" SELECT * FROM puestos");

$outp .= "{".'"puestos"'.":[";
$temp=$outp;
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != $temp) {
                $outp .= ",";
            }
                $outp .= '{"id_puesto":"'  . $rs["id_puesto"] . '",';
                $outp .= '"id_contacto":"'  . $rs["id_contacto"] . '",';
                $outp .= '"id_subcomision":"'  . $rs["id_subcomision"] . '",';
                $outp .= '"puesto":"'  . $rs["puesto"] . '",';
                $outp .= '"extra":"'  . $rs["extra"] . '",';
                $outp .= '"fecha_inicio":"'  . $rs["fecha_inicio"] . '",';
                $outp .= '"fecha_termino":"'  . $rs["fecha_termino"] . '",';
                $outp .= '"valido":"'   . $rs["valido"]        . '"}';
               
            }
$outp .="]}";

$result = $con->query(" SELECT * FROM subcomisiones");

$outp .= "{".'"subcomisiones"'.":[";
$temp=$outp;
        while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
            if ($outp != $temp) {
                $outp .= ",";
            }
                $outp .= '{"id_subcomision":"'  . $rs["id_subcomision"] . '",';
                $outp .= '"nombre_subcomision":"'  . $rs["nombre_subcomision"] . '"}';
               
            }
$outp .="]}";



$con->close();
echo($outp);


?>