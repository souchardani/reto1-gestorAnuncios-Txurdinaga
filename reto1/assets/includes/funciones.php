<?php
//inclumos la conexion a la bbdd
require_once("DB.php");


//------------------------------------------------------------------//
//------------------FUNCIONES GLOBALES------------------------------//
//------------------------------------------------------------------//

//funcion para redireccionar a la paginas que queramos
function Redireccionar_A($ubicacion){
  header("location:".$ubicacion);
  exit;
}

//funcion compronbar si la variable de la url esta vacia
function comprobar_variable_url($variable_url, $ubicacion){
  if(!isset($_GET[$variable_url]) || empty($_GET[$variable_url])){
      $_SESSION["MensajeError"] = "Error en la peticion! Vuelve a intentarlo (no se ha pasado ningun parametro)";
      Redireccionar_A($ubicacion);
  }else {
      return true;
  }
}


function inicio_sesion($usuario, $password){
  global $Conexionbbdd;
  $sql = "SELECT * FROM usuario WHERE BINARY Nick=:usuario AND BINARY Contraseña=:password and Activo=1 LIMIT 1";
  $Stmt = $Conexionbbdd -> prepare($sql);
  $Stmt -> bindValue(":usuario", $usuario);
  $Stmt -> bindValue(":password", $password);
  $Stmt -> execute();
  $resultado = $Stmt -> rowCount(); 
  if($resultado == 1){
    $fila = $Stmt->fetch();
    $_SESSION["usuario_global"] =  $fila["Nick"];
    $_SESSION["usuarionombre_global"] =  $fila["Nombre"];
    $_SESSION["tipoUsuario_global"] =  $fila["Rol"];
    $_SESSION["usuarioapellido_global"] =  $fila["Apellido"];
    $_SESSION["foto_global"] =  $fila["Imagen"];
    $_SESSION["MensajeExito"] = "Bienvenid@ de nuevo ". $fila["Nick"];
    if ($fila["Rol"] == "Administrador") {
      if (isset($_SESSION["guardarURL"])) {
        Redireccionar_A($_SESSION["guardarURL"]);
      }else {
        Redireccionar_A("dashboard.php");
      }
      //si es un usuario normal
    }else {
      Redireccionar_A("dashboarduser.php");
    }
  }else {
    $_SESSION["MensajeError"] = "El usuario o la contraseña son incorrectos";
    Redireccionar_A("login.php");
  }
}



//funcion para verificar los campos del formulario que no esten empty
function verificar_empty($array, $ubicacion){
  foreach ($array as $campo){
    if(empty($campo)){
      $_SESSION["MensajeError"] = "Todos los campos deben estar rellenados";
      Redireccionar_A($ubicacion);
    }
  }
  return true;
}

//funcion para verificar si el usuario esta logueado
function confirmar_login() {
  if(isset($_SESSION["usuario_global"])){
    return true;
  }else {
    $_SESSION["MensajeError"] = "Debes iniciar sesion para acceder a esta pagina";
    Redireccionar_A("login.php");
  }
}


function obtener_datos_dashboard(){
  global $Conexionbbdd;
  //anuncios
  $sql = "SELECT COUNT(*) FROM anuncio";
  $stmt = $Conexionbbdd -> query($sql); 
  $anuncios = $stmt -> fetch();
  //categorias
  $sql = "SELECT COUNT(*) FROM categoria";
  $stmt = $Conexionbbdd -> query($sql);
  $categorias = $stmt -> fetch();
  //admins
  $sql = "SELECT COUNT(*) FROM usuario";
  $stmt = $Conexionbbdd -> query($sql);
  $admins = $stmt -> fetch();
  //comentarios
  $sql = "SELECT COUNT(*) FROM comentario";
  $stmt = $Conexionbbdd -> query($sql);
  $comentarios = $stmt -> fetch();
  //array con los datos
  $datos = array(
    "anuncios" => $anuncios[0],
    "categorias" => $categorias[0],
    "admins" => $admins[0],
    "comentarios" => $comentarios[0]
  );
  return $datos;
}





