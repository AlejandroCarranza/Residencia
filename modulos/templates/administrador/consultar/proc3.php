<?php
//Se enlazan los archivos necesarios
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php'; 
//Inicia la funcion 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

//Se crea una conexion a la base de datos
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// comprueba la conexion a la base de datos
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Campos para lograr que utf-8 funcione perfectamente
$acentos = $con->query("SET NAMES 'utf8'");
mysqli_set_charset($con,"utf8");

$subcomite = $_POST['valor1'];
$tabla = $_POST['valor2'];
$cargo = "cargos";


//Consulta SQL que busca los contactos desde la tabla cargos o puestos segun el boton que selecciono el usuario
//$consulta = "SELECT * FROM $tabla join contactos on $tabla.id_contacto=contactos.id_contacto WHERE id_subcomision = '".$subcomite."' ";

if ($tabla == "cargos") {
	$consulta = " SELECT *
FROM $tabla sub
INNER JOIN contactos c ON sub.id_contacto =  c.id_contacto
INNER JOIN dependencias d ON sub.id_dependencia =  d.id_dependencia
WHERE id_subcomision = '".$subcomite."' ";
}
else {
$consulta = "SELECT * FROM $tabla join contactos on $tabla.id_contacto=contactos.id_contacto WHERE id_subcomision = '".$subcomite."' ";
}


if ($result = mysqli_query($con, $consulta)) {

    	/* determinar el número de filas del resultado */
    	$row_cnt = mysqli_num_rows($result);

    	//Pasamos el resultado a un array manipulable
    	if($row_cnt > 0){
//Muestra el encabezado de la tabla
 echo '<table border="1" class="tablaconmargen">';
 echo '<tr>';
 echo '<th>Nombre</td>';
 echo '<th>Puesto</td>';
 echo '<th>Lugar</td>';
 echo '<th>Más</td>';
 echo '</tr>';

//Se almacena el resultado de la consulta en un array (fila)
while($fila = mysqli_fetch_array($result))
{
	//Muestra el nombre 
 echo '<tr>';
 echo '<td>'.$fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno']. '</td>';
 // Comprueba si el contacto tiene asignado un cargo
if ($tabla == $cargo) {
	// Muestra el cargo
	 echo '<td>'.$fila['cargo'].'</td>';
	 //Muestra el lugar donde trabaja el contacto
	 echo '<td>'.$fila['nombre_dependencia'].'</td>';
}
//Si no tiene un cargo, entonces tiene un puesto
else{
	//muestra el puesto
	echo '<td>'.$fila['puesto'].'</td>';
	echo '<td>'.$fila['extra'].'</td>';
}

	
 ?>
 <!-- Boton para ver mas en la tabla que envia como parametro id_contacto a myFunction3 y esta activa proc2 para mostrar mas informacion del contacto-->
<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction3(<?php echo $fila['id_contacto']; ?>)"></a></td>
<?php
 echo '</tr>';

?>
<!-- myFunction 3 guarda el valor id_contacto en el input para posteriormente ser enviado por post a proc2-->
<input type="hidden" value="" id="vcod" name="vcod" >
<?php
}
// Se crea un div donde se cargara proc2 al activar myFunction3
echo '<div id="pers"></div>';
//Se cierra la tabla
echo '</table>';
}
else { 
	echo "Sin registros";
}
}
//Se liberan recursos
mysqli_free_result($result);
//Se cierra la conexion a la base de datos
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