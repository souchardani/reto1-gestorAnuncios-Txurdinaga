document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const warnings = document.getElementById("warnings");

    form.addEventListener("submit", function (event) {
        // Detiene el envío del formulario
        event.preventDefault();
    
        const titulo = document.getElementById("title").value.trim();
        const descripcion = document.getElementById("anuncio").value.trim();
        const imagenA = document.getElementById("seleccionaImagen");
        const imagen = imagenA.files[0]; // Obtiene el archivo seleccionado
        

        if(titulo === "" || descripcion === ""  ||imagen === ""){
            
            alert("Todos los campos tienen que estar rellenados.");    
        }
        // Verifica si el nombre tiene menos de 3 caracteres
        else if (titulo.length <= 5) { 
            alert("El titulo del anuncio tiene que tener mas de 5 caracteres.");
        }else if (descripcion.length <=20){
            alert ("La descripcion debe tener al menos 20 carácteres.");
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