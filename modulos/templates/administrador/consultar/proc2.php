<?php
include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id_contacto=$_POST['vcod'];
$tablaCP = "0";
$tabla = "0";
$tabla_camp = "0";
$valido = "0";
$puesto = "0";
$subcomite = "0";
$dependencia = "";


//Obtengo si buscare en cargos o en puestos
$consultaSQL1 = "SELECT pc FROM contactos where id_contacto='".$id_contacto."' ";

$result1=mysqli_query($con, $consultaSQL1) or die (mysqli_error($con)); 
if($result1 === FALSE) {
    die(mysqli_error()); 
}

while($fila1 = mysqli_fetch_array($result1))
{
	$tablaCP = $fila1['pc'];
	//compruebo si es cargo o puesto y guardo en variables
	if($tablaCP > 0 ){
 	 	$tabla = "cargos";
 	 	$tabla_camp = "cargo";
 	}
 	else {
 	 	$tabla = "puestos";
 	 	$tabla_camp = "puesto";
 	}
}

//Teniendo la tabla correcta, obtenemos el puesto
$consultaSQL2 = "SELECT * FROM $tabla where id_contacto='".$id_contacto."' ";
$result2=mysqli_query($con, $consultaSQL2) or die (mysqli_error($con)); 
if($result2 === FALSE) {
    die(mysqli_error()); 
}

while($fila2 = mysqli_fetch_array($result2))
{
	$puesto_temp = $fila2[$tabla_camp];
	$valido = $fila2['valido'];

	//Comprobamos que sea el puesto actual
	if ($valido > 0) {
		$puesto = $puesto_temp;
		$subcomite = $fila2['id_subcomision'];
		if ($tabla=="cargos") {
			$dependencia = $fila2['id_dependencia'];

			//Se obtiene el nombre de la dependencia segun el id obtenido
			$consultaSQL3 = "SELECT nombre_dependencia FROM dependencias where id_dependencia ='".$dependencia."' ";
			$result3=mysqli_query($con, $consultaSQL3) or die (mysqli_error($con)); 
			if($result3 === FALSE) {
    			die(mysqli_error()); 
			}

			while($fila3 = mysqli_fetch_array($result3))
			{
				$dependencia = $fila3['nombre_dependencia']; //Se asigna el nombre de la dependencia a la variable
			}
			mysqli_free_result($result3);
		}
		else{
			$dependencia = $fila2['extra'];
		}
		
	}
}


//Traemos la informacion del contacto
$consultaSQL4 = "SELECT * FROM contactos WHERE id_contacto = $id_contacto ";
$result4=mysqli_query($con, $consultaSQL4) or die (mysqli_error($con)); 
if($result4 === FALSE) {
    die(mysqli_error());
}

while($fila4 = mysqli_fetch_array($result4))
{
	
	echo '<a href="#" class="cancelar icon-cancel-circle" title="Cerrar" onclick="ocultarCon()"></a>';
?>
	<a href="#" class="editar icon-pencil" title="Editar" onclick="myFunction4(<?php echo $fila4['id_contacto']; ?>)"></a>
<?php

	$foto = $fila4['foto'];
	$partido = $fila4['fk_id_partido'];

	if ($foto > 0 ) {
		$rutaFoto='../../statics/images/contactos/'.$fila4['id_contacto'].'.jpg';
	}
 	else{
 		$rutaFoto='../../statics/images/contactos/user.png';
 	}

 	echo '<img class="tarjetaFoto" src="'.$rutaFoto.'">';
	echo '<div class="encabezadoTarj"> <p class="tarjetaNom">'.utf8_encode($fila4['titulo']. " ".$fila4['nombre']. " ".$fila4['apellido_paterno']. " ".$fila4['apellido_materno'].' '). '</p>';
	echo '<p class="tarjetaPuesto">'.utf8_encode($puesto. " en ".$dependencia.' '). '</p> </div>';

	echo '<p class="tarjetaBasic">'."Telefono: ". " " .$fila4['tel_oficina'].'</p>';
	echo '<p class="tarjetaBasic">'."Celular: ". " " .$fila4['celular'].'</p>';
	echo '<p class="tarjetaBasic">' ."E-mail: ". " ".$fila4['email'].'</p>';

	?> 

	<a href="#" class="verMas" onclick="verMas('mostrarMas')">Mostrar/Ocultar</a>

	<div style="display:none" id="mostrarMas"> 
<?php
	echo '<p class="etiquetaTit">Dirección</p>';
	echo '<p class="tarjetaBasic">' ."Calle: ". " ".$fila4['calle'].'</p>';
	echo '<p class="tarjetaBasic">' ."No Ext: ". " ".$fila4['numero_ext'].'</p>';
	echo '<p class="tarjetaBasic">' ."No Int: ". " ".$fila4['numero_int'].'</p>';
	echo '<p class="tarjetaBasic">' ."Colonia: ". " ".$fila4['colonia'].'</p>';
	echo '<p class="tarjetaBasic">' ."Municipio: ". " ".$fila4['municipio'].'</p>';

	//Buscamos si tiene registros en la tabla campos
			$consultaSQL5 = "SELECT campo, valor FROM campos where fk_id_contacto ='".$id_contacto."' ";
			$result5=mysqli_query($con, $consultaSQL5) or die (mysqli_error($con)); 
			if($result5 === FALSE) {
    			die(mysqli_error()); 
			}

			echo '<p class="etiquetaTit">Extras</p>';

			while($fila5 = mysqli_fetch_array($result5))
			{	
				echo '<p class="tarjetaBasic">' .$fila5['campo']. ": ".$fila5['valor'].'</p>';
			}	

	//Comprobamos si tiene partido politico, e imprimimos el icono del partido
	if ($partido > 0) {
		$rutaPartido='../../statics/images/partidos/'.$partido.'.png';
		echo '<img class="tarjetaPartido" src="'.$rutaPartido.'">';
	
	}
?> 
</div>
<input type="hidden" value="" id="idCon" name="idCon" >
<div id="editarCon"></div>
<?php
}
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result4);
mysqli_free_result($result5);
mysqli_close($con);
?>