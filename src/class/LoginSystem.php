<?php

session_start();
include_once 'Database.php';

class LoginSystem {

    private $user;
    private $pass;
    private $objDB;
    private $profile;

    function __construct() {
        $this->objDB = new Database();
    }

    function setData($data) {
        $this->user = $data['email'];
        $this->pass = $data['password'];
    }

    function login() {
        if (!$this->checkUsername() || !$this->validate()) {
            return false;
        }
        $_SESSION['memberId'] = $this->profile->id;
        $_SESSION['Role_id'] = $this->profile->Role_id;
        $_SESSION['name'] = $this->profile->name;
        $_SESSION['lastname'] = $this->profile->lastname;
        return true;
    }

    function logout() {
        session_destroy();
        return true;
    }

    function checkUsername() {
        $StrQuery = "SELECT * FROM MEMBER WHERE email ='" . $this->user . "'";
        $this->objDB->query($StrQuery);
        if ($this->objDB->hasRows())
            return true;
    }

    function validate() {
        $StrQuery = "SELECT * FROM MEMBER WHERE email ='" . $this->user . "' and phoneNumber = '" . $this->pass . "'";
        $rs = $this->objDB->query($StrQuery);
        $this->profile = mysql_fetch_object($rs);
        if ($this->objDB->hasRows())
            return true;
    }

}
