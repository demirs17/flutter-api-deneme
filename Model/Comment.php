<?php
include_once 'DB.php';

class Comment extends DB{
    public function create($params){
        return parent::execute("insert into yorumlar(sahibi, post_id, yorum) values("
                . parent::safe_input(parent::is_exist($params["id"])) . ","
                . parent::safe_input(parent::is_exist($params["post_id"])) . ", '"
                . parent::safe_input(parent::is_exist($params["yorum"])) . "')");
    }
    public function get($params){
        return parent::select("select * from yorumlar where post_id = " . parent::safe_input(parent::is_exist($params["post_id"])));
    }
    public function delete($params){
        return parent::execute("delete from yorumlar where id = " . parent::safe_input(parent::is_exist($params["id"])));
    }
    
    
    public function get_replies($params){
        return parent::select("select * from yanitlar where yorum_id = " . parent::safe_input(parent::is_exist($params["yorum_id"])));
    }
    public function create_reply($params){
        return parent::execute("insert into yanitlar(sahibi, yorum_id, yanit) values("
                . parent::safe_input(parent::is_exist($params["id"])) . ","
                . parent::safe_input(parent::is_exist($params["yorum_id"])) . ", '"
                . parent::safe_input(parent::is_exist($params["yanit"])) . "')");
    }
    public function delete_reply($params){
        return parent::execute("delete from yanitlar where id = " . parent::safe_input(parent::is_exist($params["id"])));
    }
}