// Verificar si hay datos guardados en el localStorage y rellenar los campos del formulario

if (localStorage.getItem("nombre")) {
  document.getElementById("nombre").value = localStorage.getItem("nombre");
}
if (localStorage.getItem("apellido")) {
  document.getElementById("apellido").value = localStorage.getItem("apellido");
}
if (localStorage.getItem("nickname")) {
  document.getElementById("nickname").value = localStorage.getItem("nickname");
}
if (localStorage.getItem("email")) {
  document.getElementById("email").value = localStorage.getItem("email");
}
if (localStorage.getItem("fecha")) {
  document.getElementById("fecha").value = localStorage.getItem("fecha");
}
if (localStorage.getItem("clase")) {
  document.getElementById("clase").value = localStorage.getItem("clase");
}
if (localStorage.getItem("tipo")) {
  document.getElementById("tipo").value = localStorage.getItem("tipo");
}

// Guardar datos en el localStorage cuando el usuario escriba algo
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("nombre").addEventListener("input", function () {
    localStorage.setItem("nombre", this.value);
  });
  document.getElementById("apellido").addEventListener("input", function () {
    localStorage.setItem("apellido", this.value);
  });
  document.getElementById("nickname").addEventListener("input", function () {
    localStorage.setItem("nickname", this.value);
  });
  document.getElementById("email").addEventListener("input", function () {
    localStorage.setItem("email", this.value);
  });
  document.getElementById("fecha").addEventListener("input", function () {
    localStorage.setItem("fecha", this.value);
  });
  document.getElementById("clase").addEventListener("change", function () {
    localStorage.setItem("clase", this.value);
  });
  document.getElementById("tipo").addEventListener("change", function () {
    localStorage.setItem("tipo", this.value);
  });
});
