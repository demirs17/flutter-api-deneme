<?php
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;


class PostController extends Controller{
    static function fetch_time($args){
        parent::requiredFields(array("token"));
        $result = parent::model("Post", "fetch_time", $args["request_datas"]);
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
    /*
     *  /user/{username}
     */
    static function fetchByUsername($params){
        parent::requiredFields(array("username"));
        $res = parent::model("Post", "isUserExist", $params["request_datas"])->fetchAll(PDO::FETCH_ASSOC);
        if(count($res) == 0){
            echo json_encode(array("user_datas" => null, "posts" => array(), "message" => "kullanıcı bulunamadı", "status" => "fail", "successful" => false));
            exit;
        }
        
        $result = parent::model("Post", "fetchByUsername", $params["request_datas"]);
        #/////////////////////////
        $arr["user_datas"] = null;
        #\\\\\\\\\\\\\\\\\\\\\\\\\
        $arr["posts"] = $result->fetchAll(PDO::FETCH_ASSOC);
        $arr["successful"] = true;
        echo json_encode($arr);
    }
    /*
     * GET /api/get
     * post_id
     */
    static function fetch_by_id($params){
        parent::requiredFields(array("post_id"));
        $result = parent::model("Post", "fetch_by_id", $params["request_datas"])->fetchAll(PDO::FETCH_ASSOC);
        echo count($result) == 0
            ? '{"successful": false, "message": "post bulunamadı"}'
            : json_encode(array("successful" => true, "data" => $result[0]));
    }

    /*
     * endpoint: api/create
     * post keys:
     *      sahibi
     *      resim_yolu
     *      aciklama
     *      gizli_mi
     *  */
    static function create($args){
        parent::requiredFields(array("token"));
        //print_r($args["request_datas"]);
        $token = $args["request_datas"]["token"];
        try{
            $decoded = JWT::decode($token, new Key(JWT_KEY, "HS256"));
            //print_r($decoded);
            $id = $decoded->data->id;
            
            $array = $_SERVER["REQUEST_METHOD"] == "GET" ? $_GET : ($_SERVER["REQUEST_METHOD"] == "POST" ? $_POST : die("PostController.php - 15"));
            if(!isset($array["resim_yolu"]) && !isset($array["aciklama"])){
                echo '{"status": "unsuccessful", '
                . '"message": "post oluşturulamadı, resim ve açıklama aynı anda boş bırakılamaz"}';
                exit;
            }

            $args["request_datas"]["id"] = $id;
            $result = parent::model("Post", "create", $args["request_datas"]);

            // PostModel create methodunda olmayan $_POST verilerinden hata vermesin diye hata mesajları kapalıydı
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            echo '{"status": "successful", "successful": true, "message": "post oluşturuldu"}';
        } catch (Exception $ex) {
            echo '{"status": "unsuccessful", "successful": false, "message": "geçersiz token"}';
            exit;
        }
    }
    
    /*
     * api/update
     *      creator
     *      image_path
     *      title
     *      private
     *
     */
    static function update($args){
        if(count($args["request_datas"]) < 3){
            echo '{"status": "unsuccessful", "message": "eksik veri", "successful": false}';
            exit;
        }
        parent::requiredFields(array("post_id", "token"));
        $result = parent::model("Post", "update", $args["request_datas"]);
        echo $result
            ? '{"status": "successful", "successful": true, "message": "post güncellendi"}'
            : '{"status": "unsuccessful", "successful": false, "message": "güncellenemedi"}';
    }
    
    /*
     * endpoint: api/delete
     * post keys:
     *      post_id
     */
    static function delete($args){
        parent::requiredFields(Array("post_id", "token"));
        
        $token = $args["request_datas"]["token"];
        try{
            $decoded = JWT::decode($token, new Key(JWT_KEY, "HS256"));
                            
            $result = parent::model("Post", "delete", $args["request_datas"]);
            echo $result
                ? '{"status": "successful", "successful": true, "message": "post silindi"}'
                : '{"status": "unsuccessful", "successful": false, "message": "post silinemedi"}';
            
        } catch (Exception $ex) {
            echo '{"status": "unsuccessful", "successful": false, "message": "geçersiz token"}';
        }
    }
}