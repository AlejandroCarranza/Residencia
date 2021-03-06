<?php
//Se enlazan los archivos necesarios
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php';

//Inicia la funcion 
sec_session_start();
// Comprueba que la sesion activa corresponda al modulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

//Se crea una conexion a la base de datos usando las variables del archivo psl-config.php
$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Campos para lograr que utf-8 funcione perfectamente
$acentos = $con->query("SET NAMES 'utf8'");
mysqli_set_charset($con,"utf8");

//Se recibe el id del contacto solicitado
$id_contacto=$_POST['vcod'];
//Variables a usar
$tablaCP = "0";
$tabla = "0";
$tabla_camp = "0";
$valido = "0";
$puesto = "0";
$subcomite = "0";
$dependencia = "";


//Obtengo si buscare en cargos o en puestos segun lo que nos diga la tabla contactos
$consultaSQL1 = "SELECT pc FROM contactos where id_contacto='".$id_contacto."' ";

$result1=mysqli_query($con, $consultaSQL1) or die (mysqli_error($con)); 
if($result1 === FALSE) {
    die(mysqli_error()); 
}
//Se almacenan los datos que regresa la consulta en un array (fila1)
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
//Se almacenan los datos que regresa la consulta en un array (fila2)
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


//Traemos la informacion del contacto de la tabla contactos segun el id_contacto de la solicitud
$consultaSQL4 = "SELECT * FROM contactos WHERE id_contacto = $id_contacto ";
$result4=mysqli_query($con, $consultaSQL4) or die (mysqli_error($con)); 
if($result4 === FALSE) {
    die(mysqli_error());
}
//Se almacenan los datos que regresa la consulta en un array (fila4)
while($fila4 = mysqli_fetch_array($result4))
{
	//Boton cerrar de la tarjeta, al precionarlo llama la funcion ocultarCon()
	echo '<a href="#" class="cancelar icon-cancel-circle" title="Cerrar" onclick="ocultarCon()"></a>';
?>
	<!-- Boton Actualizar de la tarjeta, al presionarlo se envia el id_contacto a la funcion myFunctuion4 -->
	<a href="#" class="editar icon-pencil" title="Editar" onclick="myFunction4(<?php echo $fila4['id_contacto']; ?>)"></a>
<?php
	// Guardamos en variable el valor de foto
	$foto = $fila4['foto'];
	//Guardamos en variable el valor del partido
	$partido = $fila4['fk_id_partido'];
	//Comprobamos si el contacto tiene fotografia asignada, si tiene se crea una ruta para encontrar la imgen segun el id_contacto
	if ($foto > 0 ) {
		$rutaFoto='../../statics/images/contactos/'.$fila4['id_contacto'].'.jpg';
	}
	//Si no tiene, se crea una ruta para mostrar una imagen general
 	else{
 		$rutaFoto='../../statics/images/contactos/user.png';
 	}
 	//Mostramos en la tarjeta la foto segun la ruta asignada
 	echo '<img class="tarjetaFoto" src="'.$rutaFoto.'">';
 	//Muesta el resto de la informacion del contacto obtenida
	echo '<div class="encabezadoTarj"> <p class="tarjetaNom">'.$fila4['titulo']. " ".$fila4['nombre']. " ".$fila4['apellido_paterno']. " ".$fila4['apellido_materno']. '</p>';
	echo '<p class="tarjetaPuesto">'.$puesto. " en ".$dependencia. '</p> </div>';

	echo '<p class="tarjetaBasic">'."Telefono: ". " " .$fila4['tel_oficina'].'</p>';
	echo '<p class="tarjetaBasic">'."Celular: ". " " .$fila4['celular'].'</p>';
	echo '<p class="tarjetaBasic">' ."E-mail: ". " ".$fila4['email'].'</p>';

	?> 
	<!-- Muestra boton mostrar/ocultar, al presionarlo llama la funcion verMas que oculta o muestra el siguiente div -->
	<a href="#" class="verMas" onclick="verMas('mostrarMas')">Mostrar/Ocultar</a>
	<!-- Div donde se muestra el resto de la informacion del contacto no mostrada antes -->
	<div style="display:none" id="mostrarMas"> 
<?php
	echo '<p class="etiquetaTit">Dirección</p>';
	echo '<p class="tarjetaBasic">' ."Calle: ". " ".$fila4['calle'].'</p>';
	echo '<p class="tarjetaBasic">' ."No Ext: ". " ".$fila4['numero_ext'].'</p>';
	echo '<p class="tarjetaBasic">' ."No Int: ". " ".$fila4['numero_int'].'</p>';
	echo '<p class="tarjetaBasic">' ."Colonia: ". " ".$fila4['colonia'].'</p>';
	echo '<p class="tarjetaBasic">' ."C.Postal: ". " ".$fila4['codigo_postal'].'</p>';
	echo '<p class="tarjetaBasic">' ."Municipio: ". " ".$fila4['municipio'].'</p>';

	//Busca si tiene registros en la tabla campos
			$consultaSQL5 = "SELECT campo, valor FROM campos where fk_id_contacto ='".$id_contacto."' ";
			$result5=mysqli_query($con, $consultaSQL5) or die (mysqli_error($con)); 
			if($result5 === FALSE) {
    			die(mysqli_error()); 
			}

			echo '<p class="etiquetaTit">Extras</p>';
			echo '<p class="tarjetaBasic">' ."Cumpleaños: ". " ".$fila4['fecha_nacimiento'].'</p>';

			while($fila5 = mysqli_fetch_array($result5))
			{	
				echo '<p class="tarjetaBasic">' .$fila5['campo']. ": ".$fila5['valor'].'</p>';
			}	

	//Comprueba si tiene partido politico, e imprimimos el icono del partido
	if ($partido > 1) {
		//crea una ruta para buscar la imagen segun lo almacenado en $partido
		$rutaPartido='../../statics/images/partidos/'.$partido.'.png';
		//Muesta la imagen segun la ruta asignada
		echo '<img class="tarjetaPartido" src="'.$rutaPartido.'">';
	
	}
	
	//Historial de cargos
		$consultaSQL6 = "SELECT * FROM cargos c 
		INNER JOIN dependencias d ON c.id_dependencia = d.id_dependencia 
		where id_contacto ='".$id_contacto."' ";
		$result6=mysqli_query($con, $consultaSQL6) or die (mysqli_error($con)); 
		if($result6 === FALSE) {
    		die(mysqli_error()); 
		}
			echo '<p class="etiquetaTit">Historial de Puestos</p>';
			while($fila6 = mysqli_fetch_array($result6))
		{	
			echo '<p class="tarjetaBasic">' .$fila6['cargo']." en ".$fila6['nombre_dependencia']." | ".$fila6['fecha_inicio']." - ".$fila6['fecha_termino'].'</p>';
		}	
	//Historial de puestos
		$consultaSQL7 = "SELECT * FROM puestos p 
		INNER JOIN subcomisiones sb ON p.id_subcomision = sb.id_subcomision
		where id_contacto ='".$id_contacto."' ";
		$result7=mysqli_query($con, $consultaSQL7) or die (mysqli_error($con)); 
		if($result7 === FALSE) {
    			die(mysqli_error()); 
		}			
			while($fila7 = mysqli_fetch_array($result7))
		{	
			echo '<p class="tarjetaBasic">' .$fila7['nombre_subcomision']." de " .$fila7['extra']." | ".$fila7['fecha_inicio']." - ".$fila7['fecha_termino'].'</p>';
		}

		$consultaSQL8 = "SELECT valor, id FROM notas where id_contacto ='".$id_contacto."' ";
		$result8=mysqli_query($con, $consultaSQL8) or die (mysqli_error($con)); 
		if($result8 === FALSE) {
			die(mysqli_error());
			
		}
		echo '<p class="etiquetaTit">Notas</p>';
		echo '<ul>';
		while($fila8 = mysqli_fetch_array($result8))
		{	
			echo '<li class="tarjetaBasic">'.$fila8['valor'];
			echo '<form  method="post" name="formBNota" id="formBNota'.$fila8['id'].'" accept-charset="utf-8" enctype="multipart/form-data">';
            echo '<a href="#" class="icon-cancel-circle borrarnota" title="Borrar" data-idnota="'.$fila8['id'].'" ></a>';
            echo '<input type="hidden" value="'.$fila8['id'].'" id="notaid" name="borrarnotaid" >';
            echo '</form></li>';
		}

		echo '</ul>';
?>

		<form  method="post" name="formNota" id="formNota" accept-charset="utf-8" enctype="multipart/form-data">
        <div id="TipoSubcomision" class="tipo">
            <br>
            <span class="categorias">Nueva nota</span>
            <input type="text" class="input" id="nuevanota" name="nuevanota" placeholder="nota" />
            <input type="hidden" value="<?php echo $fila4['id_contacto']; ?>" id="notaid" name="notaid" >
        </div>
        <br>
            <input class="btnEnviar" onclick="myFunction8()" name="boton3" type="button" value="Guardar nota"/>
            <br>             
        </form>
</div>
<input type="hidden" value="" id="idCon" name="idCon" >
<div id="editarCon"></div>


<script type="text/javascript">
$(document).ready(function() {
  $(".borrarnota").click(function () {
    var $idnota = $(this).attr("data-idnota");

    myFunction9($idnota);
 
//$(".evento").orderBy(function() {return +$(this).attr("data-index");}).appendTo(".eventosContenedor");
  });
});
</script>


<?php
}
//Se liberan los recursos y la conexion
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_free_result($result4);
mysqli_free_result($result5);
mysqli_free_result($result6);
mysqli_free_result($result7);
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
