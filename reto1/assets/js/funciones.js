//funcion para el toggle del menu
let droplist = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".profile-dropdown-btn");

// esta funcion muestra/oculta el menu desplegable
const toggle = () => droplist.classList.toggle("active");

window.addEventListener("click", function (e) {
  //ocula el menu desplegable si se hace click fuera de el
  if (!btn.contains(e.target)) {
    droplist.classList.remove("active");
  }
});

//funcion para confirmar el borrado
function confirmarBorrado() {
  return confirm(
    "Estas seguro que deseas borrar el Anuncio? Esta accion no se puede desahacer"
  );
}

//funcion para crear el header dinamico
function createDynamicHeader(headerText) {
  const dynamicHeader = document.getElementById("dynamicHeader");
  dynamicHeader.innerHTML = `
        <header class="text-bg-light py-3 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>
                            <i class="fa-solid fa-edit" style="color: #f3b82a"></i>
                            ${headerText}
                        </h1>
                    </div>
                </div>
            </div>
        </header>
    `;
}
