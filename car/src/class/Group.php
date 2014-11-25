<?php
Class Group {
	
	private $groupName;
	
	function __construct($name){
		$this->groupName=$name;
	}
	
	function setgroupName($name){
		$this->groupName=$name;
	}
	
	function getgroupName(){
		return $this->groupName;
	}
	
	
	
}