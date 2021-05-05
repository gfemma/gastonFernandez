<?php
    /**
     * Clase para el control de la barra superior y cada uno de sus elementos
     */

    class cMenu{
        private $elements = null;
        public $currentElement = null;
        
        function __construct($file)
        {
            if(empty($file)){
                $this->errorMsg = "No me indicaste ningpun archivo";
                return;
            }

            if(!preg_match("/.+\.json$/", $file)){
                $file .= ".json";
            }
            if(!preg_match("/\\+|\/+/", $file)){
                $file = DIR_config.$file;
            }

            if(!ExisteArchivo($file)){
                $this->errorMsg = "El archivo indicado no existe";
                return; 
            }
            $this->file = $file;
        }

        /**
         * Obtiene todos los elementos del menu
         */
        public function getElements(){
            $result = false;
            $this->errorMsg = null;
            try {
                if(!$content = file_get_contents($this->file)){ $this->errorMsg = "No se pudo leer el archivo"; }
                if(!IsJsonEx($content)){ $this->errorMsg = "Json mal formado"; }
                if(is_null($this->errorMsg)){
                    $elements = json_decode(strtolower($content),true);
                    if(CanUseArray($elements)){
                        $this->elements = $elements;
                        $result = true;
                    }
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $result;
        }

        /**
         * Obtiene los elementos padres del menu
         */
        public function getParentElements(){
            $result = false;
            $this->errorMsg = null;
            try {
                if(!isset($this->elements) or is_null($this->elements)){ $this->errorMsg = "No hay elementos para procesar"; }
                if(is_null($this->errorMsg)){
                    $this->parents = array();
                    foreach($this->elements as $key => $value){
                        $this->parents[] = $key;
                    }
    
                    if(CanUseArray($this->parents)){
                        $result = $this->parents;
                    }
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $result;
        }

        /**
         * Obtiene los elementos padres del menu
         */
        public function hasChildrends($element){
            $result = false;
            $this->errorMsg = null;
            try {
                if(empty($element) or !CanUseArray($this->elements)){ $this->errorMsg = "Me diste un elemento vacio"; }
                if(!isset($this->elements[$element])){ $this->errorMsg = "Este elemento no existe en el menu"; }
                if(is_null($this->errorMsg)){
                    $result = (!empty($this->elements[$element]));
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $result;
        }

        /**
         * Obtiene los hijos de un elemento y los devuelve en forma de array
         */
        public function getChildrens($element){
            $result = false;
            $this->errorMsg = null;
            try {
                if(empty($element) or !CanUseArray($this->elements)){ $this->errorMsg = "No hay elementos para procesar"; }
                if(!isset($this->elements[$element])){ $this->errorMsg = "Este elemento no existe en el menu"; }
                if(!$this->hasChildrends($element)){ $this->errorMsg = "Este elemento no tiene hijos"; }

                if(is_null($this->errorMsg)){
                    $result = array();
                    foreach($this->elements[$element] as $key => $value){
                        $result[] = $key;
                    }
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $result;
        }

       /**
         * Obtiene los hijos de un elemento y los devuelve en forma de array
         */
        public function getConfigs($element, $parent = null){
            $result = false;
            $data = null;
            $this->errorMsg = null;
            try {
                if(empty($element) or !CanUseArray($this->elements)){ $this->errorMsg = "No hay elementos para procesar"; }
                if($parent == null){
                    $data = @$this->elements[$element];
                }else{
                    $data = @$this->elements[$parent][$element];
                }

                if(is_null($this->errorMsg) AND !empty($data)){
                    $this->configs = $data;
                    $result = $data;
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $result;
        }
    } 
?>