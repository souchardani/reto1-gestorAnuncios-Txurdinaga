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






// window.addEventListener("load", sendForm);

// const datosRegistro = {
//   name: "",
//   surname: "",
//   user: "",
//   email: "",
//   pass1: "",
//   pass2: "",
//   picture: "",
//   error: {
//     exists: false,
//     mensaje: "",
//   }
// };

// function sendForm(e){
//   e.preventDefault();
  
//   if (this.validateFormCompletely()) {
//     document.querySelector("form").submit();
//     console.log("Todo correcto. Procedemos a enviar el FORM");
//   } else {
//     console.log("ERROR. Algunos de los campos no son válidos");
//   }
// };

// function validateNombre(nombre) {
//   if (nombre !== "") {
//     this.error = false;
//     document.getElementById("nombre").style.borderColor = "green";
//   } else if (nombre === " ") {
//     this.error = true;
//     document.getElementById("nombre").style.borderColor = "blue";
//   } else {
//     this.error = true;
//     document.getElementById("nombre").style.borderColor = "red";
//   }
// }

// function validateApellido(apellido) {
//   if (apellido !== "") {
//     this.error = false;
//     document.getElementById("apellido").style.borderColor = "green";
//   } else if (apellido === "") {
//     this.error = true;
//     document.getElementById("apellido").style.borderColor = "blue";
//   } else {
//     this.error = true;
//     document.getElementById("apellido").style.borderColor = "red";
//   }
// }

// function validateNickname(nickname) {
//   if (nickname !== "") {
//     this.error = false;
//     document.getElementById("nickname").style.borderColor = "green";
//   } else if (nickname === "") {
//     this.error = true;
//     document.getElementById("nickname").style.borderColor = "blue";
//   } else {
//     this.error = true;
//     document.getElementById("nickname").style.borderColor = "red";
//   }
// }

// function validateEmail(email) {
//   if (/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g.test(email)) {
//     this.error = false;
//     document.getElementById("email").style.borderColor = "green";
//   } else if (email === "") {
//     this.error = true;
//     document.getElementById("email").style.borderColor = "blue";
//   } else {
//     this.error = true;
//     document.getElementById("email").style.borderColor = "red";
//   }
// }

// function validatePassword(pass1) {
//   if (/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,}$/.test(pass1)) {
//     this.error = false;
//     document.getElementById("pass1").style.borderColor = "green";
//   } else if (pass1 === "") {
//     this.error = true;
//     document.getElementById("pass1").style.borderColor = "blue";
//   } else {
//     this.error = true;
//     document.getElementById("pass1").style.borderColor = "red";
//   }

//   this.comparePasswords(this.pass1, this.pass2);
// }

// function comparePasswords(pass1, pass2) {
//   if (pass1 === pass2 && pass1 !== "") {
//       this.error = false;
//       document.getElementById("pass2").style.borderColor = "green";
//   } else if (pass2 === "") {
//       this.error = true;
//       document.getElementById("pass2").style.borderColor = "blue";
//   } else {
//       this.error = true;
//       document.getElementById("pass2").style.borderColor = "red";
//   }
// }

// function validateFormCompletely() {
//   console.log("Comprobamos todo");

//   // Comprobar las validaciones
//   this.validateNombre(this.nombre);
//   this.validateApellido(this.apellido);
//   this.validateNickname(this.nickname);
//   this.validateEmail(this.email);
//   this.validatePassword(this.pass1);
//   this.comparePasswords(this.pass1, this.pass2);

//   return !this.error;
// }

// nombre(value) {
//   this.nombre = value;
//   this.validateNombre(value);
// }

// apellido(value) {
//   this.apellido = value;
//   this.validateApellido(value);
// }

// user(value) {
//   this.user = value;
//   this.validateUser(value);
// }

// email(value) {
//   this.email = value;
//   this.validateEmail(value);
// }

// pass1(value) {
//   this.pass1 = value;
//   this.validatePassword(value);
// }

// pass2(value) {
//   this.pass2 = value;
//   this.comparePasswords(value);
// }