## 2026-03-10 - Plantilla de errores

- Sintoma: 
- Causa raiz: 
- Fix:
  - 
- Archivos:
  - 
- Commit: ``

## 2026-03-10 - Usuario create no guardaba

- Sintoma: click en guardar no creaba usuario.
- Causa raiz: radios de perfil sin `value`, `switch` devolvía `null`.
- Fix:
  - Se agregaron `value` en `create.php` (`administrador|operador|externo`).
  - Se completó payload con `estado` y `resetPassword`.
  - Se evitó llamar `save` cuando el payload es `null`.
- Archivos:
  - app/resources/views/usuario/create.php
  - public/app/js/usuarios/controller.js
  - public/app/js/usuarios/create.js
- Commit: `abc1234`

## 2026-03-12 - Usuario edit no funcionaba correctamente

- Sintoma: click en resetar formulario recargaba incorrectamente el usuario
- Causa raiz: Estaba usando URLParams windows.location.search para capaturar el id
  lo cual no funcionaba porque la url no indicaba qué parte de la misma era el id
- Fix:
  - Se utilizó `window.location.pathname.split` para dividr en un array la URL
- Archivos:
  - public/app/js/usuarios/controller.js
- Commit: `abc1234`

## 2026-03-18 - index.js:1 GET http://localhost/lab_prog_final_rasjido_daniel/public/app/js/entradas/controller net::ERR_ABORTED 404 (Not Found)

- Sintoma: Index.js no se ejecutaba correctamente
- Causa raiz: Habia olvidado escribir la extensión .js en entradasController, error tonto
- Fix:
  - Extensión .js al objeto entradasController importado en index.js añadida
- Archivos:
  - public/app/js/entradas/index.js
- Commit: ``

## 2026-03-18 - EntradasController no listaba

- Sintoma: no se podia listar correctamente el modulo de entradas
- Causa raiz: La consulta SQL de list carga la tabla incorrecta, usaba la tabla comentarois ya que habia copiado
  y pegado del modulo anterior
- Fix:
  - cambiar "comentarios" por this->table
- Archivos:
  - EntradasDAO
- Commit: ``

## 2026-03-28 - No funciona list() del modulo de peliculas

- Sintoma: peliculasController.list() no funciona, del método auxiliar para imprimir los datos solo se 
ejecuta una parte, se muestran console.logs() pero el bucle que imprime los datos no funciona
- Causa raiz: en el controller estaba listando peliculasService.list(), pero este método no devuelve un array de datos, devuelve una promesa
- Fix:
  - Modificar el controler para manejar la promesa
- Archivos:
  - public/app/js/peliculas/controller.js
- Commit: ``

## 2026-03-28 - No funciona el botón "ingresar pelicula" del modulo peliculas

- Sintoma: No se puede entrar a la sección create, queda la pantalla en blanco
- Causa raiz: habia olvidado implementar el metodo create en peliculasController
- Fix:
  - Modificar el controler para manejar la promesa
- Archivos:
  - app/core/controller/peliculasController
- Commit: ``

## 2026-03-30 - No funciona el load del modulo peliculas

- Sintoma: Load returna undefined a pesar de que la petición se ejecute correctamente
- Causa raiz: en load estaba guardando la pelicula con response.result cuando el objeto request ya retorna el result directamente
- Fix:
  - guardar la pelicula como response
- Archivos:
  - public/app/js/peliculas/controller.js
- Commit: ``

## 2026-04-01 - Update no actualiza la pelicula

- Sintoma: La petición update se ejecuta correctamente al modificar los datos de una pelicula pero los datos no se ven reflejados en la bd
- Causa raiz: no guardaba el id de la pelicula al capturar los datos
- Fix:
  - guardar el id proveniente de la url
- Archivos:
  - public/app/js/peliculas/controller.js
- Commit: ``