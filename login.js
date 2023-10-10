document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const warnings = document.getElementById("warnings");

    form.addEventListener("submit", function (event) {
        // Detiene el envío del formulario
        event.preventDefault();
    
        const correo = document.getElementById("correo").value.trim();
        const contrasena = document.getElementById("contrasena").value.trim();
        const validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
        const checkbox = document.getElementById("checkbox");
        warnings.innerHTML="";

        if(correo === "" || contrasena === ""){
            warnings.innerHTML += "Rellena todos los campos porfavor<br><br>"

            
        }
        // Validacion de correo electronico.
        if( validEmail.test(correo) ){
            alert('Email is valid, continue with form submission');
            
        }else{
            alert('Email is invalid, skip form submission');
        }
        //Comprobacion de que el boton de que has leido los termines esta pulsado o no 
        if (checkbox.checked){
        
        alert("Has aceptado los términos y condiciones.");
        }
        else{
            warnings.innerHTML += "Tienes que aceptar los terminos.<br>";
        }

        // Si hay mensajes de advertencia, no se envía el formulario
        if (warnings.innerHTML !== "") {
            return false;
        }
    });
});
