<link rel="stylesheet" href="../assets/css/style.css">
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