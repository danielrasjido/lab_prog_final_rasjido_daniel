<?php

//#########################################
// CONSTANTES PRINCIPALES
//#########################################


// APP_PROJECT_DIR: Directorio raíz, en disco
// APP_BASE_URL: URL base del proyecto, es la que ve el navegador
const APP_PROJECT_DIR = '/lab_prog_final_rasjido_daniel';
const APP_BASE_URL = 'http://localhost' . APP_PROJECT_DIR . '/public';

//#########################################
// URL Y RUTAS BASE
//#########################################


// APP_URL: Sirve para generar links, hrfefs, etc. Ej: http://localhost/mi_nuevo_proyecto/public/
// APP_BASE_PATH: Ruta absoluta en el servidor, para incluir archivos, etc. Ej: C:/xampp/htdocs/mi_nuevo_proyecto
// APP_URI: Ruta específica de app, para incluir archivos como views/resources de template.php, etc. Ej: C:/xampp/htdocs/mi_nuevo_proyecto/app/
// URI significa Uniform Resource Identifier, identifica un recurso, este caso de la carpeta app
const APP_URL = APP_BASE_URL;
define('APP_BASE_PATH', rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') . APP_PROJECT_DIR);
define('APP_URI', APP_BASE_PATH . '/app/');


//#########################################
// DIRECTORIOS PRINCIPALES
//#########################################

define('APP_DIR_TEMPLATE', APP_URI . 'resources/template/');
define('APP_DIR_VIEWS', APP_URI . 'resources/views/');
define('APP_DIR_REPORTS', APP_URI . 'resources/reports/');

//#########################################
// ARCHIVOS PRINCIPALES
//#########################################

define('APP_FILE_TEMPLATE', APP_DIR_TEMPLATE . 'template.php');
define('APP_FILE_LOG_ERRORS', APP_URI . 'logs/error.log');
define('APP_FILE_LOG_ACCES', APP_URI . 'logs/access.log');
define('APP_FILE_LOG_ACCESS', APP_FILE_LOG_ACCES);

define('APP_FILE_LOGIN', APP_DIR_VIEWS . 'authentication/index.php');
define('APP_FILE_LOGOUT', APP_DIR_VIEWS . 'authentication/logout.php');


//#########################################
// CONTROLADOR Y ACCION POR DEFECTO
//#########################################


const APP_DEFAULT_CONTROLLER = "home";
const APP_DEFAULT_ACTION = "index";


const APP_AUTHENTICATION_CONTROLLER = 'authentication';
const APP_LOGIN_ACTION = 'index';

//#########################################
// MANEJO DE SESIONES
//#########################################


//generar token proximamente investigar

const APP_TOKEN = 'token';


// APP_URL      => usar en navegador (href, src, redirects HTTP).
// APP_BASE_PATH=> ruta física base del proyecto en disco.
// APP_URI      => ruta física de /app en disco.
// Si el navegador la consume -> APP_URL.
// Si PHP necesita require/file_exists -> APP_BASE_PATH o APP_URI.
// APP_DIR_*    => carpetas físicas derivadas de APP_URI.
// APP_FILE_*   => archivos físicos concretos (template, logs, views).