<?php

include_once 'Database.php';

class ManageCar {

    private $objDB;
    private $NUM_ROWS;
    private $objUpload;
    
    function __construct() {
        $this->objDB = new Database ();
    }

    function add($brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank) {
        $str = "insert into car (brand_id, model_id, car_year, body_number, cylinder, fuel_tank, create_dt, update_dt) values ('" . $brandid . "','" . $modelid . "','" . $caryear . "','" . $bodynumber . "','" . $cylinder . "','" . $fueltank . "','" . date("Y-m-d  H:i:s") . "','" . date("Y-m-d  H:i:s") . "')";
        //exit();
        return $this->objDB->query($str);
    }

    function edit($id, $brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank) {;
        $str = "update car set  brand_id='" . $brandid . "', model_id='" . $modelid . "', car_year='" . $caryear . "', body_number='" . $bodynumber . "', cylinder='" . $cylinder . "', fuel_tank='" . $fueltank . "', update_dt='" . date("Y-m-d  H:i:s") . "' where id = '" . $id . "'";
        return $this->objDB->query($str);
    }

    function delete($id) {
        $str = "delete from car where id='" . $id . "'";
        return $this->objDB->query($str);
    }

    function getCarAll() {
        $str = "select c.id, c.brand_id, cb.name as brand_name, c.model_id, cm.name as model_name,
		c.car_year, c.body_number, c.cylinder, c.fuel_tank, c.color, c.detail, c.create_dt, c.update_dt 
                from car c left join carbrand cb on c.brand_id=cb.id 
		left join carmodel cm on c.model_id=cm.id 
                order by c.create_dt desc";
        return $this->objDB->query($str);
    }

	function getCarAllPaging() {
        $str = "select c.id, c.brand_id, cb.name as brand_name, c.model_id, cm.name as model_name,
		c.car_year, c.body_number, c.cylinder, c.fuel_tank, c.color, c.detail, c.create_dt, c.update_dt 
                from car c left join carbrand cb on c.brand_id=cb.id 
		left join carmodel cm on c.model_id=cm.id 
                order by c.create_dt desc";
        return $this->objDB->query($str);
    }
    
    function getSearchCarPaging($brand_id, $model_id, $year, $pageSize, $page) {
        $condition = "";
        $lim_start = (($page-1)*$pageSize);
        $lim_end = $lim_start+$pageSize;
        $limit = "limit ".$lim_start.", ".$lim_end;
        
        if ($brand_id != "") {
            $condition .= " c.brand_id='".$brand_id."' ";
        }
        if ($model_id != "") {
            $condition .= ($condition!=""?" AND":"")." c.model_id='".$model_id."' ";
        }
        if ($year != "") {
            $condition .= ($condition!=""?" AND":"")." c.car_year='".$year."' ";
        }
        if ($condition != "") {
            $condition = "WHERE ".$condition;
        }
        $str = "select c.id, c.brand_id, cb.name as brand_name, c.model_id, cm.name as model_name,
		c.car_year, c.body_number, c.cylinder, c.fuel_tank, c.color, c.detail, c.create_dt, c.update_dt 
                from car c left join carbrand cb on c.brand_id=cb.id 
		left join carmodel cm on c.model_id=cm.id 
                ".$condition." ".
                "order by c.id desc ";
        
        $this->NUM_ROWS = mysql_num_rows($this->objDB->query($str));
        $rs = $this->objDB->query($str.$limit);
        $arrayIterator = new ArrayIterator();
        
        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
    
    function getPageing($pageSize) {
        return ceil($this->NUM_ROWS/$pageSize);
    }

    function getCarById($id) {
        $str = "SELECT *
		FROM car , carbrand , carmodel 
		WHERE car.brand_id = carbrand.id AND 
		car.model_id = carmodel.id 
		AND car.id='" . $id . "'";
        return $this->objDB->query($str);
    }
    
    function  getCarYearAll() {
        $str = "SELECT distinct(car_year) FROM car order by car_year desc ";
        $this->objDB->query($str);
        
        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();
        
        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
}

?>