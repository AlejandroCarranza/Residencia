<meta http-equiv="content-type" content="text/html; UTF-8" />

<?php header("Content-type: text/html; charset=utf8"); ?>
<?php
//Archivo con las configuraciones de la bd
include_once '../../../../includes/psl-config.php';

//Crea una conexion a la bd
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//Comprueba conexion
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Campos para lograr que utf-8 funcione perfectamente
$acentos = $con->query("SET NAMES 'utf8'");
mysqli_set_charset($con,"utf8");


//Asignacion de valores segun los enviados por el usuario
$idRegistro= $_POST['valor1'];
$tabla= $_POST['valor2'];

//Variables para ayudar en la consulta segun el tipo de consulta que se hara
$id_tabla = "";
if ($tabla == "dependencias") {
	$id_tabla = "id_dependencia";
}
elseif ($tabla == "partidos") {
	$id_tabla = "id_partido";
}
else{
	$id_tabla = "id_subcomision";
}
//Consulta para traer los datos actuales del registro seleccionado
$consulta = "SELECT * FROM $tabla where $id_tabla = $idRegistro";
$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error());
}
// Almacena el resultado de la consulta en un array(fila)
while($fila = mysqli_fetch_array($result)) {

	?>
	<!-- Se crea un div donde se cargara todo el contenido -->
	<div id="formReg">
    <form method="POST" id="formUpdate" accept-charset="utf-8" enctype="multipart/form-data">
        <br>
        <!-- Div oculto que almacena la tabla en la que se hizo la consulta -->
        <input type="hidden" class="input" name="tabla" value="<?php echo $tabla; ?>">
	<?php
	// Si se selecciono una dependencia para editar muestra el formulario para editar dependencias con los datos actuales del registro
	if ($tabla == "dependencias") {
    
    $tipo_dep = $fila['tipo_dependencia']; 
	?>	
		<!-- Campo oculto que contiene el id del registro -->
        <input type="hidden" class="input" name="id_dependencia" value="<?php echo $fila['id_dependencia']; ?>">
        Nombre: <input type="text" class="input" name="nombre_dependencia" value="<?php echo $fila['nombre_dependencia']; ?>">
		Tipo:
		
	<?php
		//Se crea un combo y lo llenamos con subcomites de manera dinamica desde la base de datos
		$consulta2 = "SELECT id_subcomision, nombre_subcomision FROM subcomisiones";
		$result2=mysqli_query($con, $consulta2) or die (mysqli_error($con)); 
		if($result2 === FALSE) {
    		die(mysqli_error());
		}
		echo '<select name="tipo_dependencia" id="tipo_dependencia">';
		while($fila2 = mysqli_fetch_array($result2)) {

			$compara_sub = $fila2['id_subcomision'];
			//Comparacion para seleccionar el subcomite que tiene asignado el registro
			if($tipo_dep == $compara_sub ){
				echo '<option selected value="'.$fila2['id_subcomision'].'"> '.$fila2['nombre_subcomision'].'</option>';
			}
			else
			echo '<option value="'.$fila2['id_subcomision'].'"> '.$fila2['nombre_subcomision'].'</option>';
		}
		echo '</select>';
		mysqli_free_result($result2);
	}
	elseif ($tabla == "partidos") {
		//Si la consulta es para editar un partido, se muestra el formulario adecuado lleno informacion del registro
	?>
		<!-- Campo oculto que contiene el id del registro -->
        <input type="hidden" class="input" name="id_partido" value="<?php echo $fila['id_partido']; ?>">
        Nombre: <input type="text" class="input" name="nombre_partido" value="<?php echo $fila['nombre_partido']; ?>">
		Siglas <input type="text" class="input" name="siglas" value="<?php echo $fila['siglas']; ?>">
		
	<?php
	}
	else{
	//Si no es ni dependencia ni partido, es un subcomite, muestra el formulario con los datos del registro seleccionado
	?>
		<!-- Campo oculto que contiene el id del registro -->
        <input type="hidden" class="input" name="tabla" value="<?php echo $tabla; ?>">
        <input type="hidden" class="input" name="id_subcomision" value="<?php echo $fila['id_subcomision']; ?>">
        Nombre: <input type="text" class="input" name="nombre_subcomision" value="<?php echo $fila['nombre_subcomision']; ?>">

	<?php
	
	}

	?>
	<!-- Boton para enviar los pametros por post usando ajax al activar la funcion actualizar2() que lanza el archivo actualizar.php -->
	<a href="#" id="actualiza" name="actualiza" class="btnEnviar2" onclick="actualizar2()">Actualizar</a>
	</form>
	</div>
	<?php
}
//Libera recursos
mysqli_free_result($result);
//Cierra conexion
mysqli_close($con);
?>