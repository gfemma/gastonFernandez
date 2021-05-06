<?php
    /**
     * Clase para administrar las localidades de la tabla geo_localidades
     */

     class cGeoCiudades extends cDB{
        private $tabla_ciudades = TBL_geo_ciudades;
        private $res = null;
        public $localidad_id = null;

        function __construct()
        {
            parent::__construct();
        }

        /**
         * Obtiene una ciudad dado su ID
         * @param int $id El ID de la ciudad a obtener
         */
        public function Get($id){
            $result = false;
            try {
                if(is_null(SecureInt($id))){ throw new Exception("El identificador de ciudad no es un número"); }

                $sql = "SELECT * FROM ".SQLQuote($this->tabla_ciudades)." WHERE `id`=".$id;
                $this->Query($sql);
                if($fila = $this->First()){
                    $result = $fila;
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $result;
        }

        /**
         * Obtiene un listado de los paises almacenados en la base de datos
         */
        public function Listar($page = null){
            $result = false;
            $this->res = null;
            try {
                if(is_null(SecureInt($this->localidad_id))){ throw new Exception("Debes elegir una localidad primero"); }
                $sql = "SELECT * FROM ".SQLQuote($this->tabla_ciudades). " WHERE `localidad_id`=".$this->localidad_id;
                if(!is_null(SecureInt($page))){
                    $limit = 1000;
                    $from = ($page*1000);
                    $sql .= " LIMIT ".$from.",".$limit;
                }
                $this->res = $this->Query($sql,true);
                if($fila = $this->First($this->res)){
                    if(!is_null(SecureInt($page))){
                        if($this->cantidad > $from+1000){
                            $this->getMore = true;
                        }
                    }
                    $result = $fila;
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $result;
        }

        /**
         * Obtiene el siguente resultado de Listar()
         */
        public function Siguiente(){
            $result = false;
            try {
                if(!is_null($this->res)){
                    if($fila = $this->Next($this->res)){
                        $result = $fila;
                    }
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $result;
        }
     }
?>