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

     //Botones para el menu de Administrar
    $("#btnCrearUsuario").click(function (){
        $.post("administrar/crearUsuario.php","", function(home){
            $("#contenido").html(home);
            });
        });

    });
}
