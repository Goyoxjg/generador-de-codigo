<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'app' . DS );
//echo '<meta charset="utf-8">' ;

require_once APP_PATH . 'Config.php';
require_once APP_PATH . 'Herramientas.php';
require_once APP_PATH . 'Request.php';
require_once APP_PATH . 'Bootstrap.php';
require_once APP_PATH . 'Controller.php';
require_once APP_PATH . 'Model.php';
require_once APP_PATH . 'View.php';
require_once APP_PATH . 'Database.php';
require_once APP_PATH . 'Session.php';
require_once APP_PATH . 'Acl.php';
require_once APP_PATH . 'ManagerPermission.php';
require_once APP_PATH . 'explorador.php';
require_once APP_PATH . 'php-activerecord/ActiveRecord.php';
require_once APP_PATH . 'PHPMailer_v5.1/class.phpmailer.php';

ActiveRecord\Config::initialize(function($cfg)
{
     $cfg->set_model_directory ('models');
     $cfg->set_connections(array(
         'development' => DB_PG_CONNECTION));
});

Session::init();

try
{       
    Bootstrap::run(new Request);
} 
catch(Exception $e)
{
    echo $e->getMessage();
}
?>