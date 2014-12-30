function formhash(form, password) {
    // Crea un nuevo elemento input, éste será el campo de la contraseña codificada.
    var p = document.createElement("input");
 
    // Añade el nuevo elemto al formulario.
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Se asegura que la contraseña sin codificar no se envíe.
    password.value = "";
 
    // Finalmente envía el formulario.
    form.submit();
}