//------------------------------------------------------------------//
//----------------------------PAGINACION----------------------------//
//------------------------------------------------------------------//

function mostrar_anuncios_paginacion(){
  global $Conexionbbdd;
  $pagina = $_GET["pagina"];
  if($pagina == "" || $pagina == 0 || $pagina < 1){
    $desde = 1;
  }else {
    $desde = ($pagina*5)-5;
  }
  $sql = "select * from anuncio ORDER BY id desc LIMIT $desde, 5";
  $stmt = $Conexionbbdd -> query($sql);
  return $stmt;
}


//obtener la paginacion
function obtener_paginacion(){
  global $Conexionbbdd;
  $sql = "SELECT COUNT(*) FROM anuncio";
  $execute = $Conexionbbdd -> query($sql);
  $stmt = $execute -> fetch();
  $paginacion = $stmt[0];
  return $paginacion;
}

function obtener_validaciones_pendientes() {
  global $Conexionbbdd;
  $sql = "SELECT COUNT(*) FROM comentario WHERE Validado=0";
  $comentarios = $Conexionbbdd -> query($sql);
  $comentarios = $comentarios -> fetch();

  $validaciones = array("comentarios" => $comentarios[0]);
  $sql = "SELECT COUNT(*) FROM anuncio WHERE Aceptado=0";
  $anuncios = $Conexionbbdd -> query($sql);
  $anuncios = $anuncios -> fetch();
  $validaciones["anuncios"] = $anuncios[0];
  $sql = "SELECT COUNT(*) FROM usuario WHERE Activo=0";
  $usuarios = $Conexionbbdd -> query($sql);
  $usuario = $usuarios -> fetch();
  $validaciones["usuarios"] = $usuario[0];
  return $validaciones;
}
              




//------------------------------------------------------------------//
//------------------FUNCIONES PARA ANUNCIOS-------------------------//
//------------------------------------------------------------------//

//funcion para validar los datos del anuncio
function validar_data_anuncio($tituloAnuncio, $descripcionAnuncio){
    if(empty($tituloAnuncio)){
        $_SESSION["MensajeError"] = "El titulo no puede estar vacio";
        Redireccionar_A("anadir_anuncio.php");
        return false;
      }else if(strlen($tituloAnuncio)<5){
        $_SESSION["MensajeError"] = "El titulo debe tener mas de 5 caracteres";
        Redireccionar_A("anadir_anuncio.php");
        return false;
      }else if(strlen($descripcionAnuncio)>4999){
        $_SESSION["MensajeError"] = "El contenido del anuncio no puede tener mas de 1000 caracteres";
        Redireccionar_A("anadir_anuncio.php");
        return false;
        //en caso de pasar el proceso de validaciones
      }else {
        return true;
      }
}
//funcion para insertar anuncio a la bbdd
function insertar_anuncio_bbdd($tituloAnuncio, $Autor, $Aceptado, $Fecha_publi, $categoria, $descripcionAnuncio, $imagen, $UbicacionImagen){
    global $Conexionbbdd;
    $sql = "INSERT INTO anuncio(Título, Autor, Aceptado, Fecha_Publi, Descripción, Imagen) VALUES (:Titulo,:Autor,:Aceptado,:Fecha_Publi,:Descripcion,:Imagen)";
    $stmt = $Conexionbbdd -> prepare($sql);
    $stmt -> bindValue(":Titulo", $tituloAnuncio);
    $stmt -> bindValue(":Autor", $Autor);
    $stmt -> bindValue(":Aceptado", $Aceptado);
    $stmt -> bindValue(":Fecha_Publi", $Fecha_publi);
    $stmt -> bindValue(":Descripcion", $descripcionAnuncio);
    $stmt -> bindValue(":Imagen", $imagen);
    $execute = $stmt -> execute();
    if($execute){
      //insertar en la tabla categoria anuncio
      insertar_categoria_poranuncio($categoria);
      //guardar la imagen en la carpeta de imagenes
       move_uploaded_file($_FILES["imagen"]["tmp_name"], $UbicacionImagen);
       if ($Aceptado == 1) {
        $_SESSION["MensajeExito"] = "El Anuncio se ha añadido Correctamente, y ha sido validado";
       }else {
        $_SESSION["MensajeExito"] = "El Anuncio se ha añadido Correctamente, Espera a que sea validado por un administrador";
       }
       Redireccionar_A("anadir_anuncio.php");
      
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado al insertar, vuelve a intentarlo";
      Redireccionar_A("anadir_anuncio.php");
    }
}


