<?php
class Database {
	private $con;
	private $host;
	private $username;
	private $password;
	private $result;
	private $db;
	
	function __construct() {
		$this->host = 'localhost';
		$this->username = 'root';
		$this->password = 'password1';
		$this->db = 'project';
		$this->connectDB();
	}
	
	function query($StrQuery) {
		mysql_query('set names utf8');
		$this->result = mysql_query( $StrQuery );
		return $this->result;
	}
	
	function connectDB() {
		$con = mysql_connect( $this->host, $this->username, $this->password ) or die("can't to connect");
		mysql_select_db($this->db) or die("can't select");
		return $con;
	}
        
        function hasRows(){
            if(mysql_num_rows($this->result)>0)
                return true;
        }
        
        function begin() {
            mysql_query("BEGIN");
        }
        
        function commit() {
            mysql_query("COMMIT");
        }
        
        function rollback() {
            mysql_query("ROLLBACK");
        }
}
?>
