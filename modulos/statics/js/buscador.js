/* Funcion para el buscador por nombre
  Se activa cada que el usuario ingresa un caracter a la caja de texto y se envian a esta funcion
  la que envia el valor recibido a proc.html, el que nos regresa una lista con las coincidencias
  encontradas y finalmente se despliegan en forma de lista
*/
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

/* Funcion para realizar una busqueda del contacto seleccionado en la lista de opciones en busqueda por nombre
  Esta funcion recibe el id del contacto y lo almacena en vcod, el cual lo envia a proce2.php y esta nos despliega
  la tarjeta del contacto
*/

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

/* Funcion para mandar el valor de los botones de consuoltas por subcomite a proc3.php 
  Recibe el id del contacto y lo almacena en idSubcom e inmeditamente se almacena el valor
  en el campo valor1 que esta en el html, despues comprueba que la subcomicion se relacione
  con puestos o con cargos, segun lo que corresponda se cambia el valor del campo valor2 que esta
  en el html con puestos o cargos, segun se cumpla la condicion.

  Despues se envia el formulario formPref a proc3.php y se carga la respuesta en el div contenidoRes.
*/
function btnsSubcomites(id){
  var idSubcom = id;
  var tipoCargo = 0;
  $('#valor1').val(idSubcom);
  if ((idSubcom == 5) || (idSubcom == 7) || (idSubcom == 9) || (idSubcom == 10)) {
    $('#valor2').val("puestos");
  }
  else{
    $('#valor2').val("cargos");
  };
  
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#formPref").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}

/* Funcion para la carga de la tarjeta del contacto
  Se recibe el id del contacto, se guarda en id_Contacto, se cambia el valor del campo vcod con el id del contacto
  despues se envia ese campo a proc2.php y se carga la respuesta de proc2.php en el div pers
*/
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

/* Funcion ara los botones de cerrar tarjetas 
  Oculta o muestra el div pers
*/
function ocultarCon(){
document.getElementById('pers').style.display = 'none';
}

function mostrarCon(){
document.getElementById('pers').style.display = 'inline-block';
}


/* Funcion para lanzar editar en la tarjeta 
  Recibe el id del contacto, lo guarda en idContact, cambia el valor del campo idCon que esta en el html
  para despues enviar el campo idCon a proc4.php, llama la funcion mostrarCon() y finalmenta carga la respuesta de proc4.php en el div pers
*/
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

/* Funcion que envia valores por AJAX a proc5.php para el almacenado de la fotografia
  Recibe el id del contacto, lo guarda en idFoto, cambia el valor del campo idFoto que esta en el html
  para despues enviar el campo idFoto a proc5.php, llama la funcion mostrarCon() y finalmenta carga la respuesta de proc5.php en el div pers
*/
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
/* 
  
*/
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

