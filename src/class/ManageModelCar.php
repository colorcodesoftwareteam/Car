<?php
include_once 'Database.php';
class ManageModelCar {
	private $objDB;
	function __construct() {
		$this->objDB = new Database ();
	}
	function add($brandid, $model) {
		$str = "insert into carmodel (brand_id,name) values ('" . $brandid . "','" . $model . "')";
		return $this->objDB->query ( $str );
	}
	function edit($id, $brand_id, $model) {
		$str = "update carmodel set name='" . $model. "', brand_id='".$brand_id."' where id = '" . $id . "'";
		return $this->objDB->query ( $str );
	}
	function delete($id) {
		$str = "delete from carmodel where id='" . $id . "'";
		return $this->objDB->query ( $str );
	}
	function getModelAll() {
		$str = "select * from  carmodel ";
		return $this->objDB->query ( $str );
	}
	function getModelById($id) {
		$str = "select * from  carmodel where id='" . $id . "'";
		return $this->objDB->query ( $str );
	}
}

?>
