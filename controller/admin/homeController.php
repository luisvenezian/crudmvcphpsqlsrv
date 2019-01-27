<?php

namespace controller\admin;

use lib\Controller;
use helper\Seguranca;

class homeController extends Controller{

    public function __construct(){
        parent::__construct();

        new Seguranca();
    }

    public function index(){
        $this->view(); 
    }

}