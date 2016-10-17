<html>
<head>
    <meta charset="utf-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?= APP_NOMBRE;?></title>
    <link href="<?php echo ruta_lib;?>bootstrap/css/bootstrap-combined.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo ruta_lib;?>bootstrap/css/tema_<?= NOMBRE_TEMA?>.css" rel="stylesheet" type="text/css"/>    
    <link href="<?php echo ruta_lib;?>bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo ruta_lib; ?>jquery/jquery-1.10.2.min.js"></script>
    <script src="<?php echo ruta_lib; ?>bootstrap/js/bootstrap.min.js"></script>    
    <script src="<?php echo ruta_lib; ?>bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>    
    <script src="<?php echo ruta_lib; ?>bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>    
    <script src="<?php echo ruta_lib; ?>jqBootstrapValidation/jqBootstrapValidation.js"></script>    
    <script src="<?php echo ruta_lib; ?>bootbox/bootbox.min.js"></script>                
    <script src="<?php echo $_layoutParams['ruta_pub'] ?>/js/general.js"></script>    
    <!--<script src="<?php echo $_layoutParams['ruta_js'] ?>/visor.js"></script>-->    
    <?= $this->_recursos;?>
    <?php
    if (isset($_layoutParams['ruta_js_controller'])) 
    {?>
    <script src="<?php echo $_layoutParams['ruta_js_controller'];?>"></script>
    <script>
        <?php 
        echo "var nom_usu = '".Session::get("nom_usu")."';";
        echo "var ape_usu = '".Session::get("ape_usu")."';";
        ?>
        $(document).ready(function() {          
            <?= Session::get("onload");?>
        });
    </script>
    <?php
    }?>
    <?php echo $this->_view->script; ?>      
</head>
<body style="overflow-x: hidden;<?php (Session::get("id_usu"))?print 'padding-top: 56px':'';?>">       
    <?php        
    if(Session::get("id_usu"))
    {?>
    <div class="row">
        <div class="navbar-default navbar-fixed-top" role="navigation">
            <!--<div class="navbar-inverse" style="padding: 2px"></div>-->  
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse">
            <?php //print Session::get("menu");?>   
            <?php
            if(Session::get("acl"))
            {
                require_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'menu.php';            
            }
            ?>      
        </div>          
        <div class="navbar-inverse" style="padding: 2px"></div>
      </div>
    </div>
<?php
    }
    ?>    
    <div class="row navbar-default">
        <div class="col-md-12">                            
            <div style="float: left;display: inline;position: relative;">
                <img height="96" width="96" src="<?php echo $_layoutParams['ruta_img'].NOMBRE_LOGO?>">
            </div>
            <div style="float: left;display: inline;position: relative;margin-left: 10px">
                <h4>
                    <?= APP_NOMBRE; ?>
                </h4>
                <div>
                    <h6>
                        <strong><?= APP_ABREVIADO; ?></strong> | <?= APP_SUBNOMBRE; ?>
                    </h6>
                </div>        
            </div>        
        </div>
        <div class="col-md-12">                            
            <div class="navbar-inverse" style="padding: 2px"></div>
        </div>
    </div>
<script>
    NProgress.configure({ showSpinner: false });    
    NProgress.start();    
    $(document).ready(function(){
        NProgress.done();         
    });
</script>