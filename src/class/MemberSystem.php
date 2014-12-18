<?php

include_once 'Database.php';

class MemberSystem {

    private $objDB;

    function __construct() {
        $this->objDB = new Database();
    }

    function newMember($data) {

        $str = "insert into member (Role_id,name,lastname,gender,birthdate,address,phoneNumber,email,create_dt,update_dt) "
                . "values(2,'" . $data['name'] . "','" . $data['lname'] . "'," . $data['gender'] . ",'" . $data['birthday'] . "','" . $data['address'] . "','" . $data['phone'] . "','" . $data['email'] . "','" . date("Y-m-d  H:i:s") . "','" . date("Y-m-d  H:i:s") . "')";

        return $this->objDB->query($str);
    }

    function editMember($data) {
        $str = "update member set name='" . $data['POST']['name'] . "' , lastname='" . $data['POST']['lastname'] . "' ,  gender='" . $data['POST']['gender'] . "',birthdate='" . $data['POST']['birthdate'] . "',address='" . $data['POST']['address'] . "',phoneNumber='" . $data['POST']['phoneNumber'] . "',email='" . $data['POST']['email'] . "' where id = '" . $data['GET']['memberid'] . "'";
        return $this->objDB->query($str);
    }

    function deleteMember($data) {
        echo 'Deleted Member';
    }

    function getMemeberById($id) {
        $str = "select * from member where id='" . $id . "'";
        $rs = $this->objDB->query($str);
        $arrauIterator = new ArrayIterator();
        while ($row = mysql_fetch_object($rs)) {
            $arrauIterator->append($row);
        }
        return $arrauIterator;
    }

}
