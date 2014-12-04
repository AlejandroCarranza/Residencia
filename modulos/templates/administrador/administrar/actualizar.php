<?php
include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$acentos = $con->query("SET NAMES 'utf8'");
mysqli_set_charset($con,"utf8");

$tabla= $_POST['tabla'];

if ($tabla == "dependencias") {
	$id_dependencia = $_POST['id_dependencia'];
	$nombre_dependencia = $_POST['nombre_dependencia'];
	$tipo_dependencia = $_POST['tipo_dependencia'];

	$update = mysqli_query($con, "UPDATE $tabla SET nombre_dependencia = '$nombre_dependencia',
	tipo_dependencia = '$tipo_dependencia' WHERE id_dependencia = '$id_dependencia' ")
        
        or die(mysql_error());
        if ($update){
        echo "1";
        }else{
        echo "0";
        }

}
elseif ($tabla == "partidos") {
	$id_partido = $_POST['id_partido'];
	$nombre_partido = $_POST['nombre_partido'];
	$siglas = $_POST['siglas'];

	$update = mysqli_query($con, "UPDATE $tabla SET nombre_partido = '$nombre_partido',
	siglas = '$siglas' WHERE id_partido = '$id_partido' ")
        
        or die(mysql_error());
        if ($update){
        echo "1";
        }else{
        echo "0";
        }
}
else {
	$id_subcomision = $_POST['id_subcomision'];
	$nombre_subcomision = $_POST['nombre_subcomision'];

	$update = mysqli_query($con, "UPDATE $tabla SET nombre_subcomision = '$nombre_subcomision'
		WHERE id_subcomision = '$id_subcomision' ")
        
        or die(mysql_error());
        if ($update){
        echo "1";
        }else{
        echo "0";
        }
}
mysqli_close($con);
?>