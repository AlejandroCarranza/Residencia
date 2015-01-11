<?PHP
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
include_once '../../../includes/functions.php';

	$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

$result = $con->query(" SELECT * FROM cargos");

$outp = "{".'"cargos"'.":[";
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
$con->close();
echo($outp);


?>