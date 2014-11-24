function myFunction(){
var n=document.getElementById('bus').value;

if(n==''){

 document.getElementById("lista").innerHTML="";
 document.getElementById("lista").style.border="0px";

 document.getElementById("pers").innerHTML="";

 return;
}

loadDoc("q="+n,"consultar/proc.php",function(){

  if (xmlhttp.readyState==4 && xmlhttp.status==200){

    document.getElementById("lista").innerHTML=xmlhttp.responseText;
    document.getElementById("lista").style.border="1px solid #A5ACB2";

    }
    else { 
    }

  });
}


function myFunction2(cod){

document.getElementById("lista").innerHTML="";
document.getElementById("lista").style.border="0px";

loadDoc("vcod="+cod,"consultar/proc2.php",function(){

  if (xmlhttp.readyState==4 && xmlhttp.status==200){

    document.getElementById("pers").innerHTML=xmlhttp.responseText;
      mostrarCon();
    }
    else{ 
    }

  });
}

function educacion(){
  $('#valor1').val("1");
  $('#valor2').val("cargos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}

function salud(){
  $('#valor1').val("2");
  $('#valor2').val("cargos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function gems(){
  $('#valor1').val("3");
  $('#valor2').val("cargos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function ems(){
  $('#valor1').val("4");
  $('#valor2').val("cargos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function eMunicipales(){
  $('#valor1').val("5");
  $('#valor2').val("puestos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function dFederales(){
  $('#valor1').val("6");
  $('#valor2').val("cargos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function pMunicipales(){
  $('#valor1').val("7");
  $('#valor2').val("puestos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function regidores(){
  $('#valor1').val("8");
  $('#valor2').val("puestos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function diputados(){
  $('#valor1').val("9");
  $('#valor2').val("puestos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function gEstado(){
  $('#valor1').val("10");
  $('#valor2').val("cargos");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}

function myFunction3(id){
  var idContact = id;
  $('#vcod').val(idContact);
        $(document).ready(function() {
        $.post(
        "consultar/proc2.php", $("#vcod").serialize(),function(a){
          mostrarCon();
        $('#pers').html(a);
        });
  });
}

/*Para los botones de cerrar tarjetas*/
function ocultarCon(){
document.getElementById('pers').style.display = 'none';
}

function mostrarCon(){
document.getElementById('pers').style.display = 'inline-block';
}

/* Funcion para lanzar editar en la tarjeta*/
function myFunction4(id){
  var idContact = id;
  $('#idCon').val(idContact);
        $(document).ready(function() {
        $.post(
        "consultar/proc4.php", $("#idCon").serialize(),function(a){
          mostrarCon();
        $('#pers').html(a);
        });
  });  
}

function myFunction5(id){
  var idFoto = id;
  $('#idFoto').val(idFoto);
        $(document).ready(function() {
        $.post("consultar/proc5.php", $("#idFoto").serialize(),function(a){
          mostrarCon();
        $('#pers').html(a);
        });
  });  
}

function actualizar(){
  $(document).ready( function() {
        if(validaFormulario()){                           
            $.post("consultar/actualizar.php",$('#formUpdate').serialize(),function(res){  
                if(res == 1){
                    alert("Contacto Actualizado");
                } else {
                    alert("Error. Contacto no actualizado");
                }
            });
        }
});
}

function actualizarPuesto(){
  $(document).ready( function() {
        $("#NuevoPuesto").show();
});
}
function validaFormulario(){
  return true;
}

function myFunction6(){
$(document).ready(function() {
      $.post(
      "administrar/listas.php", $("#catalago").serialize(),function(a){
      $('#listas').html(a);
      });
   });
}

function myFunction7(id){
  var idRegistro = id;
  $('#valor1').val(idRegistro);
      $(document).ready(function() {
        $.post(
        "administrar/actualizarDato.php", $("#formPref").serialize(),function(a){
        $('#listas').html(a);
        });
  });
}
function actualizar2(){
  $(document).ready( function() {
        if(validaFormulario()){                           
            $.post("administrar/actualizar.php",$('#formUpdate').serialize(),function(res){  
                if(res == 1){
                    alert("Registro Actualizado");
                } else {
                    alert("Error. Registro no actualizado");
                }
            });
        }
});
}

