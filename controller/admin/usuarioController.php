<?php

namespace controller\admin;

use lib\Controller;
use object\usuario\Usuario;
use api\usuario\apiUsuario;
use helper\Seguranca;

class usuarioController extends Controller{

    public function __construct(){
        parent::__construct();

        new Seguranca();
    }


    public function index(){
        $api =new apiUsuario();

        $this->dados = array(
            'list'=> $api->getList()
        );
        $this->view();
    }



    public function formCadastro(){
        
        $Usuario = new Usuario();

        $Usuario->usuario = $this->getParams(0);
        
        
  
        $api = new apiUsuario();
        $api->get($Usuario);
; 

        $this->dados = array(
            'dados' => $Usuario
        );
      
        $this->view();
    }


    public function formDelCadastro(){
        
        $Usuario = new Usuario();
        $Usuario->usuario = $this->getParams(0);
        

        $api = new apiUsuario();
        $api->get($Usuario);

        $this->dados = array(
            'dados' => $Usuario
        );
      
        $this->view();
    }



    public function save(){
        $api = new apiUsuario();
       
        print_r($api->save(new Usuario('POST')));
    }




    public function desative(){
        $api = new apiUsuario();
       
        print_r($api->save(new Usuario('POST')), 1);
    }

    
}