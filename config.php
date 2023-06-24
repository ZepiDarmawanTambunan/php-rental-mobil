<?php
// VERSI DEBUG
if(!defined('BASEPATH')) echo "Dilarang mengakses ke halaman ini!";

define('DEFAULT_CONTROLLER', 'C_Auth');
define('BASE_URL', 'http://localhost:8000/');
define('APP_NAME', 'Aplikasi Rental Mobil');

define('DB_HOST', 'localhost');
define('DB_NAME', 'php-rental-mobil');
define('DB_USER', 'root');
define('DB_PASS', '');

// VERSI PRODUCTION
// define('DEFAULT_CONTROLLER', 'C_Auth');
// define('BASE_URL', 'http://rental-mobil.test/');
// define('APP_NAME', 'Aplikasi Rental Mobil');

// define('DB_HOST', '172.23.0.2');
// define('DB_USER', 'rental_mobil');
// define('DB_PASS', 'rental_mobil');
// define('DB_NAME', 'rental_mobil');