function insertar_categoria_poranuncio($categoria){
  //obtener el anuncio mayor de la bbdd;
  $idMayor = obtener_anuncio_mayor();
  global $Conexionbbdd;
  $sql = "INSERT INTO categoria_anuncio(Categoria, Anuncio) VALUES (:Categoria, :Anuncio)";
  $stmt = $Conexionbbdd -> prepare($sql);
  $stmt -> bindValue(":Categoria", $categoria);
  $stmt -> bindValue(":Anuncio", $idMayor);
  $execute = $stmt -> execute();
  return $execute;
}

function obtener_anuncio_mayor(){
  global $Conexionbbdd;
  $sql = "SELECT id from anuncio ORDER BY id DESC LIMIT 1;";
  $stmt = $Conexionbbdd -> query($sql);
  $idMayor = $stmt -> fetch();
  return $idMayor[0];
}


//funcion para actualizar anuncio en la bbdd
function editar_anuncio_bbdd($tituloAnuncio, $categoria, $imagen, $descripcionAnuncio, $idAnuncio, $target){
  global $Conexionbbdd;
    //miramos si se añade la imagen, porque si no, dejamos la imagen anterior del anuncio
    if(!empty($imagen)){
      $sql = "UPDATE anuncio SET Título='$tituloAnuncio', Imagen='$imagen', Descripción='$descripcionAnuncio' WHERE id='$idAnuncio'";  
    }else {
      $sql = "UPDATE anuncio SET Título='$tituloAnuncio' , Descripción='$descripcionAnuncio' WHERE id='$idAnuncio'";
    }
    $execute =$Conexionbbdd -> query($sql);
    //guardar la imagen en la carpeta de imagenes
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $target);

    //si la insert se ha ejecutado correctamente
    if($execute){
      $_SESSION["MensajeExito"] = "El Anuncio se ha editado Correctamente";
      Redireccionar_A("detalles_anuncios.php");
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado, vuelve a intentarlo";
      Redireccionar_A("detalles_anuncios.php");
    }
}

//funcion para mostrar los anuncios por el boton de busqueda de inicio
function mostrar_anuncios_busqueda(){
    global $Conexionbbdd;
    $busqueda = $_GET["buscador"];
    $busqueda = "%".$busqueda."%";
    $sql = "SELECT * from anuncio WHERE 
    (Título LIKE :busqueda 
    or Autor LIKE :busqueda 
    or Fecha_publi LIKE :busqueda 
    or Descripción LIKE :busqueda) AND Aceptado=1";
    $stmt = $Conexionbbdd->prepare($sql);
    $stmt -> bindParam(":busqueda", $busqueda);
    $stmt -> execute();
    return $stmt;
}



//funcion para mostrar todos los anuncios
function mostrar_todos_anuncios(){
  global $Conexionbbdd;
  $sql = "SELECT * FROM anuncio WHERE Aceptado=1 ORDER BY id desc";
  $stmt = $Conexionbbdd->query($sql);
  return $stmt;
}


function mostrar_3_anuncios() {
  global $Conexionbbdd;
  $sql = "SELECT * FROM anuncio WHERE Aceptado=1 ORDER BY id desc LIMIT 0,3";
  $stmt = $Conexionbbdd->query($sql);
  return $stmt;
}

