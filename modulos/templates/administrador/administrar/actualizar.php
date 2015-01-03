<?php
//Archivo con las configuraciones de la bd
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php';
 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

//Crea una conexion a la bd usando los parametros del archivo psl.config.php
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//Comprueba conexion
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Configuraciones para que el utf-8 funcione perfectamente
$acentos = $con->query("SET NAMES 'utf8'");
mysqli_set_charset($con,"utf8");

//Recibe el parametro tabla desde actualizarDato
$tabla= $_POST['tabla'];

//Si la tabla es dependencias, recibe los parametros necesarios enviados
if ($tabla == "dependencias") {
	$id_dependencia = $_POST['id_dependencia'];
	$nombre_dependencia = $_POST['nombre_dependencia'];
	$tipo_dependencia = $_POST['tipo_dependencia'];

    //Se envian los parametros para actualizar el registro con los parametros nuevos
	$update = mysqli_query($con, "UPDATE $tabla SET nombre_dependencia = '$nombre_dependencia',
	tipo_dependencia = '$tipo_dependencia' WHERE id_dependencia = '$id_dependencia' ")
        
        //comprueba si se hizo la actualizacion yretorna un mensaje de exito o de fallo
        or die(mysql_error());
        if ($update){
        echo "1";
        }else{
        echo "0";
        }

}
//Si la tabla es partidos, recibe los parametros necesarios enviados
elseif ($tabla == "partidos") {
	$id_partido = $_POST['id_partido'];
	$nombre_partido = $_POST['nombre_partido'];
	$siglas = $_POST['siglas'];

    //Se envian los parametros para actualizar el registro con los parametros nuevos
	$update = mysqli_query($con, "UPDATE $tabla SET nombre_partido = '$nombre_partido',
	siglas = '$siglas' WHERE id_partido = '$id_partido' ")
        
        //comprueba si se hizo la actualizacion yretorna un mensaje de exito o de fallo
        or die(mysql_error());
        if ($update){
        echo "1";
        }else{
        echo "0";
        }
}
//Si no es dependencia ni partido, entonces es subcomision, recibe los parametros necesarios enviados
else {
	$id_subcomision = $_POST['id_subcomision'];
	$nombre_subcomision = $_POST['nombre_subcomision'];

    //Se envian los parametros para actualizar el registro con los parametros nuevos
	$update = mysqli_query($con, "UPDATE $tabla SET nombre_subcomision = '$nombre_subcomision'
		WHERE id_subcomision = '$id_subcomision' ")
        
        //comprueba si se hizo la actualizacion yretorna un mensaje de exito o de fallo
        or die(mysql_error());
        if ($update){
        echo "1";
        }else{
        echo "0";
        }
}
//cierra la conexion
mysqli_close($con);

}
// Si no se aprueba la sesion muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php
}
?>