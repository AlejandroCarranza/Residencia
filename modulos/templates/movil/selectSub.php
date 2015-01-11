<?PHP
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
include_once '../../../includes/functions.php';

	$con = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

$result = $con->query(" SELECT * FROM subcomisiones");

$outp = "{".'"subcomisiones"'.":[";
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