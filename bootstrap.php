<?php
require_once __DIR__ . '/vendor/autoload.php';

// Components to load
$controllers = [];
$models = [];


use \Klein\Klein;

$router = new Klein();
$request = getKleinRequest();

/**
 * A fix for Klein's handling (or lack thereof) of non-webroot deployments
 */
function getKleinRequest() {
	// Grab the server-passed "REQUEST_URI"
	$request = \Klein\Request::createFromGlobals();
	$uri = $request->server()->get('REQUEST_URI');

	// Set the request URI to a modified one (without the "subdirectory") in it
	$request->server()->set('REQUEST_URI', substr($uri, strlen(BASE_URL)));

	return $request;
}

// Load the controllers
foreach ($controllers as $controller) {
	require_once ROOT_PATH . '/app/controllers/' . $controller . '.php';
}

// Load the models
foreach ($models as $model) {
	require_once ROOT_PATH . '/app/models/' . $model . '.php';
}