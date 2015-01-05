<?php

include_once 'Database.php';
include_once 'Pagination.php';

class MemberSystem {

    private $objDB;
    private $NUM_ROWS;
    private $PAGE_SIZE;
    
    function __construct() {
        $this->objDB = new Database();
    }

    function newMember($data) {
        $str = "insert into member (role_id,name,lastname,gender,birthdate,address,phoneNumber,email,password,create_dt,update_dt) "
                . "values(2,'" . $data['name'] . "','" . $data['lname'] . "'," . $data['gender'] . ",'" . $data['birthday'] . "','" . $data['address'] . "','" . $data['phone'] . "','" . $data['email'] . "','". $data['password'] ."','" . date("Y-m-d  H:i:s") . "','" . date("Y-m-d  H:i:s") . "')";

        return $this->objDB->query($str);
    }

    function editMember($data) {
        $str = "update member set role_id='" .(isset($data['POST']['role']) ? $data['POST']['role'] : '2'). "', name='" . $data['POST']['name'] . "' , lastname='" . $data['POST']['lastname'] . "' ,  gender='" . $data['POST']['gender'] . "',birthdate='" . $data['POST']['birthdate'] . "',address='" . $data['POST']['address'] . "',phoneNumber='" . $data['POST']['phoneNumber'] . "',email='" . $data['POST']['email'] . "',password='". $data['POST']['password'] ."' where id = '" . $data['GET']['memberid'] . "'";
        return $this->objDB->query($str);
    }

    function deleteMember($id) {
        $str = "delete from member where id='" .$id. "'";
        return $this->objDB->query($str);
    }

    function getMemeberById($id) {
        $str = "select m.id, m.role_id, m.name, m.lastname, m.gender, m.birthdate, m.address, m.phoneNumber, 
                m.email, m.password, m.detail, m.create_dt, m.update_dt, r.name as role_name, r.detail as role_detail 
                from member m left join role r on m.role_id=r.id 
                where m.id='" . $id . "'";
        $rs = $this->objDB->query($str);
        $arrauIterator = new ArrayIterator();
        while ($row = mysql_fetch_object($rs)) {
            $arrauIterator->append($row);
        }
        return $arrauIterator;
    }
    
    function getMemberAllPaging($pageSize, $page) {
        $this->PAGE_SIZE = $pageSize;
        $lim_start = (($page - 1) * $pageSize);
        $lim_end = $pageSize;
        $limit = "limit " . $lim_start . ", " . $lim_end;

        $str = "select m.id, m.role_id, m.name, m.lastname, m.gender, m.birthdate, m.address, m.phoneNumber, 
                m.email, m.password, m.detail, m.create_dt, m.update_dt, r.name as role_name, r.detail as role_detail 
                from member m left join role r on m.role_id=r.id 
                order by m.create_dt desc ";

        $this->NUM_ROWS = mysql_num_rows($this->objDB->query($str));
        $rs = $this->objDB->query($str . $limit);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
    
    function getPaging($page, $currentPage) {
        Pagination::getPaging($page, $currentPage, $this->NUM_ROWS, $this->PAGE_SIZE);
    }
}
