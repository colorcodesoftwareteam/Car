<?php

include_once 'Database.php';
include_once 'Pagination.php';

class ManageModelCar {

    private $objDB;
    private $NUM_ROWS;
    private $PAGE_SIZE;
    
    function __construct() {
        $this->objDB = new Database ();
    }

    function add($brandid, $model) {
        $str = "insert into carmodel (brand_id,name) values ('" . $brandid . "','" . $model . "')";
        return $this->objDB->query($str);
    }

    function edit($id, $brand_id, $model) {
        $str = "update carmodel set name='" . $model . "', brand_id='" . $brand_id . "' where id = '" . $id . "'";
        return $this->objDB->query($str);
    }

    function delete($id) {
        $str = "delete from carmodel where id='" . $id . "'";
        return $this->objDB->query($str);
    }

    function getModelAll() {
        $str = "select cm.id, cm.name, cb.id as brand_id, cb.name as brand_name from carmodel cm
                left join carbrand cb on cm.brand_id=cb.id ";
        
        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
    
    function getModelAllPaging($pageSize, $page) {
        $this->PAGE_SIZE = $pageSize;
        $lim_start = (($page - 1) * $pageSize);
        $lim_end = $pageSize;
        $limit = "limit " . $lim_start . ", " . $lim_end;

        $str = "select cm.id, cm.name, cb.id as brand_id, cb.name as brand_name from carmodel cm
                left join carbrand cb on cm.brand_id=cb.id ";
        
        $this->NUM_ROWS = mysql_num_rows($this->objDB->query($str));
        $rs = $this->objDB->query($str . $limit);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }

    function getModelById($id) {
        $str = "select * from  carmodel where id='" . $id . "'";
        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
    
    function getModelByBrand($id) {
        $str = "select * from  carmodel where brand_id='" . $id . "'";
        $rs = $this->objDB->query($str);
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

?>
