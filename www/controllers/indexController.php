<?php
class indexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {                    

        Session::set("nom_log", $configuracion->nom_log);        
        Session::set("nom_tem", $configuracion->nom_tem);
        Session::set("for_fec", $configuracion->for_fec);
        Session::set("for_hor", $configuracion->for_hor);
        Session::set("app_nom", $configuracion->app_nom);
        Session::set("app_abr", $configuracion->app_abr);
        Session::set("app_sub_nom", $configuracion->app_sub_nom);
        
        if(Session::get("msg_error"))
        {          
            $this->_view->msg_error = Session::get("msg_error"); 
            Session::destroy();                
            $this->_view->render('index');
            exit();
        }
        
        if (isset($_REQUEST["log_usu"]) && isset($_REQUEST["pas_usu"])) 
        {
            $log_usu = trim($_REQUEST["log_usu"]);
            $pas_usu = md5(trim($_REQUEST["pas_usu"]));            
            $datos = Login::valida_acceso($log_usu, $pas_usu);
            if (!$datos) 
            {
                Session::set("msg_error", "No existe el usuario o la contraseña es incorrecta.");
                $this->redireccionar();
            } 
            else 
            {
                $usuario = Usuarios::consultarUsuarios($datos->id);
                
                Session::set("id_usu", $usuario->id);
                Session::set("nom_usu", $usuario->nom_usu);
                Session::set("ape_usu", $usuario->ape_usu);
                Session::set("pag_ini", $usuario->pag_ini);
              
                if(!Session::get('acl'))
                {
                    $acl = new acl(Session::get('id_usu'));
                    Session::set('acl',  serialize($acl));
                    unset($_REQUEST);

                    $controladores_permitidos = Array();
                    foreach ($acl->perms as $key => $value) 
                    {
                        $tmp = explode("_", $key);
                        $controlador = $tmp[0];
                        if(!in_array($controlador, $controladores_permitidos))
                        {                            
                            array_push($controladores_permitidos, $controlador);
                        }
                    }
                    Session::set('cont_perm',  $controladores_permitidos);
                }
                $this->_view->render("inicio");
                exit();
            }
        } 
        else if (!Session::get('id_usu')) 
        {
            $this->_view->render('index');
        } 
        else 
        {            
            $this->_view->render("inicio");
        }
    }           
}
?>
