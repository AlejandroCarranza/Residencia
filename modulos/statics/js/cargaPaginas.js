function inicio(){
    $(document).ready(function (){

    $.post("inicio.php","param1=x&param2=y&param3=z", function(inicio){
        $("#contenido").html(inicio);
    });

    $("#btnInicio").click(function (){
        $.post("inicio.php","", function(home){
            $("#contenido").html(home);
            });
        });
    $("#btnInsertar").click(function (){
        $.post("formInsertar.php","", function(home){
            $("#contenido").html(home);
            });
        });

    //Botones para el menu de Consultar
    $("#btnConsulta1").click(function (){
        $.post("consultar/consulta1.php","", function(home){
            $("#contenido").html(home);
            });
        });
    $("#btnConsulta2").click(function (){
        $.post("consultar/consulta2.php","", function(home){
            $("#contenido").html(home);
            });
        });
    $("#btnConsulta3").click(function (){
        $.post("consultar/consulta3.php","", function(home){
            $("#contenido").html(home);
            });
        });

    //Botones para el menu de reportes
    $("#btnReporte1").click(function (){
        $.post("reportes/reporte1.php","", function(home){
            $("#contenido").html(home);
            });
        });

     //Botones para el menu de Administrar
    $("#btnCrearUsuario").click(function (){
        $.post("administrar/crearUsuario.php","", function(home){
            $("#contenido").html(home);
            });
        });
    $("#btnCrearTipos").click(function (){
        $.post("administrar/crearTipos.php","", function(home){
            $("#contenido").html(home);
            });
        });
    $("#btnActualizarCat").click(function (){
        $.post("administrar/actualizarCat.php","", function(home){
            $("#contenido").html(home);
            });
        });
    $("#btnArchivos").click(function (){
        $.post("administrar/repositorio.php","", function(home){
            $("#contenido").html(home);
            });
        });
    });
}




//Boton Leer mas en consultar
function verMas(id){
if (document.getElementById){ //se obtiene el id
    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
    el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
}
}
window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
    verMas('mostrarContrato');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
}