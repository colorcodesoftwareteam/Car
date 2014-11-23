<?php
include_once 'Database.php';
class ManageCar {
	private $objDB;
	function __construct() {
		$this->objDB = new Database ();
	}
	function add($brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank) {
		$str = "insert into car (brand_id, model_id, car_year, body_number, cylinder, fuel_tank) values ('" . $brandid . "','" . $modelid . "','" . $caryear . "','" . $bodynumber . "','" . $cylinder . "','" . $fueltank . "')";
		//exit();
		return $this->objDB->query ( $str );
	}
	function edit($id, $brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank) {
		$str = "update car set  brand_id='" . $brandid . "', model_id='".$modelid."', car_year='$caryear', body_number='".$bodynumber."', cylinder='".$cylinder."', fuel_tank='".$fueltank."' where id = '" . $id . "'";
		return $this->objDB->query ( $str );
	}
	function delete($id) {
		$str = "delete from car where id='" . $id . "'";
		return $this->objDB->query ( $str );
	}
	function getCarAll() {
		$str = "select * from  car ";
		return $this->objDB->query ( $str );
	}
	function getCarById($id) {
		$str = "select * from  car where id='" . $id . "'";
		return $this->objDB->query ( $str );
	}
}

?>