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

// //funcion para comprobar si el username y password existen en la bbdd
// function inicio_sesion($usuario, $password){
//   global $ConexionDB;
//   $sql = "SELECT * FROM admins WHERE BINARY username=:usuario AND BINARY contrasena=:password LIMIT 1";
//   $Stmt = $ConexionDB -> prepare($sql);
//   $Stmt -> bindValue(":usuario", $usuario);
//   $Stmt -> bindValue(":password", $password);
//   $Stmt -> execute();
//   $resultado = $Stmt -> rowCount(); 
//   if($resultado == 1){
//     $fila = $Stmt->fetch();
//     $_SESSION["usuarioid_global"] = $fila["id"];
//     $_SESSION["usuario_global"] =  $fila["username"];
//     $_SESSION["usuarionombre_global"] =  $fila["nombre"];
//     $_SESSION["MensajeExito"] = "Bienvenido de nuevo ". $fila["username"];
//     if (isset($_SESSION["guardarURL"])) {
//       Redireccionar_A($_SESSION["guardarURL"]);
//     }else {
//       Redireccionar_A("detalles_anuncios.php");
//     }
//   }else {
//     $_SESSION["MensajeError"] = "El usuario o la contraseña son incorrectos";
//     Redireccionar_A("login.php");
//   }
// }
function inicio_sesion($usuario, $password){
  global $Conexionbbdd;
  $sql = "SELECT * FROM usuario WHERE BINARY Nick=:usuario AND BINARY Contraseña=:password LIMIT 1";
  $Stmt = $Conexionbbdd -> prepare($sql);
  $Stmt -> bindValue(":usuario", $usuario);
  $Stmt -> bindValue(":password", $password);
  $Stmt -> execute();
  $resultado = $Stmt -> rowCount(); 
  if($resultado == 1){
    $fila = $Stmt->fetch();
    $_SESSION["usuario_global"] =  $fila["Nick"];
    $_SESSION["usuarionombre_global"] =  $fila["Nombre"];
    $_SESSION["MensajeExito"] = "Bienvenido de nuevo ". $fila["username"];
    if (isset($_SESSION["guardarURL"])) {
      Redireccionar_A($_SESSION["guardarURL"]);
    }else {
      Redireccionar_A("detalles_anuncios.php");
    }
  }else {
    $_SESSION["MensajeError"] = "El usuario o la contraseña son incorrectos";
    Redireccionar_A("login.php");
  }
}



