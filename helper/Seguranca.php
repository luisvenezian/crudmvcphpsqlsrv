<?php 

namespace helper;

class Seguranca{

    public function __construct(){
        if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])){
            header('location:' . APP_ROOT . 'admin/sessao');
        }
    }
}