document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const warnings = document.getElementById("warnings");

    form.addEventListener("submit", function (event) {
        // Detiene el envío del formulario
        event.preventDefault();
    
        const nombre = document.getElementById("nombre").value.trim();
        const apellido = document.getElementById("apellido").value.trim();
        const imagenI = document.getElementById("seleccionaImagen");
        const imagen = imagenI.files[0]; // Obtiene el archivo seleccionado
        

        if(nombre === "" || apellido === ""  ||imagen === ""){
            
            alert("Rellena todos los campos.");    
        }
        // Verifica si el nombre tiene menos de 3 caracteres
        else if (nombre.length <= 3) { 
            alert("El nombre debe tener al menos 3 caracteres.");
        }else if (apellido.length <=3){
            alert ("el apellido debe tener al menos 3 carácteres.");
        }
        else  {
            // Verifica la extensión del archivo
            const allowedExtensions = ["jpg", "jpeg", "png"];
            const extension = imagen.name.split('.').pop().toLowerCase();
        
            if (allowedExtensions.indexOf(extension) === -1) {
                alert("La imagen debe ser de formato JPG ,JPEG o PNG.");
            }
        else{
            alert("Has rellenado todos los campos."); 
            form.submit(); 
        }    
}});
});