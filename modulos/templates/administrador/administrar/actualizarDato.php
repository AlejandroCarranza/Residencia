<?php

include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

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
$consulta = "SELECT * FROM $tabla where $id_tabla = $idRegistro";
$result=mysqli_query($con, $consulta) or die (mysqli_error($con)); 
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
while($fila = mysqli_fetch_array($result)) {

	?>
	<div id="formReg">
    <form method="POST" id="formUpdate">
        <br>
        <input type="hidden" class="input" name="tabla" value="<?php echo $tabla; ?>">
	<?php
	if ($tabla == "dependencias") {
    
    $tipo_dep = $fila['tipo_dependencia']; 
	?>
        <input type="hidden" class="input" name="id_dependencia" value="<?php echo $fila['id_dependencia']; ?>">
        Nombre: <input type="text" class="input" name="nombre_dependencia" value="<?php echo $fila['nombre_dependencia']; ?>">
		Tipo: <input type="text" class="input" name="tipo_dependencia" value="<?php echo $fila['tipo_dependencia']; ?>">
		
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
				echo '<option selected value="'.$fila2['id_subcomision'].'"> '.utf8_encode($fila2['nombre_subcomision']).'</option>';
			}
			else
			echo '<option value="'.$fila2['id_subcomision'].'"> '.utf8_encode($fila2['nombre_subcomision']).'</option>';
		}
		echo '</select>';
		mysqli_free_result($result2);
	}
	elseif ($tabla == "partidos") {
	?>
        <input type="hidden" class="input" name="id_partido" value="<?php echo $fila['id_partido']; ?>">
        Nombre: <input type="text" class="input" name="nombre_partido" value="<?php echo $fila['nombre_partido']; ?>">
		Siglas <input type="text" class="input" name="siglas" value="<?php echo $fila['siglas']; ?>">
		
	<?php
	}
	else{
	?>
        <input type="hidden" class="input" name="tabla" value="<?php echo $tabla; ?>">
        <input type="hidden" class="input" name="id_subcomision" value="<?php echo $fila['id_subcomision']; ?>">
        Nombre: <input type="text" class="input" name="nombre_subcomision" value="<?php echo $fila['nombre_subcomision']; ?>">
		?>
		<a href="#" id="actualiza" name="actualiza" class="btnEnviar2" onclick="actualizar2()">Actualizar</a>
	</form>
	</div>
	<?php
	
	}
}
mysqli_free_result($result);
mysqli_close($con);
?>