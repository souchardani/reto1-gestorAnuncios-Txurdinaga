<header>
  <div>
    <a href="../public/index.php">
      <img src="../assets/img/logo txurdinaga principal.png" alt="" id="logo">
    </a>
  </div>

  <div >

  </div>
  <div class="header-perfil">
    <button class="btn-dropdown"> 
      <img src="../assets/img/user.png" id="foto-perfil" style="width:50px;">
    </button>
    <div class="dropdown-content">
      <a href="../views/miperfil.php">Mi perfil</a>
      <a href="../views/dashboard.php">Panel de control</a>
      <a href="../views/cerrar_sesion.php">Log out</a>
    </div>
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