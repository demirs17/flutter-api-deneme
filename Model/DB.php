<?php
class DB{
    private $conn;
    public function __construct() {
        $this->conn = null;
        try{
            $dsn = "mysql:host=". DB_SERVER .";dbname=" . DB_DBNAME;
            $this->conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
        } catch (Exception $e) {
            die(json_encode(Array("status" => "error", "message" => "failed to connect database" . $e->getMessage())));
        }
    }
    public function __destruct() {
        $this->conn = null;
    }
    public function select($sql){
        $db = new self();
        $result = $db->conn->query($sql);
        return $result;
    }
    public function execute($sql, $params = Array()){
        $db = new self();
        $query = $db->conn->prepare($sql);
        $success = $query->execute(array_values($params));
        return $success;
    }
    public function is_exist($var, $yerine = "null"){
        return isset($var) ? $var : $yerine;
    }
    protected function safe_input($input, bool $htmlspecialchars = true, bool $trim = true, bool $stripslashes = true){
        $trim = $trim . " \n\r\t\v\x00";
        $data = $htmlspecialchars ? htmlspecialchars($input) : $input;
        $data = $trim ? trim($data) : $data;
        $data = $stripslashes ? stripslashes($data) : $data;
        return $data;
    }
}

//class DB{
//    protected $conn;
//    public function __construct() {
//        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DBNAME);
//        if($this->conn->connect_error){
//            die(json_encode(Array("status" => "failure", "message" => "Veri tabanına bağlanamadı")));
//        }
//    }
//    public function __destruct() {
//        $this->conn->close();
//    }
//    public function exec($sql){
//        return $this->conn->query($sql);
//    }
//}