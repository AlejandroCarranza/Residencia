<?php
//Se enlazan los archivos necesarios
include_once '../../../../includes/psl-config.php';
//Se crea una conexion a la base de datos
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// comprueba la conexion a la base de datos
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
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


$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); 
}
//Muestra el encabezado de la tabla
 echo '<table border="1">';
 echo '<tr>';
 echo '<td>Nombre</td>';
 echo '<td>Puesto</td>';
 echo '<td>Lugar</td>';
 echo '<td>Más</td>';
 echo '</tr>';

//Se almacena el resultado de la consulta en un array (fila)
while($fila = mysqli_fetch_array($result))
{
	//Muestra el nombre 
 echo '<tr>';
 echo '<td>'.utf8_encode($fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno'].' '). '</td>';
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
//Se liberan recursos
mysqli_free_result($result);
//Se cierra la conexion a la base de datos
mysqli_close($con);
?> 