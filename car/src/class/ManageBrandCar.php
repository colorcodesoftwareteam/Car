<?php
include_once 'Database.php';
class ManageBrandCar {
	private $objDB;
	
	function __construct() {
		$this->objDB = new Database ();
	}
	
	function add($name) {
		$str = "insert into carbrand (name) values ('" . $name . "')";
		return $this->objDB->query ( $str );
	}
	
	function edit($id, $newname) {
		$str = "update carbrand set name='" . $newname . "' where id = '" . $id . "'";
		return $this->objDB->query ( $str );
	}
	
	function delete($id) {
		$str = "delete from carbrand where id='" . $id . "'";
		return $this->objDB->query ( $str );
	}
	
	function getBrandAll() {
		$str = "select * from  carbrand ";
		return $this->objDB->query ( $str );
	}
	
	function getBrandById($id) {
		$str = "select * from  carbrand where id='" . $id . "'";
		return $this->objDB->query ( $str );
	}
}

?>
