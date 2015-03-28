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

    function add($brand_id, $model) {
        $fg = true;
        $str = "insert into carmodel (name) values ('" . $model . "')";
                    
        try {
            $this->objDB->begin();
            $this->objDB->query($str);
            $model_id = mysql_insert_id();
            $str2 = "insert into brand_model_mapping (brand_id, model_id) values ('" .$brand_id. "', '" .$model_id. "' )";
            $this->objDB->query($str2);            
            $this->objDB->commit();
        } catch (Exception $ex) {
            $this->objDB->rollback();
            $fg = false;
        }
        
        return $fg;
    }

    function edit($model_id, $brand_id, $model_name) {
        $fg = true;
        
        try {
            $this->objDB->begin();
            $str = "update carmodel set name='" . $model_name . "' where id='" .$model_id. "' ";
            $this->objDB->query($str);
            $this->objDB->commit();
            $str2 = "update brand_model_mapping set brand_id='" .$brand_id. "' where model_id='" .$model_id. "' ";
            $this->objDB->query($str2);            
            $this->objDB->commit();
        } catch (Exception $ex) {
            $this->objDB->rollback();
            $fg = false;
        }
        
        return $fg;
    }

    function delete($brand_id, $model_id) {
        $fg = true;
        $str = "delete from brand_model_mapping where brand_id='" .$brand_id. "' and model_id='" .$model_id. "' ";
        
        try {
            $this->objDB->begin();
            $this->objDB->query($str);
            $str2 = "delete from carmodel where id='" . $model_id . "'";
            $this->objDB->query($str2);            
            $this->objDB->commit();
        } catch (Exception $ex) {
            $this->objDB->rollback();
            $fg = false;
        }
        
        return $fg;
    }

    function getModelAll() {
        $str = "select m.brand_id, cb.name as brand_name, m.model_id, cm.name as model_name "
                . "from brand_model_mapping m "
                . "left join carbrand cb on m.brand_id=cb.id "
                . "left join carmodel cm on m.model_id=cm.id ";
        
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

        $str = "select m.brand_id, cb.name as brand_name, m.model_id, cm.name as model_name "
                . "from brand_model_mapping m "
                . "left join carbrand cb "
                . "on m.brand_id=cb.id "
                . "left join carmodel cm "
                . "on m.model_id=cm.id ";
        
        $this->NUM_ROWS = mysql_num_rows($this->objDB->query($str));
        $rs = $this->objDB->query($str . $limit);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }

    function getModelById($model_id) {
        $str = "select m.brand_id, m.model_id, cb.name as brand_name, cm.name as model_name "
                . "from brand_model_mapping m "
                . "left join carbrand cb "
                . "on m.brand_id=cb.id "
                . "left join carmodel cm "
                . "on m.model_id=cm.id "
                . "where m.model_id='" .$model_id. "' ";
        
        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
    
    function getModelByBrand($brand_id) {
        $str = "select m.brand_id, m.model_id, cb.name as brand_name, cm.name as model_name "
                . "from brand_model_mapping m "
                . "left join carbrand cb "
                . "on m.brand_id=cb.id "
                . "left join carmodel cm "
                . "on m.model_id=cm.id "
                . "where m.brand_id='" . $brand_id . "'";
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
