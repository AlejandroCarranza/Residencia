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
$tmp = "";


//Consulta SQL que busca los contactos desde la tabla cargos o puestos.

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

//Se almacena el resultado de la consulta en un array (fila)
while($fila = mysqli_fetch_array($result))
{
	//Muestra los correos
 $tmp = $tmp . $fila['email'] . ", ";
}

}
else { 
	echo "Sin registros";
}
}
?> 
<input class="inputAct" name="correos" id="correos" type="text" value="<?php echo $tmp; ?>">
<a href="#" id="copiarCb" class="btnEnviar2">Copiar</a>

<script>
    $(document).ready(function(){
        $("a#copiarCb").zclip({
           path:"../../statics/js/ZeroClipboard.swf",
           copy:function(){return $("input#correos").val();}
        });
    });
</script>
<?php
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