function mostrar_todos_anuncios_novalidado() {
  global $Conexionbbdd;
  $sql = "SELECT * FROM anuncio WHERE Aceptado=0 ORDER BY id desc";
  $stmt = $Conexionbbdd->query($sql);
  return $stmt;
}



//funcion para mostrar los anuncios pasado por la url
function mostrar_anuncio_url($idAnuncio) {
  global $Conexionbbdd;
  $sql = "SELECT * FROM anuncio WHERE id=$idAnuncio";
  $stmt = $Conexionbbdd->query($sql);
  return $stmt;
}


//funcion para obtener los anuncios por cada usuario
function obtener_anuncios_poruser() {
  global $Conexionbbdd;
  $sql = "SELECT * FROM anuncio WHERE Autor=:Autor ORDER BY id desc";
  $stmt = $Conexionbbdd->prepare($sql);
  $stmt -> bindParam(":Autor", $_SESSION["usuario_global"]);
  $stmt -> execute();
  return $stmt;
}



//funcion para eliminar anuncio de la bbdd
function eliminar_anuncio_bbdd($idAnuncio, $imagen_ant){
  //primero eliminamos anuncios de la tabla catgoria_anuncio
  eliminar_categoria_anuncio($idAnuncio);
  //eliminamos los comentarios del anuncio
  eliminar_comentarios_anuncio($idAnuncio);
  global $Conexionbbdd;
  $sql = "DELETE FROM anuncio WHERE id='$idAnuncio'";
  $execute =$Conexionbbdd -> query($sql);
  //si la insert se ha ejecutado correctamente
  if($execute){
    //para eliminar la imagen
    $ruta_eliminar_imagen = "img_subidas/anuncios/$imagen_ant";
    unlink($ruta_eliminar_imagen);
    return true;
  }else {
    return false;
  }
}

function eliminar_comentarios_usuario($nick){
  global $Conexionbbdd;
  $sql = "DELETE FROM comentario WHERE Autor='$nick'";
  $execute =$Conexionbbdd -> query($sql);
  echo "comentarios eliminados";
  return $execute;
}


function eliminar_comentarios_anuncio($idAnuncio) {
  global $Conexionbbdd;
  $sql = "DELETE FROM comentario WHERE Anuncio='$idAnuncio'";
  $execute =$Conexionbbdd -> query($sql);
  return $execute;
}


function eliminar_categoria_anuncio($idAnuncio) {
  global $Conexionbbdd;
  $sql = "DELETE FROM categoria_anuncio WHERE Anuncio='$idAnuncio'";
  $execute =$Conexionbbdd -> query($sql);
  return $execute;
}


function obtener_5_anuncios(){
    global $Conexionbbdd;
    $sql = "SELECT * FROM anuncio WHERE Aceptado=1 ORDER BY id desc LIMIT 0,5";
    $stmt = $Conexionbbdd->query($sql);
    return $stmt;
}


//------------------------------------------------------------------//
//------------------FUNCIONES PARA COMENTARIOS----------------------//
//------------------------------------------------------------------//



//Recogida de los datos que tenemos en la base de datos de los campos

