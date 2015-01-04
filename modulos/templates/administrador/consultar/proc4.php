<meta http-equiv="content-type" content="text/html; UTF-8" />

<?php
include_once '../../../../includes/psl-config.php';
include_once '../../../../includes/db_connect.php';
include_once '../../../../includes/functions.php'; 
//Inicia la función 
sec_session_start();
// Comprueba que la sesión activa corresponda al módulo
if ((login_check($mysqli) == true) && ($_SESSION['type'] == '2')){

//Conexión a la base de datos

$con=mysqli_connect(HOST, USER, PASSWORD, DATABASE);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Campos para lograr que utf-8 funcione perfectamente
$acentos = $con->query("SET NAMES 'utf8'");
mysqli_set_charset($con,"utf8");

$codigo=$_POST['idCon']; // Recepción del id del contacto a editar


// Consulta para obtener los datos del contacto
$result=mysqli_query($con,"SELECT * FROM contactos 
    join partidos on contactos.fk_id_partido = partidos.id_partido
    where id_contacto='".$codigo."' ");
if($result === FALSE) {
    die(mysqli_error());
}


while($fila = mysqli_fetch_array($result))
{
	?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Actualizar</title>
<script type="text/javascript">
// Lo siguiente es para cambiar los campos automáticamente cuando se elige la subcomisión del contacto
    $(document).ready(function(){
        $("#opcionSubcomision").change(function(){ // Al cambiar el select con id "opcionSubcomision"...
                var select = $("#opcionSubcomision option:selected").val(); // ... se obtiene el valor seleccionado
                if(select=="1"){ // Si el valor es 1...
                    $("div.tipo").hide(); //... oculta los div de la clase "tipo"
                    $("#TipoEducacion").show(); // muestra el div de id "TipoEducación"
                }
                if(select=="2"){
                    $("div.tipo").hide();
                    $("#TipoSalud").show();
                }
                if(select=="3"){
                    $("div.tipo").hide();
                    $("#TipoGEMS").show();
                }
                if(select=="4"){
                    $("div.tipo").hide();
                    $("#TipoEMS").show();
                }
                if(select=="5"){
                    $("div.tipo").hide();
                    $("#TipoEM").show();
                }
                if(select=="6"){
                    $("div.tipo").hide();
                    $("#TipoDF").show();
                }
                if(select=="7"){
                    $("div.tipo").hide();
                    $("#TipoPM").show();
                }
                if(select=="8"){
                    $("div.tipo").hide();
                    $("#TipoGE").show();
                }
                if(select=="9"){
                    $("div.tipo").hide();
                    $("#TipoRegidores").show();
                }
                if(select=="10"){
                    $("div.tipo").hide();
                    $("#TipoDiputados").show();
                }
                if(select=="11"){
                    $("div.tipo").hide();
                    $("#TipoGeneral").show();
                }
        });
    });
</script>
</head>
<body>
    <div id="formCon">
      <form method="POST" id="formUpdate" accept-charset="utf-8" enctype="multipart/form-data">
        <?php
        $foto = $fila['foto']; // Se revisa si el contacto tiene foto. "1" significa que sí.

        if ($foto > 0 ) { // Si tiene foto hace la ruta de ésta tomando el id del contacto
        $rutaFoto='../../statics/images/contactos/'.$fila['id_contacto'].'.jpg';
        }
        else{ // Si no tiene muestra una imagen por defecto
        $rutaFoto='../../statics/images/contactos/user.png';
        }
        $pc=$fila['pc']; // Revisa si el contacto tiene puesto o cargo. "0" significa puesto y "1" es cargo


        echo '<img class="tarjetaFoto" src="'.$rutaFoto.'">'; // Muestra la foto
        echo '<input type="button" class="btnEnviar" value="Subir foto" onclick="myFunction5('.$fila['id_contacto'].')"></input>'; // Prepara la función para subir foto
        echo '<p class="tarjetaNom">'.$fila['titulo']. " ".$fila['nombre']. " ".$fila['apellido_paterno']. " ".$fila['apellido_materno']. '</p>';
        if($pc==1){ // Si tiene cargo hace la consulta a la tabla de cargos
            $consulta = $mysqli->prepare("SELECT cargos.id_dependencia, cargos.cargo, nombre_dependencia FROM cargos
                join dependencias on cargos.id_dependencia = dependencias.id_dependencia
                where id_contacto='".$codigo."' and valido='1'");
            $consulta->execute();
            $consulta->bind_result($id_dependencia, $cargo, $nombre_dependencia);
            $consulta->store_result();
            while($consulta->fetch()){
                echo $cargo." en ".$nombre_dependencia;
            }
        }
        if($pc==0){ // Si tiene puesto hace la consulta a la tabla de puestos
            $consulta = $mysqli->prepare("SELECT puestos.puesto, puestos.extra FROM puestos
                where id_contacto='".$codigo."' and valido='1'");
            $consulta->execute();
            $consulta->bind_result($puesto, $extra);
            $consulta->store_result();
            while($consulta->fetch()){
                echo $puesto." ".$extra;
            }
        }
        ?>
        <br>
        <input name="id_contacto" type="hidden" value="<?php echo $fila['id_contacto']; ?>">
        <p class="etiquetaTit">Nombre</p>
        <p class="etiquetas">Nombre:</p><input class="inputAct" name="nombre" type="text" value="<?php echo $fila['nombre'];?>">
        <p class="etiquetas">Apellido Paterno:</p><input class="inputAct" name="apellido_paterno" type="text" value="<?php echo $fila['apellido_paterno']; ?>">
        <p class="etiquetas">Apellido Materno:</p><input class="inputAct" name="apellido_materno" type="text" value="<?php echo $fila['apellido_materno']; ?>">
        <p class="etiquetas">Título:</p>
            <select name="titulo" >
                <option value="<?php echo $fila['titulo']; ?>"><?php echo $fila['titulo']; ?></option>
                <option value="C.">C.</option>
                <option value="Ing.">Ing.</option>
                <option value="Lic.">Lic.</option>
                <option value="Dr.">Dr.</option>
                <option value="Prfr.">Prfr.</option>
            </select>
        <p class="etiquetaTit">Contactos</p>
        <p class="etiquetas">Tel. Oficina:</p><input class="inputAct" name="tel_oficina" type="text" value="<?php echo $fila['tel_oficina'];?>">
        <p class="etiquetas">Celular:</p><input class="inputAct" name="celular" type="text" value="<?php echo $fila['celular']; ?>">
        <p class="etiquetas">Email:</p><input class="inputAct" name="email" type="text" value="<?php echo $fila['email']; ?>"> 

        <p class="etiquetaTit">Dirección</p>
        <p class="etiquetas">Calle:</p><input class="inputAct" name="calle" type="text" value="<?php echo $fila['calle']; ?>">
        <p class="etiquetas">No Int:</p><input class="inputAct" name="numero_int" type="text" value="<?php echo $fila['numero_int']; ?>">
        <p class="etiquetas">No Ext:</p><input class="inputAct" name="numero_ext" type="text" value="<?php echo $fila['numero_ext']; ?>"> 
        <br>
        <p class="etiquetas">Colonia:</p><input class="inputAct" name="colonia" type="text" value="<?php echo $fila['colonia']; ?>"> 
        <p class="etiquetas">Municipio:</p><select class="inputAct" name="municipio" id="municipio" >
                <option value="<?php echo $fila['municipio']; ?>"><?php echo $fila['municipio']; ?></option>
                <option value="Canatlán">Canatlán</option>
                <option value="Canelas">Canelas</option>
                <option value="Coneto de Comonfort">Cuencamé</option>
                <option value="Durango">Durango</option>
                <option value="El Oro">El Oro</option>
                <option value="Gómez Palacio">Gómez Palacio</option>
                <option value="General Simón Boívar">Gral. Simón Boívar</option>
                <option value="Guadalupe Victoria">Guadalupe Victoria</option>
                <option value="Guanaceví">Guanaceví</option>
                <option value="Hidalgo">Hidalgo</option>
                <option value="Indé">Indé</option>
                <option value="Lerdo">Lerdo</option>
                <option value="Mapimí">Mapimí</option>
                <option value="Mezquital">Mezquital</option>
                <option value="Nazas">Nazas</option>
                <option value="Nombre de Dios">Nombre de Dios</option>
                <option value="Nuevo Ideal">Nuevo Ideal</option>
                <option value="Ocampo">Ocampo</option>
                <option value="Otáez">Otáez</option>
                <option value="Pánuco de Coronado">Pánuco de Coronado</option>
                <option value="Peñón Blanco">Peñón Blanco</option>
                <option value="Poanas">Poanas</option>
                <option value="Pueblo Nuevo">Pueblo Nuevo</option>
                <option value="Rodeo">Rodeo</option>
                <option value="San Bernardo">San Bernardo</option>
                <option value="San Dimas">San Dimas</option>
                <option value="San Juan de Guadalupe">San Juan de Guadalupe</option>
                <option value="San Juan del Río">San Juan del Río</option>
                <option value="San Luis del Cordero">San Luis del Cordero</option>
                <option value="San Pedro del Gallo">San Pedro del Gallo</option>
                <option value="Santa Clara">Santa Clara</option>
                <option value="Santiago Papasquiaro">Santiago Papasquiaro</option>
                <option value="Súchil">Súchil</option>
                <option value="Tamazula">Tamazula</option>
                <option value="Tepehuanes">Tepehuanes</option>
                <option value="Tlahualilo">Tlahualilo</option>
                <option value="Topia">Topia</option>
                <option value="Vicente Guerrero">Vicente Guerrero</option>
            </select>  
        <p class="etiquetas">Localidad:</p><input class="inputAct" name="localidad" type="text" value="<?php echo $fila['localidad']; ?>"> 
        <br>
        <p class="etiquetas">Código Postal:</p><input class="inputAct" name="codigo_postal" type="text" value="<?php echo $fila['codigo_postal']; ?>">
        <br>
        <p class="etiquetaTit">Puesto</p>
        <input type="button" id="btnNuevoPuesto" name="btnNuevoPuesto" class="btnEnviar"  onclick="actualizarPuesto(); nuevoPuesto()" value="Nuevo Puesto"/>
        <div id="NuevoPuesto" name="NuevoPuesto" style="display:none">

            <?php
            // Consulta a la base de datos para ver las subcomisiones
            $consultaSub = $mysqli->prepare("SELECT id_subcomision, nombre_subcomision FROM subcomisiones"); // Preparación de la consulta
            $consultaSub->execute(); // Ejecución de la consulta
            $consultaSub->bind_result($id_subcomision,$nombre_subcomision); // Asignación de resultados a variables
            $consultaSub->store_result(); // Guarda resultados
            echo "<select name='opcionSubcomision' id='opcionSubcomision'>";
            echo "<option value='' disabled selected>Tipo de usuario</option>";
            while($consultaSub->fetch()){?> <!-- Muestra el resultado de la consulta -->
            <p><?php echo '<option value="'.$id_subcomision.'">'.$nombre_subcomision.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
            <br>
            <br>
            <div id="TipoEducacion" style="display:none" class="tipo">
            <?php
            $consulta = $mysqli->prepare("SELECT id_dependencia, nombre_dependencia FROM dependencias where tipo_dependencia=1");
            $consulta->execute();
            $consulta->bind_result($id_dependencia,$nombre_dependencia);
            $consulta->store_result();
            echo "<select name='dep1' id='dep1'>";
            echo "<option value='' disabled selected>Dependencia</option>";
            while($consulta->fetch()){?>
            <p><?php echo '<option value="'.$id_dependencia.'">'.$nombre_dependencia.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
            <input type="text" class="input" id="Cargo1" name="Cargo1" placeholder="Cargo">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI1" name="fechaI1">
            Fecha de Término<input type="date" class="input" id="fechaT1" name="fechaT1">
            </div>
            <div id="TipoSalud" style="display:none" class="tipo">
            <?php
            $consulta = $mysqli->prepare("SELECT id_dependencia, nombre_dependencia FROM dependencias where tipo_dependencia=2");
            $consulta->execute();
            $consulta->bind_result($id_dependencia,$nombre_dependencia);
            $consulta->store_result();
            echo "<select name='dep2' id='dep2'>";
            echo "<option value='' disabled selected>Dependencia</option>";
            while($consulta->fetch()){?>
            <p><?php echo '<option value="'.$id_dependencia.'">'.$nombre_dependencia.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
            <input type="text" class="input" id="Cargo2" name="Cargo2" placeholder="Cargo">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI2" name="fechaI2">
            Fecha de Término<input type="date" class="input" id="fechaT2" name="fechaT2">
            </div>
            <div id="TipoGEMS" style="display:none" class="tipo">
            <?php
            $consulta = $mysqli->prepare("SELECT id_dependencia, nombre_dependencia FROM dependencias where tipo_dependencia=3");
            $consulta->execute();
            $consulta->bind_result($id_dependencia,$nombre_dependencia);
            $consulta->store_result();
            echo "<select name='dep3' id='dep3'>";
            echo "<option value='' disabled selected>Dependencia</option>";
            while($consulta->fetch()){?>
            <p><?php echo '<option value="'.$id_dependencia.'">'.$nombre_dependencia.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
            <input type="text" class="input" id="Cargo3" name="Cargo3" placeholder="Cargo">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI3" name="fechaI3">
            Fecha de Término<input type="date" class="input" id="fechaT3" name="fechaT3">
            </div>
            <div id="TipoEMS" style="display:none" class="tipo">
            <?php
            $consulta = $mysqli->prepare("SELECT id_dependencia, nombre_dependencia FROM dependencias where tipo_dependencia=3");
            $consulta->execute();
            $consulta->bind_result($id_dependencia,$nombre_dependencia);
            $consulta->store_result();
            echo "<select name='dep4' id='dep4'>";
            echo "<option value='' disabled selected>Dependencia</option>";
            while($consulta->fetch()){?>
            <p><?php echo '<option value="'.$id_dependencia.'">'.$nombre_dependencia.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
            <input type="text" class="input" id="Cargo4" name="Cargo4" placeholder="Cargo">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI4" name="fechaI4">
            Fecha de Término<input type="date" class="input" id="fechaT4" name="fechaT4">
            </div>
            <div id="TipoEM" style="display:none" class="tipo">
            <select name="municipioEM" id="municipioEM" >
                <option value="" disabled selected>Municipio</option>
                <option value="Canatlán">Canatlán</option>
                <option value="Canelas">Canelas</option>
                <option value="Coneto de Comonfort">Cuencamé</option>
                <option value="Durango">Durango</option>
                <option value="El Oro">El Oro</option>
                <option value="Gómez Palacio">Gómez Palacio</option>
                <option value="General Simón Boívar">Gral. Simón Boívar</option>
                <option value="Guadalupe Victoria">Guadalupe Victoria</option>
                <option value="Guanaceví">Guanaceví</option>
                <option value="Hidalgo">Hidalgo</option>
                <option value="Indé">Indé</option>
                <option value="Lerdo">Lerdo</option>
                <option value="Mapimí">Mapimí</option>
                <option value="Mezquital">Mezquital</option>
                <option value="Nazas">Nazas</option>
                <option value="Nombre de Dios">Nombre de Dios</option>
                <option value="Nuevo Ideal">Nuevo Ideal</option>
                <option value="Ocampo">Ocampo</option>
                <option value="Otáez">Otáez</option>
                <option value="Pánuco de Coronado">Pánuco de Coronado</option>
                <option value="Peñón Blanco">Peñón Blanco</option>
                <option value="Poanas">Poanas</option>
                <option value="Pueblo Nuevo">Pueblo Nuevo</option>
                <option value="Rodeo">Rodeo</option>
                <option value="San Bernardo">San Bernardo</option>
                <option value="San Dimas">San Dimas</option>
                <option value="San Juan de Guadalupe">San Juan de Guadalupe</option>
                <option value="San Juan del Río">San Juan del Río</option>
                <option value="San Luis del Cordero">San Luis del Cordero</option>
                <option value="San Pedro del Gallo">San Pedro del Gallo</option>
                <option value="Santa Clara">Santa Clara</option>
                <option value="Santiago Papasquiaro">Santiago Papasquiaro</option>
                <option value="Súchil">Súchil</option>
                <option value="Tamazula">Tamazula</option>
                <option value="Tepehuanes">Tepehuanes</option>
                <option value="Tlahualilo">Tlahualilo</option>
                <option value="Topia">Topia</option>
                <option value="Vicente Guerrero">Vicente Guerrero</option>
            </select>
            <br>
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI5" name="fechaI5">
            Fecha de Término<input type="date" class="input" id="fechaT5" name="fechaT5">
            <select name="UAR">
                <option value="" disabled selected>UAR</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            </div>
            <div id="TipoDF" style="display:none" class="tipo">
            <?php
            $consulta = $mysqli->prepare("SELECT id_dependencia, nombre_dependencia FROM dependencias where tipo_dependencia=6");
            $consulta->execute();
            $consulta->bind_result($id_dependencia,$nombre_dependencia);
            $consulta->store_result();
            echo "<select name='dep6' id='dep6'>";
            echo "<option value='' disabled selected>Dependencia</option>";
            while($consulta->fetch()){?>
            <p><?php echo '<option value="'.$id_dependencia.'">'.$nombre_dependencia.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
            <input type="text" class="input" id="Cargo6" name="Cargo6" placeholder="Cargo">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI6" name="fechaI6">
            Fecha de Término<input type="date" class="input" id="fechaT6" name="fechaT6">
            <input type="text" class="input" id="Secretaria" name="Secretaria" placeholder="Secretaria">
            </div>

            <div id="TipoPM" style="display:none" class="tipo">
            <select name="municipioPM" id="municipioPM" >
                <option value="" disabled selected>Municipio</option>
                <option value="Canatlán">Canatlán</option>
                <option value="Canelas">Canelas</option>
                <option value="Coneto de Comonfort">Cuencamé</option>
                <option value="Durango">Durango</option>
                <option value="El Oro">El Oro</option>
                <option value="Gómez Palacio">Gómez Palacio</option>
                <option value="General Simón Boívar">Gral. Simón Boívar</option>
                <option value="Guadalupe Victoria">Guadalupe Victoria</option>
                <option value="Guanaceví">Guanaceví</option>
                <option value="Hidalgo">Hidalgo</option>
                <option value="Indé">Indé</option>
                <option value="Lerdo">Lerdo</option>
                <option value="Mapimí">Mapimí</option>
                <option value="Mezquital">Mezquital</option>
                <option value="Nazas">Nazas</option>
                <option value="Nombre de Dios">Nombre de Dios</option>
                <option value="Nuevo Ideal">Nuevo Ideal</option>
                <option value="Ocampo">Ocampo</option>
                <option value="Otáez">Otáez</option>
                <option value="Pánuco de Coronado">Pánuco de Coronado</option>
                <option value="Peñón Blanco">Peñón Blanco</option>
                <option value="Poanas">Poanas</option>
                <option value="Pueblo Nuevo">Pueblo Nuevo</option>
                <option value="Rodeo">Rodeo</option>
                <option value="San Bernardo">San Bernardo</option>
                <option value="San Dimas">San Dimas</option>
                <option value="San Juan de Guadalupe">San Juan de Guadalupe</option>
                <option value="San Juan del Río">San Juan del Río</option>
                <option value="San Luis del Cordero">San Luis del Cordero</option>
                <option value="San Pedro del Gallo">San Pedro del Gallo</option>
                <option value="Santa Clara">Santa Clara</option>
                <option value="Santiago Papasquiaro">Santiago Papasquiaro</option>
                <option value="Súchil">Súchil</option>
                <option value="Tamazula">Tamazula</option>
                <option value="Tepehuanes">Tepehuanes</option>
                <option value="Tlahualilo">Tlahualilo</option>
                <option value="Topia">Topia</option>
                <option value="Vicente Guerrero">Vicente Guerrero</option>
            </select>
            <br>
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI7" name="fechaI7">
            Fecha de Término<input type="date" class="input" id="fechaT7" name="fechaT7">
            </div>

            <div id="TipoGE" style="display:none" class="tipo">
            <?php
            $consulta = $mysqli->prepare("SELECT id_dependencia, nombre_dependencia FROM dependencias where tipo_dependencia=8");
            $consulta->execute();
            $consulta->bind_result($id_dependencia,$nombre_dependencia);
            $consulta->store_result();
            echo "<select name='dep8' id='dep8'>";
            echo "<option value='' disabled selected>Dependencia</option>";
            while($consulta->fetch()){?>
            <p><?php echo '<option value="'.$id_dependencia.'">'.$nombre_dependencia.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
            <input type="text" class="input" id="Cargo8" name="Cargo8" placeholder="Cargo">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI8" name="fechaI8">
            Fecha de Término<input type="date" class="input" id="fechaT8" name="fechaT8">
            </div>

            <div id="TipoRegidores" style="display:none" class="tipo">
            <input type="text" class="input" id="Cargo9" name="Cargo9" placeholder="Puesto">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI9" name="fechaI9">
            Fecha de Término<input type="date" class="input" id="fechaT9" name="fechaT9">
            </div>

            <div id="TipoDiputados" style="display:none" class="tipo">
            <input type="text" class="input" id="Cargo10" name="Cargo10" placeholder="Distrito">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI10" name="fechaI10">
            Fecha de Término<input type="date" class="input" id="fechaT10" name="fechaT10">
            </div>

            <div id="TipoGeneral" style="display:none" class="tipo">
            <?php
            $consulta = $mysqli->prepare("SELECT id_dependencia, nombre_dependencia FROM dependencias where tipo_dependencia=11");
            $consulta->execute();
            $consulta->bind_result($id_dependencia,$nombre_dependencia);
            $consulta->store_result();
            echo "<select name='dep11' id='dep11'>";
            echo "<option value='' disabled selected>Dependencia</option>";
            while($consulta->fetch()){?>
            <p><?php echo '<option value="'.$id_dependencia.'">'.$nombre_dependencia.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
            <input type="text" class="input" id="Cargo11" name="Cargo11" placeholder="Cargo">
            <br>
            Fecha de Inicio<input type="date" class="input" id="fechaI11" name="fechaI11">
            Fecha de Término<input type="date" class="input" id="fechaT11" name="fechaT11">
            </div>
        </div>
        <p class="etiquetaTit">Otros</p>
        <p class="etiquetas">Partido:</p><select class="inputAct" name="fk_id_partido" >
            <?php
            $consultaSub = $mysqli->prepare("SELECT id_partido, siglas FROM partidos");
            $consultaSub->execute();
            $consultaSub->bind_result($id_partido,$siglas);
            $consultaSub->store_result();
            while($consultaSub->fetch()){
                if ($fila['fk_id_partido'] == $id_partido) {
                    echo '<option selected value="'.$id_partido.'">'.$siglas.'</option>';
                }
                else{
                    echo '<option value="'.$id_partido.'">'.$siglas.'</option>';
                }
            
            }
            ?>
        </select>
        <p class="etiquetas">Fecha de nacimiento</p><input class="inputAct" name="fecha_nacimiento" type="date" value="<?php echo $fila['fecha_nacimiento']; ?>"> 
       
        
        <input type="button" id="btnActualizar" name="btnActualizar" class="btnEnviar"  onclick="actualizar()" value="Actualizar"/> 

		</form>
	</div>
    <input type="hidden" value="" id="idFoto" name="idFoto" >
</body>
</html>
<?php 
}
mysqli_free_result($result);
mysqli_close($con);

}
// Si no se aprueba la sesión muestra el mensaje
else{ ?>
    <p>
        <span class="error">No estás autorizado para ver esta página.</span>
    </p>
<?php
}
?>