//funcion para verificar los campos del formulario que no esten empty
function verificar_empty($array){
  foreach ($array as $campo){
    if(empty($campo)){
      $_SESSION["MensajeError"] = "Todos los campos deben estar rellenados";
      Redireccionar_A("login.php");
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
  global $ConexionDB;
  $pagina = $_GET["pagina"];
  if($pagina == "" || $pagina == 0 || $pagina < 1){
    $desde = 1;
  }else {
    $desde = ($pagina*5)-5;
  }
  $sql = "select * from anuncios ORDER BY id desc LIMIT $desde, 5";
  $stmt = $ConexionDB -> query($sql);
  return $stmt;
}


//obtener la paginacion
function obtener_paginacion(){
  global $ConexionDB;
  $sql = "SELECT COUNT(*) FROM anuncios";
  $execute = $ConexionDB -> query($sql);
  $stmt = $execute -> fetch();
  $paginacion = $stmt[0];
  return $paginacion;
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
function insertar_anuncio_bbdd($fechaActual,$tituloAnuncio,$categoria,$Admin,$imagen,$descripcionAnuncio, $target){
    global $ConexionDB;
    $sql = "INSERT INTO anuncios(datetime, titulo, categoria, autor, imagen, descripcion) VALUES (:dateTime,:titulo,:categoria,:autor,:imagen,:descripcion)";
    $stmt = $ConexionDB -> prepare($sql);
    $stmt -> bindValue(":dateTime", $fechaActual);
    $stmt -> bindValue(":titulo", $tituloAnuncio);
    $stmt -> bindValue(":categoria", $categoria);
    $stmt -> bindValue(":autor", $Admin);
    $stmt -> bindValue(":imagen", $imagen);
    $stmt -> bindValue(":descripcion", $descripcionAnuncio);
    $execute = $stmt -> execute();
    if($execute){
       //guardar la imagen en la carpeta de imagenes
       move_uploaded_file($_FILES["imagen"]["tmp_name"], $target);
       $_SESSION["MensajeExito"] = "El Anuncio se ha añadido Correctamente";
       Redireccionar_A("anadir_anuncio.php");
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado al insertar, vuelve a intentarlo";
      Redireccionar_A("anadir_anuncio.php");
    }
}


//funcion para actualizar anuncio en la bbdd
function editar_anuncio_bbdd($tituloAnuncio, $categoria, $imagen, $descripcionAnuncio, $idAnuncio, $target){
  global $ConexionDB;
    //miramos si se añade la imagen, porque si no, dejamos la imagen anterior del anuncio
    if(!empty($imagen)){
      $sql = "UPDATE anuncios SET titulo='$tituloAnuncio', categoria='$categoria', imagen='$imagen', descripcion='$descripcionAnuncio' WHERE id='$idAnuncio'";  
    }
    $sql = "UPDATE anuncios SET titulo='$tituloAnuncio', categoria='$categoria', descripcion='$descripcionAnuncio' WHERE id='$idAnuncio'";
    $execute =$ConexionDB -> query($sql);
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
    global $ConexionDB;
    $busqueda = $_GET["buscador"];
    $busqueda = "%".$busqueda."%";
    $sql = "SELECT * from anuncios WHERE 
    datetime LIKE :busqueda 
    or titulo LIKE :busqueda 
    or categoria LIKE :busqueda 
    or autor LIKE :busqueda 
    or descripcion LIKE :busqueda";
    $stmt = $ConexionDB->prepare($sql);
    $stmt -> bindParam(":busqueda", $busqueda);
    $stmt -> execute();
    return $stmt;
}



//funcion para mostrar todos los anuncios
function mostrar_todos_anuncios(){
  global $ConexionDB;
  $sql = "SELECT * FROM anuncios ORDER BY id desc";
  $stmt = $ConexionDB->query($sql);
  return $stmt;
}


//funcion para mostrar los anuncios pasado por la url
function mostrar_anuncio_url($idAnuncio) {
  global $ConexionDB;
  $sql = "SELECT * FROM anuncios WHERE id=$idAnuncio";
  $stmt = $ConexionDB->query($sql);
  return $stmt;
}



//funcion para eliminar anuncio de la bbdd
function eliminar_anuncio_bbdd($idAnuncio, $imagen_ant){
  global $ConexionDB;
  $sql = "DELETE FROM anuncios WHERE id='$idAnuncio'";
  $execute =$ConexionDB -> query($sql);
  //si la insert se ha ejecutado correctamente
  if($execute){
    //para eliminar la imagen
    $ruta_eliminar_imagen = "img_subidas/$imagen_ant";
    unlink($ruta_eliminar_imagen);
    $_SESSION["MensajeExito"] = "El Anuncio se ha Eliminado Correctamente";
    Redireccionar_A("detalles_anuncios.php");
  }else {
    $_SESSION["MensajeError"] = "Ocurrio un error inesperado al eliminar, vuelve a intentarlo";
    Redireccionar_A("detalles_anuncios.php");
  }
}


function obtener_5_anuncios(){
    global $ConexionDB;
    $sql = "SELECT * FROM anuncios ORDER BY id desc LIMIT 0,5";
    $stmt = $ConexionDB->query($sql);
    return $stmt;
}


//------------------------------------------------------------------//
//------------------FUNCIONES PARA COMENTARIOS----------------------//
//------------------------------------------------------------------//




//funcion para verificar que los campos se han completado correctamente
function verificar_campos_comentario($nombre, $email, $cuerpo, $idAnuncio){
    if(empty($nombre) || empty($email) || empty($cuerpo)){
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
function insertar_comentario_bbdd($datetime, $nombre, $email, $cuerpo, $idAnuncio){
    global $ConexionDB;
    $sql = "INSERT INTO comentarios(datetime, nombre, email, cuerpo, aprobadopor, publicado, id_anuncio) VALUES (:datetime, :nombre, :email, :cuerpo, 'Pendiente', 'NO', :id_anuncio)";
    $stmt = $ConexionDB -> prepare($sql);
    $stmt -> bindValue(":datetime", $datetime);
    $stmt -> bindValue(":nombre", $nombre);
    $stmt -> bindValue(":email", $email);
    $stmt -> bindValue(":cuerpo", $cuerpo);
    $stmt -> bindValue(":id_anuncio", $idAnuncio);
    $execute = $stmt -> execute();
    if($execute){
      $_SESSION["MensajeExito"] = "El comentario se ha añadido Correctamente, espera a que sea aprobado por un administrador";
      Redireccionar_A("anuncio_completo.php?id=$idAnuncio");
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado, vuelve a intentarlo";
      Redireccionar_A("anuncio_completo.php?id=$idAnuncio");
    }
  }


  function obtener_comentario_poranuncio($idAnuncio){
    global $ConexionDB;
    $sql = "SELECT * FROM comentarios WHERE id_anuncio=$idAnuncio AND publicado='SI'";
    $stmt = $ConexionDB->query($sql);
    return $stmt;
  }


  function obtener_comentarios_noaprobados(){
    global $ConexionDB;
    $sql = "SELECT * FROM comentarios WHERE publicado='NO' ORDER BY id DESC";
    $execute = $ConexionDB->query($sql);
    return $execute;
  }

  function obtener_comentarios_noaprobados_porid($id){
    global $ConexionDB;
    $sql = "SELECT COUNT(*) FROM comentarios WHERE publicado='NO' AND id_anuncio=$id";
    $execute = $ConexionDB->query($sql);  
    $n_anuncios = $execute -> fetch();
    return $n_anuncios[0];
  }

  function obtener_comentarios_aprobados_porid($id){
    global $ConexionDB;
    $sql = "SELECT COUNT(*) FROM comentarios WHERE publicado='SI' AND id_anuncio=$id";
    $execute = $ConexionDB->query($sql);
    $n_anuncios = $execute -> fetch();
    return $n_anuncios[0];
  }

  function obtener_comentarios_aprobados(){
    global $ConexionDB;
    $sql = "SELECT * FROM comentarios WHERE publicado='SI' ORDER BY id DESC";
    $execute = $ConexionDB->query($sql);
    return $execute;
  }



//------------------------------------------------------------------//
//------------------FUNCIONES PARA USUARIOS-------------------------//
//------------------------------------------------------------------//
//funcion para validar los datos del administrador
function validar_data_admin($username, $contrasena, $confirmar_contrasena) {
  if(empty($username) || empty($contrasena) || empty($confirmar_contrasena)){
    $_SESSION["MensajeError"] = "Debes Completar todos los campos";
    Redireccionar_A("admins.php");
  }else if(strlen($contrasena)<=4){
    $_SESSION["MensajeError"] = "La contraseña debe tener mas de 4 caracteres";
    Redireccionar_A("admins.php");
  }else if($contrasena !== $confirmar_contrasena){
    $_SESSION["MensajeError"] = "Las contraseñas no coinciden";
    Redireccionar_A("admins.php");
  }else {
    return true;
  }
}


//funcion para verificar la existencia del administrador
function verificar_existencia_admin($username) {
  global $ConexionDB;
  $sql = "SELECT * FROM admins WHERE username=:username";
  $stmt = $ConexionDB -> prepare($sql);
  $stmt -> bindParam(":username", $username);
  $stmt -> execute();
  $resultado = $stmt -> rowCount();
  if($resultado == 1){
    $_SESSION["MensajeError"] = "El nombre de usuario ya existe, prueba con otro";
    Redireccionar_A("admins.php");
    return false;
  }else {
    return true;
  }
}

//funcion para insertar administrador en la bbdd
function insertar_admin_bbdd($fechaActual, $username, $contrasena, $nombre, $Admin){
    global $ConexionDB;
    $sql = "INSERT INTO admins(datetime, username, contrasena, admin_name, creador) VALUES (:dateTime, :username, :contrasena, :admin_name, :creador)";
    $stmt = $ConexionDB -> prepare($sql);
    $stmt -> bindValue(':datetime', $fechaActual);
    $stmt -> bindValue(':username', $username);
    $stmt -> bindValue(':contrasena', $contrasena);
    $stmt -> bindValue(':admin_name', $nombre);
    $stmt -> bindValue(':creador', $Admin);
    $execute = $stmt -> execute();
    if($execute){
      $_SESSION["MensajeExito"] = "El Administrador $username se ha añadido Correctamente";
      Redireccionar_A("admins.php");
    }else {
      $_SESSION["MensajeError"] = "Ocurrio un error inesperado al insertar, vuelve a intentarlo";
      Redireccionar_A("admins.php");
    }
  }


  //funcion para obtener todos los admins
  function obtener_administradores(){
    global $Conexionbbdd;
    $sql = "SELECT * FROM usuario WHERE rol='Administrador' ORDER BY Nick desc";
    $stmt = $Conexionbbdd -> query($sql);
    return $stmt;
  }

  //funcion para obtener un admin por el id
  function obtener_admin_id($userid){
    global $ConexionDB;
    $sql = "SELECT * FROM admins WHERE id=:id";
    $stmt = $ConexionDB -> prepare($sql);
    $stmt -> bindParam(":id", $userid);
    $stmt -> execute();
    return $stmt;
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


function insertar_categoria_bbdd($categoria, $Admin, $fechaActual){
  global $ConexionDB;
    $sql = "INSERT INTO categorias(titulo, autor, datetime) VALUES (:tituloCategoria, :nombreAdmin, :dateTime)";
    $stmt = $ConexionDB -> prepare($sql);
    $stmt -> bindValue(":tituloCategoria", $categoria);
    $stmt -> bindValue(":nombreAdmin", $Admin);
    $stmt -> bindValue(":dateTime", $fechaActual);
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
  global $ConexionDB;
  $sql = "SELECT * FROM categorias";
  $stmt = $ConexionDB -> query($sql);
  return $stmt;
}


function mostrar_anuncios_categoria() {
  global $ConexionDB;
  $sql = "SELECT * FROM anuncios WHERE categoria=:categoria";
  $stmt = $ConexionDB -> prepare($sql);
  $stmt -> bindParam(":categoria", $_GET["categoria"]);
  $stmt -> execute();
  return $stmt;
}

?>


