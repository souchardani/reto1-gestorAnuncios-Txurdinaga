<?php require_once("../assets/includes/DB.php"); ?>
<?php require_once("../assets/includes/funciones.php"); ?>
<?php require_once("../assets/includes/sesiones.php"); ?>

<?php
  //verificamos login
  if(isset($_SESSION["usuario_global"])){
    if(isset($_SESSION["tipoUsuario_global"])){
      if($_SESSION["tipoUsuario_global"] == "Administrador"){
        $tipoUsuario = "Administrador";
      }else{
        $tipoUsuario = "Usuario";
      }
    }
  }else {
    $tipoUsuario = "Invitado";
  }
?>

<header>
  <div>
    <a href="../public/index.php">
      <img src="../assets/img/logo txurdinaga principal.png" alt="" id="logo">
    </a>
  </div>

  <?php 
    // si el usuario es invitado
    if ($tipoUsuario == "Invitado") { 
  ?>
  <button class="animated-button" onclick="location.href = '../views/login.php'"><span>Iniciar Sesión</span><span></span></button> 
  <?php }else if($tipoUsuario=="Administrador") { ?>
    <div class="profile-dropdown">
      <div class="profile-dropdown-btn" onclick="toggle()">
        <div class="profile-img">
          <img src="../assets/img_subidas/usuarios/<?php echo $_SESSION["foto_global"] ?>" />
        </div>
        <span>
          <?php echo $_SESSION["usuario_global"]; ?>
          <i-fa-solid class="fa-solid fa-angle-down"></i-fa-solid>
        </span>
      </div>

      <ul class="profile-dropdown-list">
        <li class="profile-dropdown-list-item">
          <a href="../views/miperfil.php">
            <i class="fa-regular fa-user"></i>
            Editar perfil
          </a>
        </li>
        <li class="profile-dropdown-list-item">
          <a href="../views/dashboard.php">
            <i class="fa-solid fa-chart-line"></i>
            Panel de Control
          </a>
        </li>
        <li class="profile-dropdown-list-item">
          <a href="../views/dashboarduser.php">
            <i class="fa-solid fa-folder-open"></i>
            Mis Anuncios
          </a>
        </li>
        <hr />
        <li class="profile-dropdown-list-item">
          <a href="../views/cerrar_sesion.php">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            Cerrar Sesion
          </a>
        </li>
      </ul>
    </div>
  <?php }else {?>
  <div class="profile-dropdown">
    <div class="profile-dropdown-btn" onclick="toggle()">
      <div class="profile-img">
        <img src="../assets/img_subidas/usuarios/<?php echo $_SESSION["foto_global"] ?>" alt="" />
      </div>
      <span>
        <?php echo $_SESSION["usuario_global"]; ?>
        <i-fa-solid class="fa-solid fa-angle-down"></i-fa-solid>
      </span>
    </div>
    <ul class="profile-dropdown-list">
      <li class="profile-dropdown-list-item">
        <a href="../views/miperfil.php">
          <i class="fa-regular fa-user"></i>
          Editar perfil
        </a>
      </li>
      <li class="profile-dropdown-list-item">
        <a href="dashboarduser.php">
          <i class="fa-solid fa-chart-line"></i>
          Mis Anuncios
        </a>
      </li>
      <hr />
      <li class="profile-dropdown-list-item">
        <a href="../views/cerrar_sesion.php">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          Cerrar Sesion
        </a>
      </li>
    </ul>
  </div>
    <?php } ?>
</header>

<nav id="nav-links">
  <ul>
    <a id="li-inicio" href="../public/index.php"><li class="li-text">Inicio</li></a>
    <a id="li-perfil" href="../views/anuncios_inicio.php"><li class="li-text">Anuncios</li></a>
    <a id="li-crear" href="../views/anadir_anuncio.php"><li class="li-text"><i class="fas fa-edit"></i> Añadir anuncio</li></a>
    <li id="li-buscador">
      <form id="buscador" action="../views/anuncios_inicio.php">
        <div class="group">
          <input type="search" name="buscador" id="busqueda" class="buscar-inicio" placeholder="Buscar anuncio..." />
          <button id="btnBuscar" name="btnBuscar" type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </li>
  </ul>
</nav>