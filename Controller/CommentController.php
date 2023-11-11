<?php
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class CommentController extends Controller{
    /*
     * post_id
     */
    public function get($params){
        parent::requiredFields(array("post_id"));
        $result = parent::model("Comment", "get", $params["request_datas"])->fetchAll(PDO::FETCH_ASSOC);
        echo $result
                ? json_encode(array("successful" => true, "data" => $result))
                : '{"successful": false, "message": "yorumlar yüklenemedi"}';
    }
    /*
     * /api/create-comment
     * yorum
     * post_id
     * token
     */
    public function create($params){
        parent::requiredFields(array("token", "yorum", "post_id"));
        $token = $params["request_datas"]["token"];
        try{
            $decoded = JWT::decode($token, new Key(JWT_KEY, "HS256"));
            $id = $decoded->data->id;
            $params["request_datas"]["id"] = $id;
        } catch (Exception $ex) {
            echo '{"status": "unsuccessful", "successful": false, "message": "geçersiz token"}';
            exit;
        }
        $result = parent::model("Comment", "create", $params["request_datas"]);
        echo $result
                ? '{"status": "successful", "successful": true, "message": "yorum yapıldı"}'
                : '{"status": "unsuccessful", "successful": false, "message": "yorum yapılamadı"}';
    }
    /*
     * id    --yorum_id
     */
    public function delete($params){
        parent::requiredFields(array("id", "token"));
        $token = $params["request_datas"]["token"];
        try{
            $decoded = JWT::decode($token, new Key(JWT_KEY, "HS256"));

            $result = parent::model("Comment", "delete", $params["request_datas"]);
            echo $result
                ? '{"successful": true, "message": "yorum silindi"}'
                : '{"successful": false, "message": "yorum silinemedi"}';
        } catch (Exception $ex) {
            echo '{"status": "unsuccessful", "successful": false, "message": "geçersiz token"}';
            exit;
        }    
    }
    
    /*
     * /api/get-replies
     * yorum_id
     */
    public function get_replies($params){
        parent::requiredFields(array("yorum_id"));
        $result = parent::model("Comment", "get_replies", $params["request_datas"])->fetchAll(PDO::FETCH_ASSOC);
        echo $result
                ? json_encode(array("successful" => true, "data" => $result))
                : '{"successful": false, "message": "yanıtlar yüklenemedi"}';
    }
    /*
     * /api/create-reply
     * yanıt
     * token
     * yorum_id
     */
    public function create_reply($params){
        parent::requiredFields(array("yanit", "token", "yorum_id"));
        $token = $params["request_datas"]["token"];
        try{
            $decoded = JWT::decode($token, new Key(JWT_KEY, "HS256"));
            $id = $decoded->data->id;
            $params["request_datas"]["id"] = $id;
        } catch (Exception $ex) {
            echo '{"status": "unsuccessful", "successful": false, "message": "geçersiz token"}';
            exit;
        }
        $result = parent::model("Comment", "create_reply", $params["request_datas"]);
        echo $result
                ? "true"
                : "false";
    }
    /*
     * /api/delete-reply
     * yanit_id
     */
    public function delete_reply($params){
        parent::requiredFields(array("id", "token"));
        $token = $params["request_datas"]["token"];
        try{
            $decoded = JWT::decode($token, new Key(JWT_KEY, "HS256"));

            $result = parent::model("Comment", "delete_reply", $params["request_datas"]);
            echo $result
                    ? '{"successful": true, "message": "yanit silindi"}'
                    : '{"successful": false, "message": "yanit silinemedi"}';
        } catch (Exception $ex) {
            echo '{"status": "unsuccessful", "successful": false, "message": "geçersiz token"}';
            exit;
        }
    }
}