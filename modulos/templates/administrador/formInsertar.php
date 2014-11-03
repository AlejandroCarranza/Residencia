<?php
include_once 'register.con.php';
include_once '../../includes/db_connect.php';
include_once '../../includes/psl-config.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Insertar</title>
<script type="text/javascript">
function validateForm() {
    var nombre = document.forms["formContacto"]["nombre"].value;
    var apellidoP = document.forms["formContacto"]["apellidoP"].value;
    var numInt = document.forms["formContacto"]["numInt"].value;


    if (nombre == null || nombre == "" ||
    	apellidoP == null || apellidoP == ""
    	) {
        alert("Datos de nombre incompletos");
        return false;
    }
    else if( isNaN(numInt) ) {
    	alert('"Número interior" debe ser un número');
    	return false;
    }
    else return true;


}
</script>
<script type="text/javascript">
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $('#boton1').click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validateForm()){                               // Primero validará el formulario.
            $.post("register.con.php",$('#formContacto').serialize(),function(res){
                if(res == "1"){
                	alert("Contacto Guardado");
                	document.formContacto.reset();
                } else {
                	alert("Error. Contacto no guardado");
                	document.formContacto.reset();
                }
            });
        }
    });    
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#sub").change(function(){
            $( "select option:selected").each(function(){
                if($(this).attr("value")=="1"){
                	$("div.tipo").hide();
                    $("#TipoEducacion").show();
                }
                if($(this).attr("value")=="2"){
                	$("div.tipo").hide();
                    $("#exito1").show();
                }
                if($(this).attr("value")=="3"){
                	$("div.tipo").hide();
                    $("#exito2").show();
                }
                if($(this).attr("value")=="4"){
                	$("div.tipo").hide();
                    $("#exito3").show();
                }
            });
        }).change();
    });
</script>
</head>
<body>
	<div id="formInsert">
		<form 
			method="post"
			name="formContacto"
			id="formContacto"
			accept-charset="utf-8"
			enctype="multipart/form-data">
			<span class="categorias">Nombre</span>
			<input type="text" class="input" id="nombre" name="nombre" placeholder="Nombre(s)">
			<input type="text" class="input" id="apellidoP" name="apellidoP" placeholder="Apellido Paterno">
			<input type="text" class="input" name="apellidoM" placeholder="Apellido Materno">
			<!--<input type="text" class="input" name="titulo" placeholder="Título">-->
			<select name="titulo">
				<option value="C">C.</option>
				<option value="Ing">Ing.</option>
				<option value="Lic">Lic.</option>
				<option value="Dr">Dr.</option>
				<option value="Prfr">Prfr.</option>
			</select>
			<br>
			<?php
			$consultaSub = $mysqli->prepare("SELECT id_subcomision, nombre_subcomision FROM subcomisiones");
			$consultaSub->execute();
			$consultaSub->bind_result($id_subcomision,$nombre_subcomision);
			$consultaSub->store_result();
			echo "<select name='sub' id='sub'>";
			echo "<option value='' disabled selected>Tipo de usuario</option>";
			while($consultaSub->fetch()){?>
			<p><?php echo '<option value="'.$id_subcomision.'">'.$nombre_subcomision.'</option>'; ?></p>
			<?php }
			echo "</select>";
			?>
			<br>
			<div id="TipoEducacion" style="display:none" class="tipo">
			<?php
			$consulta = $mysqli->prepare("SELECT nombre_dependencia FROM dependecias where tipo_dependencia=1");
			$consulta->execute();
			$consulta->bind_result($nombre_dependencia);
			$consulta->store_result();
			echo "<select name='dep1' id='dep1'>";
			echo "<option value='' disabled selected>Dependencia</option>";
			while($consulta->fetch()){?>
			<p><?php echo '<option value="'.$nombre_dependencia.'">'.$nombre_dependencia.'</option>'; ?></p>
			<?php }
			echo "</select>";
			?>
			<input type="text" class="input" id="Cargo" name="Cargo" placeholder="Cargo">

        	</div>
			<div id="exito1" style="display:none" class="tipo">
            <input type="text" class="input" id="cel" name="cel" placeholder="Teléfono Celular">
        	</div>
			<div id="exito2" style="display:none" class="tipo">
            Adios
        	</div>
			<div id="exito3" style="display:none" class="tipo">
            No
        	</div>
        	<br>
        	<span class="categorias">Contacto</span>
			<input type="text" class="input" id="TelOfc" name="TelOfc" placeholder="Teléfono Oficina">
			<input type="text" class="input" id="TelCel" name="TelCel" placeholder="Teléfono Celular">
			<input type="text" class="input" id="Email" name="Email" placeholder="Email">
			<br>
			<span class="categorias">Dirección</span>
			<input type="text" class="input" id ="calle" name="calle" placeholder="Calle">
			<input type="text" class="input" id="numExt" name="numExt" placeholder="Número ext">
			<input type="text" class="input" id="numInt" name="numInt" placeholder="Número int">
			<input type="text" class="input" id="colonia"  name="colonia" placeholder="Colonia">
			<input type="text" class="input" id="codigo_postal"  name="codigo_postal" placeholder="Código postal">
			<!--<input type="text" class="input" name="municipio" placeholder="Municipio">-->
			<select name="municipio" id="municipio" >
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
			<input type="text" class="input" id="localidad" name="localidad" placeholder="Localidad">

			
			<input id="boton1" name="boton1" type="button"
			value="Registrar"/> 
		</form>
	</div>
	<script src="../../statics/js/jquery-2.1.0.min.js"></script>
   	<script src="../../statics/js/AJAX.js"></script>
</body>
</html>