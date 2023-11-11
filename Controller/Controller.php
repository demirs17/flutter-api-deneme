<?php

class Controller{
    protected function requiredFields(Array $keys){
        $array = $_SERVER["REQUEST_METHOD"] == "GET" ? $_GET : ($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST : die("Controller.php - 5"));
        for($i = 0;$i<count($keys);$i++){
            if(!array_key_exists($keys[$i], $array)){
                echo '{"status": "unsuccessful", "successful": false, "message": "Eksik veri '. $keys[$i] .'"}';
                exit;
            }else{
                if(empty($array[$keys[$i]])){
                    echo '{"status": "unsuccessful", "successful": false, "message": "Eksik veri '. $keys[$i] .'"}';
                    exit;
                }
            }
        }
    }
    protected function model($model_name, $method_name, $args){
        include_once("Model/". $model_name .".php");
        return $model_name::$method_name($args);
    }
    protected function safe_input($input, bool $htmlspecialchars = true, bool $trim = true, bool $stripslashes = true){
        $trim = $trim . " \n\r\t\v\x00";
        $data = $htmlspecialchars ? htmlspecialchars($input) : $input;
        $data = $trim ? trim($data) : $data;
        $data = $stripslashes ? stripslashes($data) : $data;
        return $data;
    }
}