<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/app.js"></script>
  <title>Anuncio Pendiente</title>
</head>

<body>
  <header>
    <div>
      <a href="../index.php">
        <img src="../assets/img/FP-header.png" alt="logo" id="logo">
      </a>
    </div>

    <div>
        <img onclick="menu()" src="../assets/img/doffy.jpeg" alt="perfil" id="foto-perfil">
        <div id="dropdown-content">
            <a href="Editar-usuarios.php">Mi Perfil</a>
            <a href="Perfil-administrador.php">Panel Control (Admin)</a>
            <a href="../index.php">Log Out</a>
        </div>
    </div>
  </header>

  <nav>
    <ul>
      <a class="li-inicio" href="../index.php">
        <li>Inicio</li>
      </a>
      <a class="li-anuncios" href="Anuncios.php">
        <li>Anuncios</li>
      </a>
      <a class="li-crear" href="Crear-anuncio.php">
        <li>Crear anuncio</li>
      </a>
      <li class="li-buscador">
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

  <div class="caja-titulo">
    <h1>CREAR ANUNCIO</h1>
  </div>

  <main class="main-4">
    <form class="form-4">
      <fieldset>
        <img class="img-check" src="../assets/img/checkmark.png" alt="test"><br><br>
        <h1>Tu Anuncio se ha publicado pero esta Pendiente de Revision</h1>
        <p>Te notificaremos cuando el administrador lo apruebe</p>
        <button id="ver-anun">Ver Anuncios</button>
      </fieldset>
    </form>
  </main>

  <footer>
    <div class="footer-col1">
      <a href="../index.php"><img id="footer-logo" src="../assets/img/FP-footer.png"></a>
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