<?php  
class Util{
    static function redirect($location, $type = null, $em = null, $data = ""){
        $url = $location;
        if($type && $em){
            $url .= "?$type=$em";
            if($data){
                $url .= "&$data";
            }
        }
        header("Location: $url");
        exit;
    }
}