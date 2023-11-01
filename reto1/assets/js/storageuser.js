// Verificar si hay datos guardados en el localStorage y rellenar los campos del formulario

if (localStorage.getItem("nombre")) {
  document.getElementById("nombre").value = localStorage.getItem("nombre");
}
if (localStorage.getItem("apellido")) {
  document.getElementById("apellido").value = localStorage.getItem("apellido");
}
if (localStorage.getItem("username")) {
  document.getElementById("username").value = localStorage.getItem("username");
}
if (localStorage.getItem("correo")) {
  document.getElementById("correo").value = localStorage.getItem("correo");
}
if (localStorage.getItem("nacimiento")) {
  document.getElementById("nacimiento").value =
    localStorage.getItem("nacimiento");
}

// Guardar datos en el localStorage cuando el usuario escriba algo
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("nombre").addEventListener("input", function () {
    localStorage.setItem("nombre", this.value);
  });
  document.getElementById("apellido").addEventListener("input", function () {
    localStorage.setItem("apellido", this.value);
  });
  document.getElementById("username").addEventListener("input", function () {
    localStorage.setItem("username", this.value);
  });
  document.getElementById("correo").addEventListener("input", function () {
    localStorage.setItem("correo", this.value);
  });
  document.getElementById("nacimiento").addEventListener("input", function () {
    localStorage.setItem("nacimiento", this.value);
  });
});
