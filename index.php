<?php

/** START SESSION */
session_start();

if (isset($_POST)){
    foreach ($_POST as $in => $va){
        $_POST[$in] = str_replace("'","\\'",$va);  

        #Dica, implementar segurança contra um inject.
        #$_POST[$in] = str_replace(array("'SELECT','INSERT','SYS.TABLES','FROM','UPDATE'"),"",$va);  
    }
}


define('APP_ROOT', 'http://'. $_SERVER['HTTP_HOST'] . '/crud_mvc/');
require_once 'helper/Bootstrap.php';

use lib\System;

$System = new System();
$System->Run();