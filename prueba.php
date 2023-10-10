<header class="flex-space-between-row">
    <div>
        <a href="index.php">
            <picture>
                <source srcset="assets/img/logo txurdinaga principal.png" media="(max-width: 40em)">
                <img src="assets/img/LogoTX_large.png" alt="Logo IGKluba">
            </picture>
        </a>
    </div>



    <div id="header-perfil">
        <a href="/profila">
            <img src="<?php echo $rutaImagen ?>" alt="Foto perfil" class="foto-perfil">
        </a>
    </div>
</header>

<nav id="nav-general">
    <ul class="flex-center-row">
        <li><a href="/nagusia">Inicio</a></li>
        <li><a href="/profila">Perfil</a></li>
        <li><a href="/liburua-igo">Crear anuncio</a></li>
        <li>
            <form id="buscador" action="/bilaketa" method="POST" class="flex-center-row">
                <input id="busqueda" type="search" name="busqueda" placeholder="Bilatu liburua..." value="">
                <button id="buscar" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </li>
    </ul>
</nav>