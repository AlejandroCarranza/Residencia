<?php
include_once '../../../includes/psl-config.php';

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$codigo=$_POST['idCon'];


$result=mysqli_query($con,"SELECT * FROM contactos where id_contacto='".$codigo."' ");
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}
$result2=mysqli_query($con,"SELECT * FROM subcomisiones ");
if($result === FALSE) {
    die(mysqli_error()); // TODO: better error handling
}

while($fila = mysqli_fetch_array($result))
{
	?>
    <div id="formCon">
      <form method="POST" id="formUpdate">
        <?php
          $rutaFoto='../statics/images/contactos/'.$fila['id_contacto'].'.jpg';
          echo '<img class="tarjetaFoto" src="'.$rutaFoto.'">';
          echo '<p class="tarjetaNom">'.utf8_encode($fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno'].' '). '</p>';

        ?>
        <br>
        <input name="id_contacto" type="hidden" value="<?php echo $fila['id_contacto']; ?>">
        <p class="etiquetaTit">Contacto</p>
        <p class="etiquetas">Tel. Oficina:</p><input class="inputAct" name="tel_oficina" type="text" value="<?php echo $fila['tel_oficina']; ?>">
        <p class="etiquetas">Celular:</p><input class="inputAct" name="celular" type="text" value="<?php echo $fila['celular']; ?>">
        <p class="etiquetas">Email:</p><input class="inputAct" name="email" type="text" value="<?php echo $fila['email']; ?>"> 

        <p class="etiquetaTit">Dirección</p>
        <p class="etiquetas">Calle:</p><input class="inputAct" name="calle" type="text" value="<?php echo $fila['calle']; ?>">
        <p class="etiquetas">No Int:</p><input class="inputAct" name="numero_int" type="text" value="<?php echo $fila['numero_int']; ?>">
        <p class="etiquetas">No Ext:</p><input class="inputAct" name="numero_ext" type="text" value="<?php echo $fila['numero_ext']; ?>"> 
        <br>
        <p class="etiquetas">Colonia:</p><input class="inputAct" name="colonia" type="text" value="<?php echo $fila['colonia']; ?>"> 
        <p class="etiquetas">Municipio:</p><input class="inputAct" name="municipio" type="text" value="<?php echo $fila['municipio']; ?>"> 
        <p class="etiquetas">Localidad:</p><input class="inputAct" name="localidad" type="text" value="<?php echo $fila['localidad']; ?>"> 
        <br>
        <p class="etiquetas">Código Postal:</p><input class="inputAct" name="codigo_postal" type="text" value="<?php echo $fila['codigo_postal']; ?>"> 
        <br>
        <p class="etiquetas">Subcomite:</p><input class="inputAct" name="fk_id_subcomision" type="text" value="<?php echo $fila['fk_id_subcomision']; ?>">
        <p class="etiquetas">Partido</p><input class="inputAct" name="fk_id_partido" type="text" value="<?php echo $fila['fk_id_partido']; ?>"> 

        <a href="#" id="actualizar" name="actualizar" class="btnEnviar" onclick="actualizar()">Actualizar</a>

		</form>
	</div>

       <div id="yay" style="display:none">
            Woow, haz logrado actualizar al contacto :D
        </div>
        <div id="fail" style="display:none">
            Santo cielo, no pierdas la calma, todo estara bien
       </div>  
<?php 
}
mysqli_free_result($result);
mysqli_close($con);
?>