//funcion para verificar que los campos de mi perfil han sido completados correctamente
function validar_Miperfil($nombre,$apellido,$imagen){
  if(empty($nombre) || empty($apellido)){
    $_SESSION["MensajeError"] = "Debes de completar todos los campos";
    Redireccionar_A("miperfil.php?id='". $_SESSION['usuario_global'] ."'");
  }else if(strlen($nombre)<=3){
    $_SESSION["MensajeError"] = "Tu nombre debe tener mas de 3 caracteres";
    Redireccionar_A("miperfil.php?id=$nombre");
  }else if(strlen($apellido)<=3){
    $_SESSION["MensajeError"] = "Tu apellido debe tener mas de 3 caracteres";
    Redireccionar_A("miperfil.php?id=$nombre");
  }else {
   return true;
}
  
}
//funcion para verificar que los campos se han completado correctamente
function verificar_campos_comentario($nombre, $cuerpo, $idAnuncio){
    if(empty($nombre)  || empty($cuerpo)){
      $_SESSION["MensajeError"] = "Debes Completar todos los campos";
      Redireccionar_A("anuncio_completo.php?id=$idAnuncio");
    }else if(strlen($nombre)<=3){
      $_SESSION["MensajeError"] = "Tu nombre debe tener mas de 3 caracteres";
      Redireccionar_A("anuncio_completo.php?id=$idAnuncio");
    }else if(strlen($cuerpo)>499){
      $_SESSION["MensajeError"] = "El comentario debe tener menos de 50 caracteres";
      Redireccionar_A("anuncio_completo.php?id=$idAnuncio");
    }else {
      return true;
    }
}
//funcion para insertar comentario a la bbdd
function insertar_comentario_bbdd($nombre, $cuerpo,$validado, $idAnuncio){
    global $Conexionbbdd;
    $sql = "INSERT INTO comentario(Autor, Anuncio, Texto, Validado) VALUES (:Autor, :Anuncio, :Texto, :Validado)";
    $stmt = $Conexionbbdd -> prepare($sql);
    $stmt -> bindValue(":Autor", $nombre);
    $stmt -> bindValue(":Anuncio", $idAnuncio);
    $stmt -> bindValue(":Texto", $cuerpo);
    $stmt -> bindValue(":Validado", $validado);
    $execute = $stmt -> execute();
    if($execute){
      if ($validado == 1) {
        $_SESSION["MensajeExito"] = "El comentario se ha añadido Correctamente, y ha sido validado";
        Redireccionar_A("anuncio_completo.php?id=$idAnuncio");
      }else {
        $_SESSION["MensajeExito"] = "El comentario se ha añadido Correctamente, Espera a que sea validado por un administrador";
        Redireccionar_A("anuncio_completo.php?id=$idAnuncio");

      }
      
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado, vuelve a intentarlo";
      Redireccionar_A("anuncio_completo.php?id=$idAnuncio");
    }
  }


  function obtener_comentario_poranuncio($idAnuncio){
    global $Conexionbbdd;
    $sql = "SELECT * FROM comentario WHERE Anuncio=$idAnuncio AND Validado=1";
    $stmt = $Conexionbbdd->query($sql);
    return $stmt;
  }


  function obtener_comentarios_noaprobados(){
    global $Conexionbbdd;
    $sql = "SELECT * FROM comentario WHERE Validado=0 ORDER BY id DESC";
    $execute = $Conexionbbdd->query($sql);
    return $execute;
  }

  function obtener_comentarios_noaprobados_porid($id){
    global $Conexionbbdd;
    $sql = "SELECT COUNT(*) FROM comentario WHERE Validado=0 AND Anuncio=$id";
    $execute = $Conexionbbdd->query($sql);  
    $n_anuncios = $execute -> fetch();
    return $n_anuncios[0];
  }

  function obtener_comentarios_aprobados_porid($id){
    global $Conexionbbdd;
    $sql = "SELECT COUNT(*) FROM comentario WHERE Validado=1 AND Anuncio=$id";
    $execute = $Conexionbbdd->query($sql);
    $n_anuncios = $execute -> fetch();
    return $n_anuncios[0];
  }

  function obtener_comentarios_aprobados(){
    global $Conexionbbdd;
    $sql = "SELECT * FROM comentario WHERE Validado=1 ORDER BY id DESC";
    $execute = $Conexionbbdd->query($sql);
    return $execute;
  }



