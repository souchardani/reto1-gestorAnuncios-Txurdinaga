<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/style.css">
  <title>Perfil Administrador</title>
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

  <div class="title-2">
    <h1 class="titulo">PERFIL ADMINISTRADOR</h1>
  </div>
  
  <main class="main-2">
    <h2>Anuncios pendientes a validar</h2>
    <div class="buscador">
      <input type="text" name="nombre" maxlength="50" id="nombre" placeholder="Buscar por titulo"><br><br>

      <select name="grado" id="grado">
        <option value="all">Todas las categorías</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
      </select>
    </div>
    <table>
      <tr>
        <th class="anu">Anuncio</th>
        <th class="fec">Fecha</th>
        <th class="est">Estado</th>
        <th class="acc">Acción</th>
      </tr>
      <tr>
        <td>imagen</td>
        <td>Jul 13, 2021</td>
        <td>Confirmada</td>
        <td></td>
      </tr>
      <tr>
        <td>imagen</td>
        <td>Jul 5, 2021</td>
        <td>Pendiente Revision</td>
        <td></td>
      </tr>
    </table>
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