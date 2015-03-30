<?php

include_once 'Database.php';
include_once 'Pagination.php';

class ManageCar {

    private $objDB;
    private $NUM_ROWS;
    private $PAGE_SIZE;
    private $objUpload;

    function __construct() {
        $this->objDB = new Database ();
    }

    function add($brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank, $car_detail) {
        $fg = true;
        try {
            $this->objDB->begin();
            $str = "select id "
                . "from brand_model_mapping "
                . "where brand_id='" .$brandid. "' and model_id='" .$modelid. "' ";
            $rs = $this->objDB->query($str);
            $row = mysql_fetch_object($rs);
            $mapping_id = $row->id;     
            $str2 = "insert into car (brand_model_mapping_id, car_year, body_number, cylinder, fuel_tank, detail, create_dt, update_dt) "
                . "values ('" . $mapping_id . "','" . $caryear . "','" . $bodynumber . "','" . $cylinder . "','" . $fueltank . "', '" .$car_detail. "', '" . date("Y-m-d  H:i:s") . "','" . date("Y-m-d  H:i:s") . "')";
            $this->objDB->query($str2);          
            $this->objDB->commit();
        } catch (Exception $ex) {
            $this->objDB->rollback();
            $fg = false;
        }
        
        return $fg;
    }

    function edit($id, $brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank, $car_detail) {
        $fg = true;
        try {
            $this->objDB->begin();
            $str = "select id "
                . "from brand_model_mapping "
                . "where brand_id='" .$brandid. "' and model_id='" .$modelid. "' ";
            $rs = $this->objDB->query($str);
            $row = mysql_fetch_object($rs);
            $mapping_id = $row->id;     
            $str = "update car set brand_model_mapping_id='" . $mapping_id . "', car_year='" . $caryear . "', body_number='" . $bodynumber . "', cylinder='" . $cylinder . "', fuel_tank='" . $fueltank . "', detail='" .$car_detail. "', update_dt='" . date("Y-m-d  H:i:s") . "' where id = '" . $id . "'";
            $this->objDB->query($str);          
            $this->objDB->commit();
        } catch (Exception $ex) {
            $this->objDB->rollback();
            $fg = false;
        }
        
        return $fg;
    }

    function delete($id) {
        $str = "delete from car where id='" . $id . "'";
        $this->deleteImageByCarId($id);
        return $this->objDB->query($str);
    }	

    function deleteImageByCarId($car_id) {
        $str = "delete from carimages where car_id='" . $car_id . "'";
        $rs = $this->getImageByCarId($car_id);
        while ($row = mysql_fetch_object($rs)) {
            unlink($row->path);
        }
        return $this->objDB->query($str);
    }
    
    function deleteImageById($id) {
        $str = "delete from carimages where id='" . $id . "'";
        $rowImage = $this->getImageById($id);
        unlink($rowImage->path);
        return $this->objDB->query($str);
    }

    function getCarAllPaging($pageSize, $page) {
        $this->PAGE_SIZE = $pageSize;
        $lim_start = (($page - 1) * $pageSize);
        $lim_end = $pageSize;
        $limit = "limit " . $lim_start . ", " . $lim_end;

        $str = "select c.id, m.brand_id, cb.name as brand_name, m.model_id, cm.name as model_name,
		c.car_year, c.body_number, c.cylinder, c.fuel_tank, c.color, c.detail, c.create_dt, c.update_dt  
                from car c left join brand_model_mapping m on c.brand_model_mapping_id=m.id 
                left join carbrand cb on m.brand_id=cb.id 
		left join carmodel cm on m.model_id=cm.id 
                order by c.create_dt desc ";

        $this->NUM_ROWS = mysql_num_rows($this->objDB->query($str));
        $rs = $this->objDB->query($str . $limit);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }

    function getSearchCarPaging($brand_id, $model_id, $year, $pageSize, $page) {
        $condition = "";
        $this->PAGE_SIZE = $pageSize;
        $lim_start = (($page - 1) * $pageSize);
        $lim_end = $lim_start + $pageSize;
        $limit = "limit " . $lim_start . ", " . $lim_end;

        if ($brand_id != "") {
            $condition .= " m.brand_id='" . $brand_id . "' ";
        }
        if ($model_id != "") {
            $condition .= ($condition != "" ? " AND" : "") . " m.model_id='" . $model_id . "' ";
        }
        if ($year != "") {
            $condition .= ($condition != "" ? " AND" : "") . " c.car_year='" . $year . "' ";
        }
        if ($condition != "") {
            $condition = "WHERE " . $condition;
        }
        $str = "select c.id, m.brand_id, cb.name as brand_name, m.model_id, cm.name as model_name,
		c.car_year, c.body_number, c.cylinder, c.fuel_tank, c.color, c.detail, c.create_dt, c.update_dt 
                from car c left join brand_model_mapping m on c.brand_model_mapping_id=m.id 
                left join carbrand cb on m.brand_id=cb.id 
		left join carmodel cm on m.model_id=cm.id 
                " . $condition . " order by c.id desc ";

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

    function getCarById($id) {
        $str = "SELECT c.id, m.brand_id, cb.name as brand_name, m.model_id, cm.name as model_name,
		c.car_year, c.body_number, c.cylinder, c.fuel_tank, c.color, c.detail, c.create_dt, c.update_dt,
                im.id as img_id, im.path as img_path, im.name as img_name, im.detail as img_detail, im.create_dt as img_create_dt
                FROM car c LEFT JOIN brand_model_mapping m ON c.brand_model_mapping_id=m.id 
                LEFT JOIN carbrand cb ON m.brand_id=cb.id 
		LEFT JOIN carmodel cm ON m.model_id=cm.id 
                left join carimages im on c.id=im.car_id 
                WHERE c.id='" . $id . "' ";

        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }

    function getCarYearAll() {
        $str = "SELECT distinct(car_year) FROM car order by car_year desc ";
        $this->objDB->query($str);

        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }

    function getLastCar() {
        $str = "SELECT * FROM car ORDER BY id DESC ";
        $rs = $this->objDB->query($str);
        return mysql_fetch_object($rs);
    }

    function addImage($idCar, $name, $location, $detail) {
        $str = "insert into carimages (Car_id, name, path, detail) values ('" . $idCar . "','" . $name . "','" . $location . "', '" .$detail. "')";
        //exit();
        return $this->objDB->query($str);
    }
    
    function getCarImages($carID) {
        $str = "SELECT * FROM carimages WHERE car_id='" . $carID . "' order by id asc";

        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        return $arrayIterator;
    }
	
    function getCarImagesWithNoImage($carID) {
        $str = "SELECT * FROM carimages WHERE car_id='" . $carID . "' order by create_dt desc";

        $rs = $this->objDB->query($str);
        $arrayIterator = new ArrayIterator();

        while ($row = mysql_fetch_object($rs)) {
            $arrayIterator->append($row);
        }
        /*if ($arrayIterator->count() == 0) {
            $tmp_arr = [ 
                "name" => "",
                "path" => "img/no_img.jpg",
            ];
            $arrayIterator->append($tmp_arr);
        }*/
        return $arrayIterator;
    }

    function getImageByCarId($id) {
        $str = "SELECT *
		FROM carimages 
		WHERE car_id ='" . $id . "'
		";
        return $this->objDB->query($str);
    }

    function getImageById($id) {
        $str = "SELECT *
		FROM carimages 
		WHERE id ='" . $id . "'
		";
        $rs = $this->objDB->query($str);
        $row = mysql_fetch_object($rs);
        return $row;
    }

}

?>
