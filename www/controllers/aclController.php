<?php
class aclController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function ajaxPermisos()
    {
        $acl = unserialize(Session::get('acl'));
        print json_encode($acl);
    }
}
?>
