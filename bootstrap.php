<?php
define('APP_ENV', !empty($_SERVER['APP_ENV']) ? $_SERVER['APP_ENV'] : 'production');
define('APP_PATH', ROOT_PATH . '/app');

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

$router->respond(function ($request, $response, $service, $app) use ($router) {
    // Hook up twig
    $app->register('twig', function() {
        $loader = new Twig_Loader_Filesystem(APP_PATH . '/templates/');
        $twig = new Twig_Environment($loader, [
            'cache' => ROOT_PATH . '/cache/',
            'strict_variables' => true
        ]);

        if (APP_ENV === 'development') {
            $twig->enableDebug();
            $twig->enableAutoReload();
            $twig->addExtension(new Twig_Extension_Debug());
        }

        return $twig;
    });
});

// Load the controllers
foreach ($controllers as $controller) {
    require_once APP_PATH . '/controllers/' . $controller . '.php';
}

// Load the models
foreach ($models as $model) {
    require_once APP_PATH . '/models/' . $model . '.php';
}