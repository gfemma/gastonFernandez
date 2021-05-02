<?php
if(!defined("dbhost")){
        require_once(DIR_config."config.php");
    }
    class cDB {
        private $connect = null;
        public $error = null;

        private $lastResult = null;
        private $result = null;
        public $lastSql = null;
        public $trackSql = array();
        public $lastId = null;
        public $cantidad = 0;
        public $prepared = false;

        function __construct()
        {
            $this->connect = @new mysqli(dbhost, dbuser, dbpass, dbname);
            
            if($this->connect->connect_errno){
                $this->error = 'Error de conexión: ' . $this->connect->connect_error;
            }
        }
        //Ejecuta una consulta de tipo SELECT
        public function Query($query = '', $count = false){
            $result = false;
            try {
                if(!empty($query) AND $query != $this->lastSql){
                    if($count){
                        $this->cantidad = $this->GetRowsCount($query);
                    }
                    
                    $this->lastSql = $query;
                    $this->trackSql[] = $query;
                    $this->lastResult = $this->connect->Query($query);
                    $result = $this->lastResult;
                }
            } catch (Exception $e) {
                Echo "Hubo un error ejecutando la consulta: ".$e;
            }
            return $result;
        } 

        //Obtiene el primer resultado de la consulta
        public function First($dbresult = null){
            $result = false;
            $data = null;
            try {
                if($dbresult != null){
                    $data = $dbresult;
                }else if($this->lastResult){
                    $data = $this->lastResult;
                }
                if($data){
                    $data->data_seek(0);
                    $this->result = $data->fetch_assoc();
                    $result = $this->result;
                    $this->RawRecord();
                }
            } catch (Exception $e) {
                Echo "Hubo un error ejecutando la consulta: ".$e;
            }
            return $result;
        }
        //Obtiene el siguiente resultado de la consulta
        public function Next($dbresult = null){
            $result = false;
            $data = null;
            try {
                if($dbresult != null){
                    $data = $dbresult;
                }else if($this->lastResult){
                    $data = $this->lastResult;
                }
                if($data){
                    $this->result = $data->fetch_assoc();
                    if($this->result){
                        $result = $this->result;
                        $this->RawRecord();
                    }
                }
            } catch (Exception $e) {
                Echo "Hubo un error ejecutando la consulta: ".$e;
            }
            return $result;
        }

        //Coloca los resultados como propiedades del objeto y si hay algun json le hace decode
        public function RawRecord(){
            $result = false;
            try {
                if(isset($this->result)){
                    foreach($this->result as $key => $value){
                        $valor = $value;
                        if(IsJson($valor)){
                            $valor = json_decode($valor);
                        }
                        $this->$key = $valor;
                    }
                }
            } catch (Exception $e) {
                Echo "Hubo un error ejecutando la consulta: ".$e;
            }
            return $result;
        }

        //Inserta el contenido del array $data en la tabla $table
        public function Insert($table, $data){
            $result = false;
            if(CanUseArray($data)){
                $sql = "INSERT INTO ".SQLQuote($table);
                $campos = '';
                $valores = '';
                foreach($data as $key => $value){
                    if($key != 'id'){
                        $campos .= SQLQuote($key).",";
                        if(!IsJson($value)){
                            $valores .= "'".$this->connect->real_escape_string($value)."',";
                        }else{
                            $valores .= "'".$value."',";
                        }
                    }
                }
                $campos = preg_replace("/\,$/", "", $campos);
                $valores = preg_replace("/\,$/", "", $valores);
                $sql .= " (".$campos.") VALUES (".$valores.")";
                $result = $this->connect->Query($sql);
            }
            return $result;
        }

        private function GetRowsCount($sql){
            $result = 0;
            if(!empty($sql)){
                $sql = preg_replace("/^SELECT .+ FROM/", "SELECT count(*) as cantidad FROM", $sql);
                $sql = preg_replace("/WHERE([^LIMIT]*)\s{1}LIMIT [0-9]+\s?,?\s?[0-9]*/", "WHERE$1", $sql);
                if($this->Query($sql) and $fila = $this->First()){
                    $result = $fila['cantidad']; 
                }
            }
            return $result;
        }
    }
?>