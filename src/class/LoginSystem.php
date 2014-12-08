<?php

session_start();
include_once 'Database.php';

class LoginSystem {

    private $user;
    private $pass;
    private $objDB;

    function __construct() {
        $this->objDB = new Database();
    }

    function login($data) {
        $StrQuery = "SELECT * FROM MEMBER WHERE email ='" . $data['email'] . "' and phoneNumber = '" . $data['password'] . "'";
        $rs = $this->objDB->query($StrQuery);
        $row = mysql_fetch_object($rs);
        $_SESSION['id'] = $row->id;
        $_SESSION['Role_id'] = $row->Role_id;
        $_SESSION['name'] = $row->name;
        $_SESSION['lastname'] = $row->lastname;
        if ($this->objDB->hasRows())
            return true;
    }

    function logout() {
        session_destroy();
        return true;
    }

    function validate() {
        
    }

}
