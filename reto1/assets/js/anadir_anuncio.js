document.addEventListener("DOMContentLoaded", function () {
  const miformulario = document.getElementById("formulario");

  miformulario.addEventListener("submit", function (event) {
    // Detiene el envío del formulario

    const titulo = document.getElementById("title").value.trim();
    const descripcion = document.getElementById("anuncio").value.trim();
    const imagenA = document.getElementById("seleccionaImagen");
    const imagen = imagenA.files[0]; // Obtiene el archivo seleccionado

    if (titulo === "" || descripcion === "" || !imagen === "") {
      alert("Todos los campos tienen que estar rellenados.");
      event.preventDefault();
    }
    // Verifica si el nombre tiene menos de 3 caracteres
    else if (titulo.length <= 5) {
      alert("El titulo del anuncio tiene que tener mas de 5 caracteres.");
      event.preventDefault();
    } else if (descripcion.length <= 20) {
      alert("La descripcion debe tener al menos 20 carácteres.");
      event.preventDefault();
    } else {
      // Verifica la extensión del archivo
      const allowedExtensions = ["jpg", "jpeg", "png"];
      const extension = imagen.name.split(".").pop().toLowerCase();

      if (allowedExtensions.indexOf(extension) === -1) {
        alert("La imagen debe ser de formato JPG ,JPEG o PNG.");
        event.preventDefault();
      } else {
        miformulario.submit();
      }
    }
  });
});
