<header>
  <div>
    <a href="../public/index.php">
      <img src="../assets/img/logo txurdinaga principal.png" alt="" id="logo">
    </a>
  </div>

  <div id="header-perfil">
    <a href="../views/login.php">
      <img src="../assets/img/user.png" alt=""  id="foto-perfil">
    </a>
  </div>
</header>

<nav id="nav-links">
  <ul>
    <li id="li-inicio"><a href="../public/index.php">Inicio</a></li>
    <li id="li-perfil"><a href="../views/anuncios_inicio.php">Anuncios</a></li>
    <li id="li-crear"><a href="../views/anadir_anuncio.php"><i class="fas fa-edit"></i> Añadir anuncio</a></li>
    <li id="li-buscador">
      <form id="buscador" action="" method="POST">
        <input id="busqueda" type="search" name="busqueda" placeholder="Buscar anuncio..." value="">
        <button id="buscar" type="submit"><i class="fa fa-search"></i></button>
      </form>
    </li>
  </ul>
</nav>