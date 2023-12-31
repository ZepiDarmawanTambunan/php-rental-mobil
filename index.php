<?php
// membuat variable const global

session_start();

date_default_timezone_set('Asia/Jakarta');

define('BASEPATH', dirname(__FILE__)); // C:/php-rental-mobil
define('DS', DIRECTORY_SEPARATOR); // "\"

define('M_PATH', BASEPATH . DS . 'models' ); //mendefinisikan directory models
define('V_PATH', BASEPATH . DS . 'views');
define('C_PATH', BASEPATH . DS . 'controllers');
define('F_PATH', BASEPATH . DS . 'functions');
define('L_PATH', BASEPATH . DS . 'libraries');

require_once BASEPATH . DS . 'config.php'; // import file
require_once BASEPATH . DS . 'core' . DS . 'Controller.php';
require_once BASEPATH . DS . 'core' . DS . 'Route.php';
require_once BASEPATH . DS . 'core' . DS . 'Database.php';
require_once BASEPATH . DS . 'core' . DS . 'Model.php';

// jalankan proses routing
new Route(); // from core/Route.php
?>