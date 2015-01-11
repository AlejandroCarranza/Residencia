<?PHP
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
include_once '../../../includes/functions.php';

	$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

$result = $con->query(" SELECT * FROM puestos");

$outp = "{".'"puestos"'.":[";
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
$con->close();
echo($outp);


?>