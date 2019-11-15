<?php
date_default_timezone_set('Europe/Moscow');
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");
mb_http_input("UTF-8");


class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "test";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        $conn->set_charset("utf8");
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>