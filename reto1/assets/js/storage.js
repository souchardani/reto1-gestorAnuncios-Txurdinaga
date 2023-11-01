// Verificar si hay datos guardados en el localStorage y rellenar los campos del formulario
if (localStorage.getItem("tituloAnuncio")) {
  document.getElementById("title").value =
    localStorage.getItem("tituloAnuncio");
}
if (localStorage.getItem("Categoria")) {
  document.getElementById("tituloCategoria").value =
    localStorage.getItem("Categoria");
}
if (localStorage.getItem("DescripcionAnuncio")) {
  document.getElementById("anuncio").value =
    localStorage.getItem("DescripcionAnuncio");
}

// Guardar datos en el localStorage cuando el usuario escriba algo
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("title").addEventListener("input", function () {
    localStorage.setItem("tituloAnuncio", this.value);
  });
  document
    .getElementById("tituloCategoria")
    .addEventListener("change", function () {
      localStorage.setItem("Categoria", this.value);
    });
  document.getElementById("anuncio").addEventListener("input", function () {
    localStorage.setItem("DescripcionAnuncio", this.value);
  });
});
