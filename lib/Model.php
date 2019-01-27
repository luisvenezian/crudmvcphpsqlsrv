<?php 

namespace lib;

class Model extends Config {

    protected $con;

    public function __construct(){
        try {
            #$conn = new PDO("sqlsrv:Server=localhost;Database=testdb", "UserName", "Password"); 

            $this->con = new \PDO("sqlsrv:Server=". self::srvMyhost ."; Database=". self::srvMydbname , self::srvMyuser , self::srvMypass);
            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $ex){
            die ($ex->getMessage());
        }
       
    }

    public function Select($sql){
        try {
            $state = $this->con->prepare($sql);
            $state->execute();
        } catch (\PDOException $ex){
            die ($ex->getMessage(). "Comando: ". $sql);
        }
       
        $array = array();
        while($row = $state->fetchObject()){
            $array[] = $row;
        }

        return $array;

    }

    public function Insert($obj, $table){
        try {
            
            $sql = "INSERT INTO {$table} (".implode(",",array_keys((array) $obj)).") VALUES ('".implode("','",array_values((array) $obj))."')"; 
            $state = $this->con->prepare($sql);
            $state->execute(array('widgets'));
        
        } catch (\PDOException $ex){
            die ($ex->getMessage(). "Comando: ". $sql);
        }

        return array('sucess'=>true, 'feedback'=>'', 'codigo'=>$this->Last($table));
    }

    public function Update($obj, $condition, $table){
        try {
            foreach($obj as $ind => $val){
             $dados[] = "{$ind} = ".(is_null($val) ? " NULL " : "'{$val}'");   
            }

            foreach($condition as $ind => $val){
             $where[] = "{$ind}".(is_null($val) ? " IS NULL " : " = '{$val}'");   
            }

            $sql = "UPDATE {$table} SET ". implode(',', $dados)." WHERE ". implode(' AND ', $where);
            
            $state = $this->con->prepare($sql);
            $state->execute(array('widgets'));
        } catch (\PDOException $ex){
            die ($ex->getMessage(). "Comando: ". $sql);
        }

        return array('sucess'=>true, 'feedback'=>'', 'codigo'=>$this->Last($table));
    }

    public function Delete($condition, $table){
        try {
            foreach($condition as $ind => $val){
                $where[] = "'{$ind}'".(is_null($val) ? " IS NULL " : " = '{$val}'"); 
            }



        }   catch (\PDOException $ex){
            die ($ex->getMessage(). "Comando: ". $sql);
        }

        return array('sucess'=>true, 'feedback'=>'', 'codigo'=>$this->Last($table));

    }

    public function Last($table){
        try {
            $state = $this->con->prepare("SELECT IDENT_CURRENT('{$table}') AS [last]");
            $state->execute();
            $state = $state->fetchObject();

        } catch (\PDOException $ex){
            die ($ex->getMessate());
        }

        return $state->last;
    }

    public function First($obj){
        if (isset($obj[0])){
            return $obj[0];
        }
        else {
            return null;
        }
    }



    public function Count($obj, $condition, $table){
        try {
            foreach($obj as $ind => $val){
             $dados[] = "{$ind} = ".(is_null($val) ? " NULL " : "'{$val}'");   
            }

            foreach($condition as $ind => $val){
             $where[] = "{$ind}".(is_null($val) ? " IS NULL " : " = '{$val}'");   
            }

            $sql = "SELECT COUNT(*) AS [C] FROM {$table} WHERE ". implode(' AND ', $where);
            
            $state = $this->con->prepare($sql);
            $state->execute();
            $state = $state->fetchObject();

        } catch (\PDOException $ex){
            die ($ex->getMessage(). "Comando: ". $sql);
        }


        return $state->C;



        #return array('sucess'=>true, 'feedback'=>'', 'codigo'=>$this->Last($table));
    }


    public function setObject($Obj, $Values, $Exists = true){
        if (is_object($Obj)) {
        
            $counter = (is_array($Values) ? count($Values) : 0 );
            # Parameter must be an array or an object that implements 
            # Var counter resolve isso, função count agora 7.2 >
            # Só aceita valores que não são nulos.
           

       # Comentado... Revisar.
       # if ($counter > 0){
            if (!is_null($Values)){
                foreach ($Values as $in => $va){
                    if (property_exists($Obj,$in) || $Exists){

                        $Obj->$in = $Values->$in;
                    
                    }
                }
            }

            #}
        }
    }


}