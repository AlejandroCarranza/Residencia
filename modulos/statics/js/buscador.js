function myFunction(){

var n=document.getElementById('bus').value;

if(n==''){

 document.getElementById("lista").innerHTML="";
 document.getElementById("lista").style.border="0px";

 document.getElementById("pers").innerHTML="";

 return;
}

loadDoc("q="+n,"../../templates/consultar/proc.php",function(){

  if (xmlhttp.readyState==4 && xmlhttp.status==200){

    document.getElementById("lista").innerHTML=xmlhttp.responseText;
    document.getElementById("lista").style.border="1px solid #A5ACB2";

    }
    else { 
      //document.getElementById("lista").innerHTML='<img src="load.gif" width="50" height="50" />'; 
    }

  });
}


function myFunction2(cod){

document.getElementById("lista").innerHTML="";
document.getElementById("lista").style.border="0px";

loadDoc("vcod="+cod,"../../templates/consultar/proc2.php",function(){

  if (xmlhttp.readyState==4 && xmlhttp.status==200){

    document.getElementById("pers").innerHTML=xmlhttp.responseText;
    
    }else{ document.getElementById("pers").innerHTML='<img src="load.gif" width="50" height="50" />'; }

  });
}