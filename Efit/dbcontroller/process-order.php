<!--CSS Styles-->
<link rel="stylesheet" href="../css/index.css" type="text/css">
<!--End of CSS Styles-->

<?php
	/*filename: process-order.php
	* author: Johann Olivares
	* date: 03/06/2021
	* version: v 1.1
	* 
    * Description: This php code saves the user shipping information
    *               to the Efit database.
	*/
	
	//Display completion order.
    session_start();
	//Check that cart is not empty
    if( isset($_SESSION["cart"]) ) {
        //connects to dbcontroller.php file
		//require_once("dbcontroller.php");
		//$db_handle = new DBController();
		
		//Variable of item of elements to be INSERTED into database.
		$customerID = 1;
		$orderStatus = "pending"; 
		$orderDate = date('m/d/Y'); 
		
		echo $customerID;
		echo $orderStatus;
		echo $orderDate;
		//Connect to database
		//$conn = $db_handle->connectDB();
		
		//INSERT Queries puts data into database
		//$setOrder = mysqli_query($conn, "INSERT INTO Orders (CustomerID, OrderStatus) VALUES
		                            //('$customerID', '$orderStatus')", MYSQLI_USE_RESULT);
		
		//Loop through all product and ass to a order
		foreach ($_SESSION["cart"] as $items) {

			//variables
			$qty = items["quantity"];
			$id = items["ItemID"];
			echo $qty;
			echo $id;

			//run query
			//$setproduct = mysqli_query($conn, "INSERT INTO ProductOrders (ItemID, Quanity) VALUES
		                            //('$id', '$qty')", MYSQLI_USE_RESULT);
			
		}
		
		//Query Validation
		if ($customerID == 1) {
			//true, insert query is successful
			include('../php/header.php');
	        echo '<h1> Thank You For Your Order! </h1';
			
			//mysqli_close($conn);
		}
		else {
			//data failed to be inserted
			include('../php/header.php');
			echo "<h1>Failed to Process Order</h1>";

			//close connection
			//mysqli_close($conn);
		}	

         
	}
?>