//------------------------------------------------------------------//
//------------------FUNCIONES PARA USUARIOS-------------------------//
//------------------------------------------------------------------//
//funcion para validar los datos del administrador
function validar_data_user($username, $contrasena, $confirmar_contrasena, $ubicacion) {
  if(empty($username) || empty($contrasena) || empty($confirmar_contrasena)){
    $_SESSION["MensajeError"] = "Debes Completar todos los campos";
    Redireccionar_A($ubicacion);
  }else if(strlen($contrasena)<=4){
    $_SESSION["MensajeError"] = "La contraseña debe tener mas de 4 caracteres";
    Redireccionar_A($ubicacion);
  }else if($contrasena !== $confirmar_contrasena){
    $_SESSION["MensajeError"] = "Las contraseñas no coinciden";
    Redireccionar_A($ubicacion);
  }else {
    return true;
  }
}


//funcion para verificar la existencia del administrador
function verificar_existencia_user($username) {
  global $Conexionbbdd;
  $sql = "SELECT * FROM usuario WHERE Nick=:Nick";
  $stmt = $Conexionbbdd -> prepare($sql);
  $stmt -> bindParam(":Nick", $username);
  $stmt -> execute();
  $resultado = $stmt -> rowCount();
  if($resultado == 1){
    $_SESSION["MensajeError"] = "El nombre de usuario ya existe, prueba con otro";
    Redireccionar_A("users.php");
    return false;
  }else {
    return true;
  }
}

//funcion para insertar administrador en la bbdd
function insertar_user_bbdd($username,$nombre, $apellido,$rol,$correo,$clase, $nacimiento, $contrasena, $activo){
    global $Conexionbbdd;
    $sql = "INSERT INTO usuario(Nick, Nombre, Apellido, Rol, Activo, Contraseña, Correo, Fecha_naci, Clase, Imagen) VALUES (:Nick, :Nombre, :Apellido, :Rol, :Activo, :Constrasena, :Correo, :Fecha_naci, :Clase, :Imagen)";
    $stmt = $Conexionbbdd -> prepare($sql);
    $stmt -> bindValue(":Nick", $username);
    $stmt -> bindValue(":Nombre", $nombre);
    $stmt -> bindValue(":Apellido", $apellido);
    $stmt -> bindValue(":Rol", $rol);
    $stmt -> bindValue(":Activo", $activo);
    $stmt -> bindValue(":Constrasena", $contrasena);
    $stmt -> bindValue(":Correo", $correo);
    $stmt -> bindValue(":Fecha_naci", $nacimiento);
    $stmt -> bindValue(":Clase", $clase);
    $stmt -> bindValue(":Imagen", "avatar.png");
    $execute = $stmt -> execute();
    return $execute;
  }


  //funcion para obtener todos los users validados
  function obtener_usuarios_validados(){
    global $Conexionbbdd;
    $sql = "SELECT * FROM usuario WHERE Activo=1 ORDER BY Nick desc";
    $stmt = $Conexionbbdd -> query($sql);
    return $stmt;
  }

  function obtener_usuarios_novalidados() {
    global $Conexionbbdd;
    $sql = "SELECT * FROM usuario WHERE Activo=0 ORDER BY Nick desc";
    $stmt = $Conexionbbdd -> query($sql);
    return $stmt;
  }




  //funcion para confirmar si un usuario es administrador
  function confirmar_admin() {
    global $Conexionbbdd;
    $sql = "SELECT * FROM usuario WHERE Nick=:Nick AND Rol=:Rol";
    $stmt = $Conexionbbdd -> prepare($sql);
    $admin = "Administrador";
    $stmt -> bindParam(":Nick", $_SESSION["usuario_global"]);
    $stmt -> bindParam(":Rol", $admin);
    $stmt -> execute();
    $resultado = $stmt -> rowCount();
    if($resultado == 0){
      $_SESSION["MensajeError"] = "Debes ser administrador para poder acceder a esta pagina";
      Redireccionar_A("anuncios_inicio.php");
    }else {
      return;
    }
  }




  function eliminar_dependencias_user($nick) {
    global $Conexionbbdd;
    $sql = "select id from anuncio where Autor='$nick'";
    $execute =$Conexionbbdd -> query($sql);
    while($fila = $execute -> fetch()){
      $id = $fila["id"];
      $imagen = $fila["Imagen"];
      eliminar_anuncio_bbdd($id, $imagen);
    }
    eliminar_comentarios_usuario($nick);
  }
