<?php
/**
* Clase base del modelo del framework
*
* @package    Clase Modelo
* @author     José Medina
* @copyright @Goyoxjg
*/
class Model 
{
	protected $_db;

        public function __construct()
	{
            $this->_db = new Database();
            //$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            //$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            //$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //http://php.net/manual/es/pdo.error-handling.php
	}
        
        
}
?>
