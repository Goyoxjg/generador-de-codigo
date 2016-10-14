<?php
class salirController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
 
    public function index()
    {
        Session::destroy();                        
        $this->redireccionar();
    } 
}
?>
