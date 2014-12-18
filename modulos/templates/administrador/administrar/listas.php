<?php
include_once '../../../../includes/psl-config.php';
//Se crea conexion a la base de datos
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//Cormprueba la conexion
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Recibe el catalogo seleccionado
$tabla= $_POST['catalago'];
//Si no selecciono ninguno, retorna un mensaje
if ($tabla === "0") {
	echo "Seleccione una opción";
}
else{

//Segun el catalago seleccionado se realiza la consulta con todos los campos
if ($tabla == "dependencias") {
	$consulta = "SELECT * FROM dependencias join subcomisiones on dependencias.tipo_dependencia = subcomisiones.id_subcomision";
}
elseif ($tabla == "subcomisiones") {
	$consulta = "SELECT * FROM subcomisiones";
}
else {
	$consulta = "SELECT * FROM partidos";
}

$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
 echo '<table border="1">';
 echo '<tr>';

//Si el catalogo es dependencias muestra el encabezado de la tabla para dependencias
if ($tabla == "dependencias") {
	
 echo '<td>Nombre</td>';
 echo '<td>Tipo</td>';
 echo '<td>Editar</td>';
 echo '</tr>';
//La consulta se guarda en un array (fila)
while($fila = mysqli_fetch_array($result))
{
	//Se despliegan todos los datos de la tabla dependencias
	echo '<tr>';
	echo '<td>'.utf8_encode($fila['nombre_dependencia']).'</td>';
	echo '<td>'.utf8_encode($fila['nombre_subcomision'].' '). '</td>';
 
 ?>
 <!-- Boton en la tabla que activa la funcion myFunction7 enviandole el parametro id_dependencia y nos carga un formulario para editar el campo -->
<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction7(<?php echo $fila['id_dependencia']; ?>)"></a></td>
<?php
 echo '</tr>';
}
}

//Si selecciono partidos
elseif ($tabla == "partidos") {
	//Encabezado de la tabla para partidos
 echo '<td>Nombre</td>';
 echo '<td>Siglas</td>';
 echo '<td>Editar</td>';
 echo '</tr>';

//Se guarda la consulta en un array (fila)
while($fila = mysqli_fetch_array($result))
{
	//Muestra los registros de la tabla partidos
	echo '<tr>';
	echo '<td>'.utf8_encode($fila['nombre_partido']).'</td>';
	echo '<td>'.$fila['siglas'].'</td>';
 
 ?>
 <!-- Boton en la tabla que activa la funcion myFunction7 enviandole el parametro id_partido y nos carga un formulario para editar el campo -->

<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction7(<?php echo $fila['id_partido']; ?>)"></a></td>
<?php
 echo '</tr>';

}
}

//Si selecciono Subcomisiones
elseif ($tabla == "subcomisiones") {
	//Encabezado para la tabla
 echo '<td>Nombre</td>';
 echo '<td>Editar</td>';
 echo '</tr>';

//Se almacena la consulta en un array
while($fila = mysqli_fetch_array($result))
{
	//Se muestran los registros de la tabla subcomisiones
	echo '<tr>';
	echo '<td>'.utf8_encode($fila['nombre_subcomision']).'</td>';
 ?>
 <!-- Boton en la tabla que activa la funcion myFunction7 enviandole el parametro id_subcomision y nos carga un formulario para editar el campo -->
<td><a href="#" class="icon-profile icoVerMas" onclick="myFunction7(<?php echo $fila['id_subcomision']; ?>)"></a></td>
<?php
 echo '</tr>';
}
}

echo '<div id="pers"></div>';
echo '</table>';
?>
	<!-- Formulario usado por la funcion myFunction7 para almacenar datos (id_campo y la tabla correspondiente) para ser enviados -->
	<form method="post" display="none" id="formPref">
		<input id="valor1" name="valor1" type="hidden" value="0">
		<input id="valor2" name="valor2" type="hidden" value="<?php echo $tabla; ?>">
	</form>
<?php
//Libera recursos
mysqli_free_result($result);
//Cierra la conexion
mysqli_close($con);
} //fin del if de comparacion a nulo

?> 