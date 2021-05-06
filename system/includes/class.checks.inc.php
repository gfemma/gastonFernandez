<?php
    class cCheck{
        public static $dni = "/^[0-9]{1,2}\.?[0-9]{3}\.?[0-9]{3}$/";
        public static $email = "/[\w\.]+\@[\w]+\.[\w]+([\.][a-z]+)?$/i";

        public static function dni($str){
            return preg_match(self::$dni,$str);
        }

        public static function email($str){
            return preg_match(self::$email,$str);
        }
    }
?>