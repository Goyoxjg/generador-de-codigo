<?php

class denegadoController extends Controller{
    
    public function __construct(){
        parent::__construct();
    }
        
    public function index()        
    {
        $this->_view->render('index');
    }
}