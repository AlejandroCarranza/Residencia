<?php
include_once 'register.con.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Insertar</title>
<script type="text/javascript">
function validateForm() {
    var nombre = document.forms["formContacto"]["nombre"].value;
    var apellidoP = document.forms["formContacto"]["apellidoP"].value;
    var apellidoM = document.forms["formContacto"]["apellidoM"].value;

    if (nombre == null || nombre == "" ||
    	apellidoP == null || apellidoP == ""||
    	apellidoM == null || apellidoM == "" 
    	) {
        alert("Datos de nombre incompletos");
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
                	alert("Contacto Guardado"+res);
                	document.formContacto.reset();
                } else {
                	alert("Error. Contacto no guardado"+res);
                	document.formContacto.reset();
                }
            });
        }
    });    
});
</script>
</head>
<body>
	<div id="formInsert">
		<form 
			method="post"
			name='formContacto'
			id='formContacto'
			<span class="categorias">Nombre</span>
			<input type="text" class="input" id="nombre" name="nombre" placeholder="Nombre(s)">
			<input type="text" class="input" id="apellidoP" name="apellidoP" placeholder="Apellido Paterno">
			<input type="text" class="input" name="apellidoM" placeholder="Apellido Materno">
			<!--<input type="text" class="input" name="titulo" placeholder="Título">-->
			<select name="titulo">
				<option value="C">C.</option>
				<option value="Ing">Ing.</option>
				<option value="Lic">Lic.</option>
			</select>
			<span class="categorias">Dirección</span>
			<input type="text" class="input" name="calle" placeholder="Calle">
			<input type="text" class="input" name="numInt" placeholder="Numero int">
			<input type="text" class="input" name="numExt" placeholder="Numero ext">
			<input type="text" class="input" name="colonia" placeholder="Colonia">
			<!--<input type="text" class="input" name="municipio" placeholder="Municipio">-->
			<select name="municipio">
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
			<input type="text" class="input" name="localidad" placeholder="Localidad">
			<br>
			<input id="boton1" name="boton1" type="button"
			value="Registrar"/> 
		</form>
	</div>
</body>
</html>