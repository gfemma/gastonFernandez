<?php
    /**
     * Clase para administrar los paises de la tabla geo_paises
     */

     class cGeoPaises extends cDB{
         private $tabla_paises = TBL_geo_paises;
         private $res = null;
        function __construct()
        {
            parent::__construct();
        }

        /**
         * Obtiene un país dado su ID
         * @param int $id El ID del país a obtener
         */
        public function Get($id){
            $result = false;
            try {
                if(is_null(SecureInt($id))){
                    throw new Exception("El identificador de país no es un número");
                }

                $sql = "SELECT * FROM ".SQLQuote($this->tabla_paises)." WHERE `id`=".$id;
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
                $sql = "SELECT * FROM ".SQLQuote($this->tabla_paises);
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