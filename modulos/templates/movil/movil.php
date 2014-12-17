<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
include_once '../../../includes/psl-config.php';
sec_session_start();

function utf8_encode_all($dat){
	if (is_string($dat)) return utf8_encode($dat);
	if (!is_array($dat)) return $dat;
	$ret = array();
	foreach($dat as $i=>$d) $ret[$i] = utf8_encode_all($d);
	return $ret;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Movil</title>
</head>
<body>
<?php
	$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$result = $con->query(" SELECT *
		FROM contactos con
	/*	INNER JOIN partidos p ON con.fk_id_partido =  p.id_partido
		INNER JOIN contactos c ON sub.id_contacto =  c.id_contacto
		INNER JOIN dependencias d ON sub.id_dependencia =  d.id_dependencia
	*/	
		");

		//Forma 1 (Forma fea)
		while($fila[] = mysqli_fetch_assoc($result))
		{
		}
		//print_r($fila);
		$fila = utf8_encode_all($fila);
		echo json_encode($fila, JSON_ERROR_UTF8);
		


		//Forma 2, despliega bonito pero esta largo el codigo
		/*$outp = "[";
		while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    		if ($outp != "[") {$outp .= ",";}
    			$outp .= '{"id_contacto":"'  . $rs["id_contacto"] . '",';
    			$outp .= '"nombre":"'  . $rs["nombre"] . '",';
    			$outp .= '"apellido_paterno":"'   . $rs["apellido_paterno"]        . '",';
    			$outp .= '"apellido_materno":"'. $rs["apellido_materno"]     . '"}'; 
			}
			$outp .="]";

			$con->close();

			echo($outp);*/

?>	
</body>
</html>