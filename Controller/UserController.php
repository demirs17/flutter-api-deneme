<?php

require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

class UserController extends Controller{
    public function login($params){
        parent::requiredFields(Array("username", "password"));

        //test_input();
        $res = parent::model("User", "login", $params["request_datas"]);
        $result = $res->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($result) > 0){
            $payload = array(
                "data" => array(
                    "id" => $result[0]["id"],
                    "username" => $result[0]["kullanici_adi"],
                ),
                "iat" => time(),
                "exp" => time() + 60 * 60 * 4
            );
            $jwt = JWT::encode($payload, JWT_KEY, 'HS256');
            echo '{"status": "successful", '
                    . '"successful": true, '
                    . '"message": "Giriş Yapıldı", '
                    . '"data": {"token": '. json_encode($jwt) .'}}';
        }else{
            echo '{"status": "unsuccessful", "successful": false, "message": "Yanlış kullanıcı adı veya şifre"}';
        }
    }
    public function register($params){
        parent::requiredFields(Array("username", "password", "email"));
        
        $_post = $params["request_datas"];
        
        if(!filter_var($_post["email"], FILTER_VALIDATE_EMAIL)){
            echo('{"status": "unsuccessful", "message": "Geçersiz e-posta adresi"}');exit;
            exit;
        }
        //test_input();
        $result = parent::model("User", "register", $_post);
        echo $result
            ? json_encode(Array("status" => "successful", "successful" => true, "message" => "Kayıt Yapıldı", "data" => Array("kullanici_adi" => htmlspecialchars($_post["username"]),"sifre" => htmlspecialchars($_post["password"]),"email" => htmlspecialchars($_post["email"]),)))
            : '{"status": "unsuccessful", "successful": false, "message": "Kayıt Yapılamadı"}';
    }
}