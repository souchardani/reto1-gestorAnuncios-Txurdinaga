document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const warnings = document.getElementById("warnings");

    form.addEventListener("submit", function (event) {
        // Detiene el envío del formulario
        event.preventDefault();

        // Realiza la validación de los campos aquí
        const name = document.getElementById("name").value.trim();
        const user = document.getElementById("user").value.trim();
        const apellido = document.getElementById("apellido").value.trim();
        const correo = document.getElementById("correo").value.trim();
        const checkbox = document.getElementById("checkbox");
        const contrasena = document.getElementById("contrasena").value.trim();
        const contrasena1 = document.getElementById("contrasena1").value.trim();
        var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;


        // Restablece los mensajes de advertencia
        warnings.innerHTML = "";

        // Comprobacion que no dejas ningun campo del formulario sin rellenar
        if (name === "" || user === "" || correo === "" || contrasena === "" || contrasena1 === "" || contrasena1 === "" || apellido === "") {
            warnings.innerHTML += "Porfavor debes de rellenar todo el formulario completo .<br><br>";
        }
        // Mostrado como mensaje que se han rellenado todos los campos de manera correcta
        else{
            correcto.innerHTML += "Has rellenado todos los campos .<br>"
        }
        //Contraseña si cumple un formato de contraseña , teniendo que ser mayor de 8 caracteres , con minuscula y mayuscula
        if(contrasena.length>8 && contrasena.match(/[a-z]/) && contrasena.match(/[A-Z]/) && contrasena.match(/\d/)){
            console.log("Estoy vivo");
        }
        else{
            warnings.innerHTML += "La contraseña no cumple los requisitos"
        }
        // Comprobacion de que las contraseñas coinciden
        if(contrasena !== contrasena1){
            warnings.innerHTML += "Las contraseñan no coinciden<br><br>";
        }
        //Comprobacion de que el boton de que has leido los termines esta pulsado o no 
        if (checkbox.checked){
            
            alert("Has aceptado los términos y condiciones.");
        }
        else{
            warnings.innerHTML += "Tienes que aceptar los terminos.<br>";
        }
        //Comprobacion de que el nombre de la persona es mayor de 3 caracteres y no esta conformado por ninguno numero
        if (name.length >= 3 && !/\d/.test(name)) {
            console.log("Nombre validado");
        } else {
            alert("El nombre tiene que tener mas de 3 caracteres y  no puede tener numeros.");
            mensaje.textContent = "El nombre debe tener al menos tres caracteres y no debe contener números.";
        }
        //Comprobacion de que el usuario de la persona es mayor de 3 caracteres y no esta conformado por ninguno numero
        if (user.length >= 3 && !/\d/.test(user)) {
            console.log("Usuario Validado");
        } else {
            alert("El usuario tiene que tener mas de 3 caracteres y  no puede tener numeros.");
            mensaje.textContent = "El nombre debe tener al menos tres caracteres y no debe contener números.";
        }
        //Comprobacion de que el apellido de la persona es mayor de 3 caracteres y no esta conformado por ninguno numero
        if (name.length >= 3 && !/\d/.test(name)) {
            console.log("Apellido Validado");
        } else {
            alert("El apellido tiene que tener mas de 3 caracteres y  no puede tener numeros.");
            mensaje.textContent = "El apellido debe tener al menos tres caracteres y no debe contener números.";
        }
        
        
        if( validEmail.test(correo) ){
            alert('Email is valid, continue with form submission');
            
        }else{
            alert('Email is invalid, skip form submission');
        }
            

        // Si hay mensajes de advertencia, no se envía el formulario
        if (warnings.innerHTML !== "") {
            return false;
        }

        // Si la validación pasa, puedes enviar el formulario
        form.submit();
    });
});

