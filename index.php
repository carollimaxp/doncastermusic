<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath('/Users/robhadfield/Dropbox/Web/doncastermusic/lib'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

//var_dump(APPLICATION_PATH); exit;

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/local_configs/application.ini'
);

$frontController = Zend_Controller_Front::getInstance();

$router = $frontController->getRouter();
/*
$loginRoute = new Zend_Controller_Router_Route(
'/login/:company/*',
array('controller' => 'login',
         'company' => 'nocompany')
        );
$router->addRoute('loginRoute', $loginRoute);
*/
$application->bootstrap()
            ->run();
