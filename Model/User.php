<?php

include_once 'DB.php';

class User extends DB{
    /*
     * username, password
     */
    public function login($sql_params){
        return parent::select("select * from kullanicilar where "
                . "kullanici_adi = '". parent::safe_input(parent::is_exist($sql_params['username'])) ."' and "
                . "sifre = '". parent::safe_input(parent::is_exist($sql_params['password'])) ."'");
    }
    /*
     * username, password, email
     */
    public function register($sql_params){
        return parent::execute("INSERT INTO "
                . "kullanicilar (kullanici_adi, sifre, email) "
                . "VALUES "
                . "("
                . "'". parent::safe_input(parent::is_exist($sql_params['username'])) ."',"
                . "'". parent::safe_input(parent::is_exist($sql_params['password'])) ."',"
                . "'". parent::safe_input(parent::is_exist($sql_params['email'])) ."'"
                . ")");
    }
}