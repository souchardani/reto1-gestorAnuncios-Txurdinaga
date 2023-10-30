document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form");
  const warnings = document.getElementById("warnings");

  form.addEventListener("submit", function (event) {
    // Detiene el envío del formulario

    const nombre = document.getElementById("nombre").value.trim();
    const apellido = document.getElementById("apellido").value.trim();
    const imagenI = document.getElementById("seleccionaImagen");
    const imagen = imagenI.files[0]; // Obtiene el archivo seleccionado

    if (nombre === "" || apellido === "") {
      alert("Rellena todos los campos.");
      event.preventDefault();
    }
    // Verifica si el nombre tiene menos de 3 caracteres
    else if (nombre.length <= 3) {
      alert("El nombre debe tener al menos 3 caracteres.");
      event.preventDefault();
    } else if (apellido.length <= 3) {
      alert("el apellido debe tener al menos 3 carácteres.");
      event.preventDefault();
    } else {
      // Verifica la extensión del archivo
      const allowedExtensions = ["jpg", "jpeg", "png"];
      const extension = imagen.name.split(".").pop().toLowerCase();

      if (allowedExtensions.indexOf(extension) === -1) {
        alert("La imagen debe ser de formato JPG ,JPEG o PNG.");
        event.preventDefault();
      } else {
        form.submit();
      }
    }
  });
});
