<?php

namespace api\sessao;

use lib\Model;
use object\sessao\Sessao;

class apiSessao extends Model {
    public function login(Sessao $obj){
        $user = trim($obj->usuario);
        $pass = trim($obj->senha);

        $sql = "SELECT TOP 1 * FROM [dbo].[tb_usuario] WHERE usuario = '{$user}'";
        $query = $this->First($this->Select($sql));

        if (isset($query->senha)){
            if($pass == $query->senha){
                $_SESSION['usuario']= $query->senha;
                header('location:' . APP_ROOT . 'admin');
            }
            else {
                echo "<script> alert('Usuário e senha inválidos!'); </script>";
                header('location:' . APP_ROOT . 'admin/sessao');
            }
        } else {
            echo "<script> alert('Usuário e senha inválidos!'); </script>";
            header('location:' . APP_ROOT . 'admin/sessao');
        }

    }

    public function logout(){
        unset($_SESSION['usuario']);
        header('location:' . APP_ROOT . 'admin/sessao');

    }
}