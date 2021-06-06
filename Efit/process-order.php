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
	$fname = $_POST['fName'];

	//Check that cart is not empty
    if( isset($_SESSION["cart"]) ) {
        //connects to dbcontroller.php file
		require_once("dbcontroller/dbcontroller.php");
		$db_handle = new DBController();
		
		//Get user details
		$fname = $_POST['fName'];
		$lname = $_POST['lName'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip = $_POST['zip-code'];
		$country = $_POST['country-code'];

		//Variable of item of elements to be INSERTED into database.
		$customerID = uniqid();
		$orderStatus = "pending"; 
		$orderDate = date('m-d-Y'); 
		$orderID = uniqid();
		
		//Connect to database
		$conn = $db_handle->connectDB();

		//add customer
		$setGuest = mysqli_query($conn, "INSERT INTO Customers (CustomerID, FirstName, LastName) VALUES
		                                ('$customerID', '$fname', '$lname')", MYSQLI_USE_RESULT);

		$setAddress = mysqli_query($conn, "INSERT INTO CustomerAddresses (CustomerID, StreetAddress, City, HomeState, Country, ZipCode) VALUES
		                                  ('$customerID', '$address', '$city', '$state', '$country', '$zip')", MYSQLI_USE_RESULT);

		//INSERT Queries puts data into database
		$setOrder = mysqli_query($conn, "INSERT INTO Orders (CustomerID, OrderID, OrderStatus, OrderDate) VALUES
		                            ('$customerID', '$orderID', '$orderStatus', STR_TO_DATE('$orderDate', '%m-%d-%Y'))", MYSQLI_USE_RESULT);
		
    
		//Loop through all product and ass to a order
		foreach ($_SESSION["cart"] as $item) {

			//variables
			$qty = $item["quantity"];
			$id = $item["ItemID"];
			$code = $item["Code"];


			//run query
		    $setproduct = mysqli_query($conn, "INSERT INTO ProductOrders (OrderID, Code, ItemID, Quanity) VALUES
		                            ( '$orderID', '$code' ,'$id', '$qty')", MYSQLI_USE_RESULT);
			
		}
		
		//Query Validation
		if ($setGuest && $setAddress && $setOrder && $setproduct)  {
			//true, insert query is successful
			unset($_SESSION["cart"]);
			
		    mysqli_close($conn);

			//email conformation
			$to = $email;
            $subject = "Order Conformation";
            $txt = "Thank You For Your Order!";
            $headers = "From: EFit@gmail.com";

            mail($to,$subject,$txt,$headers);
			
			header("Location: conformation.php"); /* Redirect browser */
			exit;
		}
		else {
			//data failed to be inserted
			include('php/header.php');
			echo "<h1>Failed to Process Order</h1>";

			//close connection
			mysqli_close($conn);
			exit;
		}
		

         
	}
?>