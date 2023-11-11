<?php

class Route{
    static function define(string $request_method, string $endpoint, $action){
        if($_SERVER["REQUEST_METHOD"] == $request_method){
            $request_uri = $_SERVER["REQUEST_URI"];
            $parts = explode('?', $request_uri);
            if(count($parts) > 1){ $request_uri = $parts[0];}
            if(__ROOT__ . $endpoint == $request_uri){
                $data = array("request_datas" => $request_method == "GET" ? $_GET : ($request_method == "POST" ? $_POST : file_get_contents("php://input")));
                if(gettype($action) == "object"){
                    call_user_func($action, $data);
                }
                elseif(gettype($action) == "array"){
                    include_once "Controller/" . $action[0] . ".php";
                    $classAndMethod = array($action[0], $action[1]);
                    call_user_func_array($classAndMethod, Array("request_datas" => $data));
                }
                exit;
            }
        }
    }
    static function user_slash_username(string $request_method, $action){
        if($_SERVER["REQUEST_METHOD"] == $request_method){
            $request_uri = $_SERVER["REQUEST_URI"];
            $parts = explode('?', $request_uri);
            if(count($parts) > 1){ $request_uri = $parts[0];}
            
            $endpoint = str_replace(__ROOT__, "", $request_uri);
            $input_string = $endpoint;

            $prefix = "/user/";
            $length = strlen($prefix);

            if (strpos($input_string, $prefix) === 0) {
                $remaining_string = substr($input_string, $length);

                if (!empty($remaining_string) && !strpos($remaining_string, '/')) {  
                    $data = array(
                        "request_datas" => $request_method == "GET" ? $_GET : ($request_method == "POST" ? $_POST : file_get_contents("php://input")),
                        "url_params" => array("username" => $remaining_string),
                    );

                    if(gettype($action) == "object"){
                        call_user_func($action, $data);
                    }
                    elseif(gettype($action) == "array"){
                        include_once "Controller/" . $action[0] . ".php";
                        $classAndMethod = array($action[0], $action[1]);
                        call_user_func_array($classAndMethod, Array("request_datas" => $data));
                    }
                    exit;
                }
            }
        }
    }
}



?>