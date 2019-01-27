<?php

namespace api\usuario;

use lib\Model;
use object\usuario\Usuario;


class apiUsuario extends Model{
    
    public function get(Usuario $obj){
        $query = $this->First($this->Select("SELECT * FROM [dbo].[tb_usuario] WHERE usuario = '{$obj->usuario}'"));
        
        $this->setObject($obj, $query);
    }

    public function getList(){
        return $this->Select("SELECT * FROM [dbo].[tb_usuario]");
    }



    public function save(Usuario $obj, $desative=false){


        $result = $this->Count($obj,array('usuario'=>$obj->usuario),'[dbo].[tb_usuario]');


        if($result <> 0){
            return $this->Update($obj,array('usuario'=> $obj->usuario),'[dbo].[tb_usuario]');
        } else {
            return $this->Insert($obj,'[dbo].[tb_usuario]');
        }

        #precisa reestruturar.
        if($desative){
            return $this->Update($obj,array('usuario'=> $obj->usuario),'[dbo].[tb_usuario]');
        }

    }

}