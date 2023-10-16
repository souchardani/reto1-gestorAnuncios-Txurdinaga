<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <title>Anuncios</title>
    <!-- LIBRERÍA DE ICONOS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
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
                        <button id="buscar" type="submit"><img class="search-img" src="../assets/img/search.png"
                                alt=""></button>
                    </div>
                </form>
            </li>
        </ul>
    </nav>

    <div class="title-6">
        <h1 class="titulo">ANUNCIOS</h1>
    </div>

    <main class="main-6">
        <div class="columna-info flex">
            <div class="publicados flex">
                <div class="anun-info-text">
                    <h1>27</h1>
                    <p>Anuncios Publicados</p>
                </div>
                <div>
                    <img class="img-info" src="../assets/img/clipboard.png" alt="clipboard" />
                </div>
            </div>
            <div class="pendientes flex">
                <div class="anun-info-text">
                    <h1>14</h1>
                    <p>Anuncios Pendientes de Revision</p>
                </div>
                <div>
                    <img class="img-info" src="../assets/img/package.png" alt="clipboard" />
                </div>
            </div>
        </div>

        <h2>Deportes</h2>
        <div class="columnas-anuncios-2 flex">
            <div class="anuncio-2">
                <img class="img-anun" src="../assets/img/dates-icon.jpg" alt="" />
                <div class="anuncio-body-2 flex">
                    <div class="categoria-info-2 flex">
                        <i class="ph ph-stack"></i>
                        <span class="body-small-400">Texto Categoría</span>
                    </div>
                    <h3>Titulo del anuncio</h3>
                </div>
                <div class="anuncio-info-2 flex">
                    <div class="anuncio-lugar-2 flex">
                        <i class="ph ph-map-pin"></i>
                        <span class="anuncio-ubicacion-2"> Bilbao</span>
                    </div>
                    <span class="fecha-2">06/10/2023</span>
                </div>
            </div>

            <div class="anuncio-2">
                <img class="img-anun" src="../assets/img/dates-icon.jpg" alt="" />
                <div class="anuncio-body-2 flex">
                    <div class="categoria-info-2 flex">
                        <i class="ph ph-stack"></i>
                        <span class="body-small-400">Texto Categoría</span>
                    </div>
                    <h3>Titulo del anuncio</h3>
                </div>
                <div class="anuncio-info-2 flex">
                    <div class="anuncio-lugar-2 flex">
                        <i class="ph ph-map-pin"></i>
                        <span class="anuncio-ubicacion-2"> Bilbao</span>
                    </div>
                    <span class="fecha-2">06/10/2023</span>
                </div>
            </div>

            <div class="anuncio-2">
                <img class="img-anun" src="../assets/img/dates-icon.jpg" alt="" />
                <div class="anuncio-body-2 flex">
                    <div class="categoria-info-2 flex">
                        <i class="ph ph-stack"></i>
                        <span class="body-small-400">Texto Categoría</span>
                    </div>
                    <h3>Titulo del anuncio</h3>
                </div>
                <div class="anuncio-info-2 flex">
                    <div class="anuncio-lugar-2 flex">
                        <i class="ph ph-map-pin"></i>
                        <span class="anuncio-ubicacion-2"> Bilbao</span>
                    </div>
                    <span class="fecha-2">06/10/2023</span>
                </div>
            </div>

        </div>
        <h2>Música</h2>
        <div class="columnas-anuncios-2 flex">
            <div class="anuncio-2">
                <img class="img-anun" src="../assets/img/dates-icon.jpg" alt="" />
                <div class="anuncio-body-2 flex">
                    <div class="categoria-info-2 flex">
                        <i class="ph ph-stack"></i>
                        <span class="body-small-400">Texto Categoría</span>
                    </div>
                    <h3>Titulo del anuncio</h3>
                </div>
                <div class="anuncio-info-2 flex">
                    <div class="anuncio-lugar-2 flex">
                        <i class="ph ph-map-pin"></i>
                        <span class="anuncio-ubicacion-2"> Bilbao</span>
                    </div>
                    <span class="fecha-2">06/10/2023</span>
                </div>
            </div>

            <div class="anuncio-2">
                <img class="img-anun" src="../assets/img/dates-icon.jpg" alt="" />
                <div class="anuncio-body-2 flex">
                    <div class="categoria-info-2 flex">
                        <i class="ph ph-stack"></i>
                        <span class="body-small-400">Texto Categoría</span>
                    </div>
                    <h3>Titulo del anuncio</h3>
                </div>
                <div class="anuncio-info-2 flex">
                    <div class="anuncio-lugar-2 flex">
                        <i class="ph ph-map-pin"></i>
                        <span class="anuncio-ubicacion-2"> Bilbao</span>
                    </div>
                    <span class="fecha-2">06/10/2023</span>
                </div>
            </div>

            <div class="anuncio-2">
                <img class="img-anun" src="../assets/img/dates-icon.jpg" alt="" />
                <div class="anuncio-body-2 flex">
                    <div class="categoria-info-2 flex">
                        <i class="ph ph-stack"></i>
                        <span class="body-small-400">Texto Categoría</span>
                    </div>
                    <h3>Titulo del anuncio</h3>
                </div>
                <div class="anuncio-info-2 flex">
                    <div class="anuncio-lugar-2 flex">
                        <i class="ph ph-map-pin"></i>
                        <span class="anuncio-ubicacion-2"> Bilbao</span>
                    </div>
                    <span class="fecha-2">06/10/2023</span>
                </div>
            </div>

        </div>
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