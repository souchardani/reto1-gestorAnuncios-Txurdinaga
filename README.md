# Gestor de Anuncios - CIFP Txurdinaga

La aplicación de gestión de anuncios está diseñada para permitir a los estudiantes publicar anuncios y comentarios, mientras que los administradores pueden gestionarlos con facilidad, en la comunidad educativa del Centro Integrado de Formación Profesional (CIFP) Txurdinaga.

## Descripción

El Gestor de Anuncios del CIFP Txurdinaga es una aplicación web diseñada para permitir a los estudiantes publicar anuncios y comentarios relacionados con eventos, actividades, servicios, Noticias, Exámenes y más, dentro del entorno del centro educativo. Los administradores pueden supervisar y gestionar estos anuncios para mantener un entorno de comunicación efectivo y seguro.

## Características

- Registro de estudiantes y administradores con autenticación segura.
- Publicación de anuncios por parte de los estudiantes.
- Comentarios en los anuncios por parte de los estudiantes.
- Herramientas de moderación y gestión para los administradores.

## Tecnologías Utilizadas

- HTML5, CSS3, JavaScript, PHP
- Base de datos: MySQL
- Despliegue: AWS
- Otras herramientas: Figma.
  
## Testing y Usuarios de Prueba

- Se puede entrar al link publico a través del siguiente enlace: http://35.172.74.23/public/.
- Para probar toda la funcionalidad de la app como administrador, entrar con el siguiente usuario: {User: admin}, {Contraseña: admin123}
- Para probar la funcionalidad de la app como un usuario standard, entrar con el siguiente usuario: {User: Alumno}, {Contraseña: alumno}



## Instalación

1. Clona este repositorio en tu máquina local.
2. Configura la base de datos MySQL siguiendo los pasos del punto siguiente.
4. Ejecuta la pagina ../public/index.php desde tu servidor local.
5. La base de datos está configurada desde el servidor de Amazon AWS, y la aplicacion, aunque se instale y ejecute en local, funciona con esta base de datos. en caso de querer funcionar con la base de datos local, se deben seguir los pasos del siguiente punto.

## Configuración de la Base de Datos

1. Instala un paquete de servidor local como XAMPP, WAMPP, o MAMP que incluya MySQL.
2. Inicia el servidor local y asegúrate de que el servicio de MySQL esté en ejecución.
3. Abre el panel de control de MySQL y crea una nueva base de datos llamada `gestor_anuncios`.
4. Importa el archivo `gestor_anuncios.sql` que se encuentra en la carpeta `aws` del proyecto. Este archivo contiene la estructura de la base de datos necesaria para la aplicación.
5. modifica el archivo: reto1/assets/DB.php y cambia los datos de $hostDB="localhost", y usuario y password a tu caso concreto

## Uso

- Los estudiantes pueden registrarse, iniciar sesión y publicar anuncios.
- Los estudiantes pueden comentar en los anuncios.
- Los administradores pueden gestionar los anuncios y los comentarios.

## Contribución

Si deseas contribuir a este proyecto, sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una rama para tu función: `git checkout -b nueva-funcionalidad`
3. Realiza tus cambios y haz commit: `git commit -m 'Añade nueva funcionalidad'`
4. Envía tus cambios: `git push origin nueva-funcionalidad`
5. Abre una solicitud pull.

## Licencia

Este proyecto está bajo la Licencia MIT. Consulta https://es.wikipedia.org/wiki/Licencia_MIT para obtener más información.

## Contacto

Si tienes alguna pregunta o consulta, no dudes en contactar al equipo de desarrollo a través de éste repositorio.

---

¡Gracias por revisar este proyecto! Esperamos que sea de utilidad para el CIFP Txurdinaga y su comunidad. Si tienes alguna sugerencia o comentario, no dudes en hacérnoslo saber.
