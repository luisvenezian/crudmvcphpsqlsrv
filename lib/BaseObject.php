<?php 

namespace lib;

class BaseObject{
    public function __construct($method = null, $all = true){
        
        
        if($method == 'POST'){
            foreach($_POST as $ind => $val){
                $this->$ind = $val;
            }
        }



        if(isset($_FILES)){
            foreach($_FILES as $ind => $val){
                if($all || isset($this->$ind)){
                    $this->$ind =$val;
                }
            }
        }

    }
}
