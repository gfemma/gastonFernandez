<?php
/**
 * Clase para el manejo de controladores
 */

    class cControllers{
        public $alias = null;

        /**
        * Con esto realizo la busqueda de una vista dado el nombre de un archivo
        * @param array $vista un array con la lista de parametros utilizados en la url
        */
        public function buscarVista($vista){
            $result = false;
            try {
                if(!CanUseArray($vista)){ throw new Exception(__METHOD__." El array esta vacío.");}
                $dir = DIR_paginas;
                $copy = $vista;
                foreach($vista as $value){
                    $dir .= ($dir[strlen($dir)-1] == DS)? $value:DS.$value;
                    $this->alias = array_shift($copy);
                    if(ExisteArchivo($dir.".htm")){
                        break;
                    }
                }
                if(ExisteArchivo($dir.".htm")){
                    $this->vista = $dir.".htm";
                    $this->parametros = array();
                    $this->parametros = (CanUseArray($copy))? $copy:$this->parametros;
                    if(CanUseArray($_REQUEST)){
                        $this->parametros = array_merge($this->parametros, $_REQUEST);
                    }
                    $result = true;
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage()); 
            }
            return $result;
        }

        /**
         * Con esto proceso una petición ajax
         */
        public function ProcesarAjax($url){
            $result = false;
            $file = '';
            $content = '';
            $this->parametros = array();
            try {
                //Si no puedo usar el array de la url probablemente me hayan realizado un post..
                if(!CanUseArray($url)){
                    if(isset($_REQUEST['file'])){
                        $file = $_REQUEST['file']; 
                    }

                    if(isset($_REQUEST['content'])){
                        $content = $_REQUEST['content']; 
                    }
                }else{
                    $file = array_pop($url);
                    $content = implode(DS,$url);
                }

                if(!empty($file)){
                    $dir = DIR_ajax;
                    $dir .= (empty($content))? '':$content.DS;
                    $dir .= $file;
                    AcomodarRuta($dir);
                    $dir .= (preg_match("/\.php$/", $dir))? '':'.php';
                    if(ExisteArchivo($dir)){
                        $this->ajaxFile = $dir;
                        if(CanUseArray($_REQUEST)){
                            $this->parametros = $_REQUEST;
                        }
                        $result = true;
                    }
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage()); 
            }
            return $result;
        }
    }
?>