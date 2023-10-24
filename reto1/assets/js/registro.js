const form = document.getElementById("registroForm");
const inputs = form.querySelectorAll("input");
const selects = form.querySelectorAll("select");
const pass1 = document.getElementById("pass1");
const pass2 = document.getElementById("pass2");
const fecha = document.getElementById("fecha");

// Regex 6 caracteres, una mayuscula y una minuscula como minimo
const passwordRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d{6,}).*$/;

// Funcion que calcula la edad (minimo 15 años)
fecha.addEventListener("change", function () {

  const fechaNacimiento = new Date(this.value);
  const fechaActual = new Date();

  const edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();

  if (edad < 15) {
    fecha.classList.add("rojo");
  } else {
    fecha.classList.add("verde");
  }
});

// Función para validar la contraseña
function validarContrasena(contrasena) {
  return passwordRegex.test(contrasena);
}

// Validacion de los inputs
inputs.forEach(input => {
  input.addEventListener("keyup", function() {
    if (input.value === "") {
      input.classList.remove("azul", "verde");
      input.classList.add("rojo");
    } else {
      input.classList.remove("rojo");
      if (input.validity.valid) {
        input.classList.add("verde");
      } else {
        input.classList.add("azul");
      }
    }
  });
});

// Validacion de los select
selects.forEach(select => {
  select.addEventListener("click", function(){
    if (select.value === "") {
      select.classList.remove("azul", "verde");
      select.classList.add("rojo");
    } else {
      select.classList.remove("rojo");
      if (select.validity.valid) {
        select.classList.add("verde");
      } else {
        select.classList.add("azul");
      }
    }
  })

})

// Comprueba que las contraseñas coinciden
pass2.addEventListener("keyup", function() {
  if (pass1.value === pass2.value) {
    pass1.classList.remove("rojo");
    pass1.classList.add("verde");
    pass2.classList.remove("rojo");
    pass2.classList.add("verde");
  } else {
    pass1.classList.remove("verde");
    pass1.classList.add("rojo");
    pass2.classList.remove("verde");
    pass2.classList.add("rojo");
  }

  if (validarContrasena(pass1.value)) {
    pass1.classList.remove("azul");
    pass1.classList.add("verde");
  } else {
    pass1.classList.remove("azul");
    pass1.classList.add("verde");
  }
});