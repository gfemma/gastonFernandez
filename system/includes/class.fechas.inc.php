<?php
/**
 * Clase para manejo de fechas
 */
//IsoToLatin: Convierte fecha en formato YYYY-MM-DD a YYYY/MM/DD
    class cFechas{
        static public function IsoToLatin($date){
            $result = $date;
            if(self::LooksLikeIsoDate($date)){
                $tmp = explode("-",$date);
                $result = $tmp[2]."/".$tmp[1]."/".$tmp[0];
            }
            return $result;
        }

        static public function LooksLikeIsoDate($date){
            return preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date);
        }

        static public function Ahora(){
            return date("Y-m-d H:i:s");
        }

        static public function LookLikeSqlDateTime($date){
            return preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}[\s]{1}[0-9]{2}:[0-9]{2}:[0-9]{2,4}$/", $date);
        }
        
        static public function ExtractSqlDateTime($date){
            $result = $date;
            if(self::LookLikeSqlDateTime($date)){
                $result = explode(" ",$date);
                $result = $result[1];
                if(preg_match("/[0]{2}$/", $result)){
                    $result = mb_substr($result, 0, strlen($result)-3);
                }
            }
            return $result;
        }


        static public function ExtractSqlDate($date){
            $result = $date;
            if(self::LookLikeSqlDateTime($date)){
                $result = explode(" ",$date);
                $result = $result[0];
            }
            return $result;
        }

        static public function dateToString($date){
            $result = $date;
            if(self::LooksLikeDate($date)){
                $tmp = new DateTime($date);
                $result = strftime("%A %u de %B del %G", $tmp->format("U"));
                // $result = utf8_encode($result);
            }
            return $result;
        }

        static public function diferenciaEntreFechas($start, $end, $array = false){
            $result = false;
            if(self::LooksLikeDate($start) and self::LooksLikeDate($end)){
                $tmp1 = new DateTime($start);
                $tmp2 = new DateTime($end);
                $rs = $tmp1->diff($tmp2);
                if($array){
                    $result = array();
                }
                if($rs->y > 0){
                    if($array){
                        $result['years'] = $rs->y;
                    }else{
                        $result = ($rs->y > 1)? $rs->y." años":$rs->y. " año";
                    }
                }

                if($rs->m > 0){
                    if($array){
                        $result['meses'] = $rs->m;
                    }else{
                        $result .= (empty($result))? '':', ';
                        $result .= ($rs->m > 1)? $rs->m." meses":$rs->m. " mes";
                    }
                }

                if($rs->d > 0){
                    if($array){
                        $result['dias'] = $rs->d;
                    }else{
                        $result .= (empty($result))? '':', ';
                        $result .= ($rs->d > 1)? $rs->d." días":$rs->d. " dia";
                    }
                }

                if($rs->h > 0 and !empty($result)){
                    if($array){
                        $result['horas'] = $rs->h;
                    }else{
                        $result .= (empty($result))? '':' y ';
                        $result .= ($rs->h > 1)? $rs->h." horas":$rs->h. " hora";
                    }
                }

                if($rs->i > 0){
                    if($array){
                        $result['minutos'] = $rs->i;
                    }else{
                        $result .= (empty($result))? '':' con ';
                        $result .= ($rs->i > 1)? $rs->i." minutos":$rs->i. " minuto";
                    }
                }

                if($rs->s > 0){
                    if($array){
                        $result['segundos'] = $rs->s;
                    }else{
                        $result .= (empty($result))? '':' y ';
                        $result .= ($rs->s > 1)? $rs->s." segundos":$rs->s. " segundo";
                    }
                }
            }
            return $result;
        }

        // Valida que la fecha sea ISO o Latin
        static public function looksLikeDate($date){
            return preg_match("/(^[0-9]{4}|^[0-9]{2})(-|\/{1})([0-9]{2})(-|\/{1})([0-9]{4}|[0-9]{2})/", $date);
        }
    } 
?>