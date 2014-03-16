<?php
// The full public path to the application
define('BASE_URL', '/caldav_tool');

// The location of the app directory
define('APP_PATH', '../app');

require_once APP_PATH . '/bootstrap.php';

$router->dispatch($request);