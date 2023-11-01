// Función para limpiar el localStorage
console.log("Limpieza de localStorage iniciada.");

function limpiarLocalStorage() {
  return new Promise((resolve, reject) => {
    console.log("Limpiando localStorage");
    localStorage.removeItem("tituloAnuncio");
    localStorage.removeItem("Categoria");
    localStorage.removeItem("DescripcionAnuncio");
    localStorage.removeItem("nombre");
    localStorage.removeItem("apellido");
    localStorage.removeItem("username");
    localStorage.removeItem("correo");
    localStorage.removeItem("nacimiento");
    console.log("localStorage limpio.");
    resolve();
  });
}

// Ejecutar la función de limpieza al cargar el script
limpiarLocalStorage();
