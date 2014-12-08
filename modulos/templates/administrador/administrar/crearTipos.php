<?php
include_once 'register.user.php';
include_once '../../../includes/db_connect.php';
include_once '../../../includes/psl-config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Configuración de opciones</title>
    <script type="text/JavaScript" src="../../statics/js/sha512.js"></script>
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tipo").change(function(){
            $( "select option:selected").each(function(){
                if($(this).attr("value")=="1"){
                    $("div.tipo").hide();
                    $("#TipoDependencia").show();
                }
                if($(this).attr("value")=="2"){
                    $("div.tipo").hide();
                    $("#TipoSubcomision").show();
                }
                if($(this).attr("value")=="3"){
                    $("div.tipo").hide();
                    $("#TipoPartido").show();
                }
            });
        }).change();
    });
</script>
<script type="text/javascript">
function validateFormTipos() {

    var tipo = document.forms["formTipos"]["tipo"].value;
    var nombreDependencia = document.forms["formTipos"]["tiposDependenciaNombre"].value;
    var subDependencia = document.forms["formTipos"]["subDependencia"].value;
    var nombreSubcomision = document.forms["formTipos"]["tiposSubcomisionNombre"].value;
    var nombrePartido = document.forms["formTipos"]["tiposPartidoNombre"].value;
    var siglas = document.forms["formTipos"]["tiposPartidoSiglas"].value;

if(tipo=="1")
{
    if (nombreDependencia == null || nombreDependencia == "" ||
    subDependencia == null || subDependencia == ""
    ) {
    alert("Datos incompletos");
    return false;
    }
}
if(tipo=="2")
{
    if (nombreSubcomision == null || nombreSubcomision == ""
    ) {
    alert("Datos incompletos");
    return false;
    }
}
if(tipo=="3")
{
    if (nombrePartido == null || nombrePartido == "" ||
    siglas == null || siglas == ""
    ) {
    alert("Datos incompletos");
    return false;
    }
}
if(tipo=="4")
{
    return false;
}
else {
    return true;
    }
    
}
</script>
<script type="text/javascript">
$(document).ready( function() {   // Esta parte del código se ejecutará automáticamente cuando la página esté lista.
    $('#boton3').click( function() {     // Con esto establecemos la acción por defecto de nuestro botón de enviar.
        if(validateFormTipos()){                               // Primero validará el formulario.
            $.post("administrar/register.options.php",$('#formTipos').serialize(),function(res){
                if(res == "1"){
                    alert("Datos Guardados");
                    document.formTipos.reset();
                    $("div.tipo").hide();
                } else {
                    alert("Error. Datos no guardados.");
                }
            });
        }
    });    
});
</script>
</head>
<body>
    <h1>Registro de opciones</h1>
    <div id="formInsertTipos">
        <form  method="post" name="formTipos" id="formTipos" accept-charset="utf-8" enctype="multipart/form-data">
        <span class="categorias">Nuevo</span>
        <select name="tipo" id="tipo">
            <option value="" disabled selected>Tipo de opción</option>
            <option value="1">Dependencia</option>
            <option value="2">Subcomision</option>
            <option value="3">Partido</option>
        </select>
        <br>
        <div id="TipoDependencia" style="display:none" class="tipo">
            <br>
            <span class="categorias">Nueva Dependecia</span>
            <input type="text" class="input" id="tiposDependenciaNombre" name="tiposDependenciaNombre" placeholder="Nombre de dependencia" />
            <?php
            $consultaSub = $mysqli->prepare("SELECT id_subcomision, nombre_subcomision FROM subcomisiones");
            $consultaSub->execute();
            $consultaSub->bind_result($id_subcomision,$nombre_subcomision);
            $consultaSub->store_result();
            echo "<select name='subDependencia' id='subDependencia'>";
            echo "<option value='' disabled selected>Tipo de dependencia</option>";
            while($consultaSub->fetch()){?>
            <p><?php echo '<option value="'.$id_subcomision.'">'.$nombre_subcomision.'</option>'; ?></p>
            <?php }
            echo "</select>";
            ?>
        </div>
        <div id="TipoSubcomision" style="display:none" class="tipo">
            <br>
            <span class="categorias">Nueva Subcomision</span>
            <input type="text" class="input" id="tiposSubcomisionNombre" name="tiposSubcomisionNombre" placeholder="Nombre de la subcomision" />
        </div>
        <div id="TipoPartido" style="display:none" class="tipo">
            <br>
            <span class="categorias">Nuevo Partido</span>
            <input type="text" class="input" id="tiposPartidoNombre" name="tiposPartidoNombre" placeholder="Nombre del partido" />
            <input type="text" class="input" id="tiposPartidoSiglas" name="tiposPartidoSiglas" placeholder="Siglas del partido" />
        </div>

        <br>
            <input class="btnEnviar" id="boton3" name="boton3" type="button" value="Registrar"/>
            <br>             
        </form>
    </div>
    <script src="../../statics/js/jquery-2.1.0.min.js"></script>
    <script src="../../statics/js/AJAX.js"></script>
</body>

</html>