const buscar = document.querySelector(".input-group input"),
  filas_tabla = document.querySelectorAll("tbody tr");

buscar.addEventListener("input", buscarEnTabla);

function buscarEnTabla() {
  let texto_busqueda = buscar.value.toLowerCase();

  filas_tabla.forEach((fila, i) => {
    let texto_tabla = fila.textContent.toLowerCase();
    fila.hidden = true;

    if (texto_tabla.includes(texto_busqueda)) {
      fila.hidden = false;
    }
  });
}
