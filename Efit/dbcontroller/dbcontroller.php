<?php
class DBController {
	//Database connection variables
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "efit";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
   
	//Create Connection
	function connectDB() {
		$conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
		//Check Connection
		if ($conn->connect_error) {
		    die("Connection fail: " . $conn->connect_error);
	    }
		return $conn;
	}
	
	//MySQL query result
	function runQuery($query) {
		//Execute query
		$result = mysqli_query($this->conn, $query);
        
		//Loop through $result and store in and array
		while($row = mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
		    //return array result if not empty
			return $resultset;
	}
	
	//MySQL query result number of rows
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
}
?>