//------------------------------------------------------------------//
//------------------FUNCIONES PARA CATEGORIAS-----------------------//
//------------------------------------------------------------------//


function comprobar_campos_categorias($categoria){
  if(empty($categoria)){
    $_SESSION["MensajeError"] = "Debes Completar todos los campos";
    Redireccionar_A("categorias.php");
  }else if(strlen($categoria)<=3){
    $_SESSION["MensajeError"] = "El titulo de la categoria debe tener mas de 3 caracteres";
    Redireccionar_A("categorias.php");
  }else if(strlen($categoria)>49){
    $_SESSION["MensajeError"] = "El titulo de la categoria debe tener menos de 50 caracteres";
    Redireccionar_A("categorias.php");
  }else {
    return true;
  }
}


function insertar_categoria_bbdd($categoria){
  global $Conexionbbdd;
    $sql = "INSERT INTO categoria(Nombre) VALUES (:tituloCategoria)";
    $stmt = $Conexionbbdd -> prepare($sql);
    $stmt -> bindValue(":tituloCategoria", $categoria);
    $execute = $stmt -> execute();
    if($execute){
      $_SESSION["MensajeExito"] = "La categoria se ha añadido Correctamente";
      Redireccionar_A("categorias.php");
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado, vuelve a intentarlo";
      Redireccionar_A("categorias.php");
    }
}

function obtener_categorias(){
  global $Conexionbbdd;
  $sql = "SELECT * FROM categoria";
  $stmt = $Conexionbbdd -> query($sql);
  return $stmt;
}

//obtener categoria por id anuncio
function obtener_categoria_porid($id) {
  global $Conexionbbdd;
  $sql = "SELECT categoria from categoria_anuncio where Anuncio=$id";
  $stmt = $Conexionbbdd -> query($sql);
  $categoria = $stmt -> fetch();
  return $categoria[0];
}


function mostrar_anuncios_categoria() {
  global $Conexionbbdd;
  $categoria = $_GET["categoria"];
  if ($categoria == "Todos") {
    $sql = "SELECT * FROM anuncio WHERE Aceptado=1 ORDER BY id desc";
    $stmt = $Conexionbbdd -> query($sql);
  }else {
    $sql = "SELECT * FROM anuncio join categoria_anuncio ON anuncio.id = categoria_anuncio.Anuncio WHERE categoria_anuncio.categoria = :categoria";
    $stmt = $Conexionbbdd -> prepare($sql);
    $stmt -> bindParam(":categoria", $_GET["categoria"]);
  }
  $stmt -> execute();
  return $stmt;
}


function obtener_email($nick){
  global $Conexionbbdd;
  $sql = "SELECT Correo FROM usuario WHERE Nick='$nick'";
  $stmt = $Conexionbbdd -> query($sql);
  $email = $stmt -> fetch();
  return $email[0];
}



function obtener_clase(){
  global $Conexionbbdd;
  $sql = "SELECT * FROM clase";
  $stmt = $Conexionbbdd -> query($sql);
  return $stmt;
}


function obtener_clase_pornick($user){
  global $Conexionbbdd;
  $sql = "SELECT Clase FROM usuario where Nick='$user'";
  $stmt = $Conexionbbdd -> query($sql);
  return $stmt;
}

function obtener_clase_por_nick($user){
  global $Conexionbbdd;
  $sql = "SELECT Clase FROM usuario WHERE Nick='$user'";
  $stmt = $Conexionbbdd -> query($sql);
  $clase = $stmt -> fetch();
  var_dump($clase);
  return $clase[0];
}

?>


