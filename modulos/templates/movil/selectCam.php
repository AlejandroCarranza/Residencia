<?PHP
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
include_once '../../../includes/functions.php';

	$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

$result = $con->query(" SELECT * FROM campos");

$outp = "{".'"campos"'.":[";
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
$con->close();
echo($outp);


?>