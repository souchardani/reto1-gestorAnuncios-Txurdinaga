const buscar = document.querySelectorAll(".input-group input"),
  filas_tabla = document.querySelectorAll("tbody tr");

buscar.forEach((input) => {
  input.addEventListener("input", buscarEnTabla);
});

function buscarEnTabla(event) {
  let texto_busqueda = event.target.value.toLowerCase();

  filas_tabla.forEach((fila, i) => {
    let texto_tabla = fila.textContent.toLowerCase();
    fila.hidden = true;

    if (texto_tabla.includes(texto_busqueda)) {
      fila.hidden = false;
    }
  });
}
