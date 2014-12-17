<?php

include_once 'Database.php';

class ManageBrandCar {

    private $objDB;
    private $NUM_ROWS;
    private $PAGE_SIZE;
    
    function __construct() {
        $this->objDB = new Database ();
    }

    function add($name) {
        $str = "insert into carbrand (name) values ('" . $name . "')";
        return $this->objDB->query($str);
    }

    function edit($id, $newname) {
        $str = "update carbrand set name='" . $newname . "' where id = '" . $id . "'";
        return $this->objDB->query($str);
    }

    function delete($id) {
        $str = "delete from carbrand where id='" . $id . "'";
        return $this->objDB->query($str);
    }

    function getBrandAll() {
        $str = "select * from  carbrand ";
        
        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
    
    function getBrandAllPaging($pageSize, $page) {
        $this->PAGE_SIZE = $pageSize;
        $lim_start = (($page - 1) * $pageSize);
        $lim_end = $pageSize;
        $limit = "limit " . $lim_start . ", " . $lim_end;
        
        $str = "select * from  carbrand ";
        
        $this->NUM_ROWS = mysql_num_rows($this->objDB->query($str));
        $rs = $this->objDB->query($str . $limit);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }

    function getBrandById($id) {
        $str = "select * from  carbrand where id='" . $id . "'";
        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
    
    function getPageing() {
        return ceil($this->NUM_ROWS / $this->PAGE_SIZE);
    }
}

?>
