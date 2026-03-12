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