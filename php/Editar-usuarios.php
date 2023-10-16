<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/style.css">
  <title>Editar Usuario</title>
</head>

<body>
  <header>
    <div>
      <a href="Inicio.php">
        <img src="../assets/img/FP-header.png" alt="logo" id="logo">
      </a>
    </div>
  
    <div>
      <a href="Editar-usuarios.php">
        <img src="../assets/img/doffy.jpeg" alt="perfil" id="foto-perfil">
      </a>
    </div>
  </header>
  
  <nav id="nav-links">
    <ul>
      <a id="li-inicio" href="Inicio.php">
        <li>Inicio</li>
      </a>
      <a id="li-perfil" href="Editar-usuarios.php">
        <li>Perfil</li>
      </a>
      <a id="li-crear" href="Crear-anuncio.php">
        <li>Crear anuncio</li>
      </a>
      <li id="li-buscador">
        <form id="buscador" action="" method="POST">
          <div>
            <input id="busqueda" type="search" name="busqueda" placeholder="Bilatu liburua..." value="">
          </div>
          <div>
            <button id="buscar" type="submit"><img class="search-img" src="../assets/img/search.png" alt=""></button>
          </div>
        </form>
      </li>
    </ul>
  </nav>

  <div class="title-1">
    <h1 class="titulo">EDITAR USUARIO</h1>
  </div>
  
  <main class="main-1">
    <h2>Información de tu perfil</h2>
    <form class="form-1">
      <fieldset>
        <label>Foto de Perfil: </label><br><br>
        <img class="img-perfil" src="../assets/img/default-user.png" alt="test"><br><br>
        <button id="perbtn">Cambiar foto de perfil</button><br><br>

        <label>Nombre Completo: </label><br>
        <input type="text" name="nombre" maxlength="50" id="nombre" placeholder="Nombre Completo"><br><br>

        <label>Email: </label><br>
        <input type="email" name="email" id="email" placeholder="email@email.com"><br><br>

        <label>Grado: </label><br>
        <select name="grado" id="grado">
          <option></option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select><br><br>

        <label>Teléfono: </label><br>
        <input type="tel" name="tele" placeholder="Escribe tu teléfono (123-456-789)" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" id="tele"><br><br>

        <button id="savebtn">Guardar Cambios</button>
      </fieldset>
    </form>
  </main>

  <footer>
    <div class="footer-col1">
        <a href="Inicio.php"><img id="footer-logo" src="../assets/img/FP-footer.png"></a>
        <div id="datos1">C/ Doctor Ornilla 2</div>
        <div id="datos2">48004 Bilbao</div>
        <div id="datos3">Telefono: +34 94 412 57 12</div>
        <div id="datos4">Email: idazkaria@fpTXurdinaga.com</div>
    </div>
    <div class="footer-col2">
        <div>
            <img class="socials-img" src="../assets/img/insta.png" alt="insta">
            <img class="socials-img" src="../assets/img/twitter.png" alt="twitter">
            <img class="socials-img" src="../assets/img/linkedin.png" alt="LinkedIn">
        </div>
        <p id="datos5">POLÍTICA DE PRIVACIDAD</p>
        <p id="datos6">COOKIES</p>
        <p id="datos7">MAPA WEB</p>
        <p id="datos8">CONTACTO</p>
    </div>
    <div class="footer-col3">
        <div class="logos-arriba">
            <img src="../assets/img/48005.png" class="footer-emp-img">
            <img src="../assets/img/48007.png" class="footer-emp-img">
            <img src="../assets/img/Lanbide 1.png" class="footer-emp-img">
        </div>
        <div class="logos-abajo">
            <img src="../assets/img/48006.png" class="footer-emp-img">
            <img src="../assets/img/image 1.png" class="footer-emp-img">
        </div>
    </div>
  </footer>
</body>

</html>