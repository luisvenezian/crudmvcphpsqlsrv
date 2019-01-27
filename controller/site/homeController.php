<?php

namespace controller\site;

use lib\Controller;


class homeController extends Controller {

    public function __construct(){
        parent::__construct();

        $this->layout = '_layout';
    }

    public function index(){
        
        $this->title="Index Page";
        $this->view();

    }
}