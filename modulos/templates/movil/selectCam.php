<?PHP
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
include_once '../../../includes/functions.php';

	$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
echo '<meta charset="UTF-8">';
if ((login_check($mysqli) == true) && (($_SESSION['type'] == '0')||($_SESSION['type'] == '1')
    ||($_SESSION['type'] == '2')||($_SESSION['type'] == '3'))){
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

}
// Si no se aprueba la sesion muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php }
?>