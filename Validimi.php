<?php  

if(!class_exists('Validimi')){
    class Validimi{
        static function clears($str){
            $str = trim($str);
            $str = stripcslashes($str);
            $str = htmlspecialchars($str);
            return $str;
        }
        static function phone($str){
            $phone_regex = "/^[0-9]{9}$/";
            return preg_match($phone_regex, $str);
        }
        static function email($str){
            return filter_var($str, FILTER_VALIDATE_EMAIL);
        }
        static function password($str){
            $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/";  
            return preg_match($password_regex, $str);
        }
    }
}
?>