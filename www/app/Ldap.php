<?php
/**
* Clase base del modelo del framework
*
* @package    Clase Modelo
* @author     José Medina
* @copyright Instituto Geográfico de Venezuela Simón Bolivar
*/
class Ldap 
{
	protected $_conexion;
        
        public function __construct()
	{
            $this->conectar();
	}
        
        private function conectar() 
        {
            // conexion a ldap
            $this->_conexion = ldap_connect( LDAP_HOST , LDAP_PORT) or die("Imposible Conectar");;
            ldap_set_option($this->_conexion, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Imposible asignar el Protocolo LDAP");
            
            /*
            <script id="msgModal">
                ejecutarModal("<?php print $this->msg;?>","Usuarios",{label: "Ok"});
            </script>
            */
        }
        
        public function Login($user , $pass) 
        {
            // match de usuario y password
            $dn = 'uid='.$user.",".LDAP_DN;
            $bind = @ldap_bind( $this->_conexion, $dn, $pass);
            if ($bind)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
}
?>
