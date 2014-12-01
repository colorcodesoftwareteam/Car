<?php

include 'Database.php';

class MemberSystem {

    private $objDB;

    function __construct() {
        $this->objDB = new Database();
    }

    function newMember($data) {

        $str = "insert into member (Role_id,name,lastname,gender,birthdate,address,phoneNumber,email,create_dt,update_dt) "
                . "values(1,'" . $data['name'] . "','" . $data['lname'] . "'," . $data['gender'] . ",'" . $data['birthday'] . "','" . $data['address'] . "','" . $data['phone'] . "','" . $data['email'] . "','" . date("Y-m-d  H:i:s") . "','" . date("Y-m-d  H:i:s") . "')";

        return $this->objDB->query($str);
    }

    function editMember() {
        echo 'Edited Member';
    }

    function deleteMember() {
        echo 'Deleted Member';
    }

}
