<?php

include_once 'DB.php';

class Post extends DB{
    public function fetch_time($params){
        return parent::select("select * from gonderiler");
    }
    public function isUserExist($params){
        return parent::select("select * from kullanicilar where kullanici_adi = '". parent::safe_input(parent::is_exist($params["username"])) ."'");
    }
    
    public function fetchByUsername($params){
        return parent::select("select kullanicilar.kullanici_adi, gonderiler.* from gonderiler, kullanicilar where kullanicilar.id = gonderiler.sahibi and kullanici_adi = '" . parent::safe_input(parent::is_exist($params["username"])) . "'");
    }
    public function fetch_by_id($params){
        return parent::select("select * from gonderiler where id = " . parent::safe_input(parent::is_exist($params["post_id"])));
    }
    /*
     * sahibi, resim_yolu, aciklama, gizli_mi
     */
    public function create($sql_params){
        error_reporting(0);
        ini_set('display_errors', 0);
        return parent::execute("insert into gonderiler(sahibi, resim_yolu, aciklama, gizli_mi) "
                . "values("
                . "". parent::safe_input(parent::is_exist($sql_params['id'], 0)) .","
                . "'". parent::safe_input(parent::is_exist($sql_params['resim_yolu'])) ."',"
                . "'". parent::safe_input(parent::is_exist($sql_params['aciklama'])) ."',"
                . "". parent::safe_input(parent::is_exist($sql_params['gizli_mi'], 0)) .")");
    }
    
    /*
     * post_id ve en az bir column gerekli
     */
    public function update($sql_params){
        $sutun_karsiliklari = array(
            "creator" => "sahibi",
            "image_path" => "resim_yolu",
            "title" => "aciklama",
            "private" => "gizli_mi"
        );
        $sql = "update gonderiler set ";
        
        $i=0;
        foreach($sql_params as $key => $val){
            if($key != "post_id"){
                $sql .= $sutun_karsiliklari[$key] . " = '" . parent::safe_input(parent::is_exist($val), "null") . "'";
                //echo $sutun_karsiliklari[$key] . " - " . " i: " . $i . " count sqlparams: " . count($sql_params) . "\n";
                if($i != count($sql_params) - 2){
                    $sql .= ", ";
                }
            }
            $i++;
        }
        
        $sql .= " where id = '".parent::safe_input(parent::is_exist($sql_params["post_id"], 0))."'";
        return parent::execute($sql);
    }
    /*
     * post_id
     */
    public function delete($sql_params){
        return parent::execute("delete from gonderiler where id = " . parent::safe_input(parent::is_exist($sql_params["post_id"], 0)));
    }
}