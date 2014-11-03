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
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}

function salud(){
  $('#valor1').val("2");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function gems(){
  $('#valor1').val("3");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function ems(){
  $('#valor1').val("4");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function eMunicipales(){
  $('#valor1').val("5");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function dFederales(){
  $('#valor1').val("6");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function pMunicipales(){
  $('#valor1').val("7");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function regidores(){
  $('#valor1').val("8");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function diputados(){
  $('#valor1').val("9");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
        $('#contenidoRes').html(a);
        });
  });
}
function gEstado(){
  $('#valor1').val("10");
      $(document).ready(function() {
        $.post(
        "consultar/proc3.php", $("#valor1").serialize(),function(a){
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
