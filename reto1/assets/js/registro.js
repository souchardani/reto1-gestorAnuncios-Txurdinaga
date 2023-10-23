const form = document.getElementById("registroForm");
const inputs = form.querySelectorAll("input");
const pass1 = document.getElementById("pass1");
const pass2 = document.getElementById("pass2");

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
});