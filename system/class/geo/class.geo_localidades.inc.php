<?php
    /**
     * Clase para administrar las localidades de la tabla geo_localidades
     */

     class cGeoLocalidades extends cDB{
        private $tabla_localidades = TBL_geo_localidades;
        private $res = null;
        public $pais_id = null;

        function __construct()
        {
            parent::__construct();
        }

        /**
         * Obtiene una localidad dado su ID
         * @param int $id El ID de la localidad a obtener
         */
        public function Get($id){
            $result = false;
            try {
                if(is_null(SecureInt($id))){
                    throw new Exception("El identificador de localidad no es un número");
                }

                $sql = "SELECT * FROM ".SQLQuote($this->tabla_localidades)." WHERE `id`=".$id;
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
        public function Listar(){
            $result = false;
            $this->res = null;
            try {
                if(is_null(SecureInt($this->pais_id))){
                    throw new Exception("Debes elegir un país primero");
                    
                }
                $sql = "SELECT * FROM ".SQLQuote($this->tabla_localidades). " WHERE `pais_id`=".$this->pais_id;
                $this->res = $this->Query($sql);
                if($fila = $this->First($this->res)){
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