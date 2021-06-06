<!--
		filename: signUpUser.php
		author: Johann Olivares
		date: 09/29/20
		version: v 1.1
		Brief: This php code serves to enter products into sql database.
		
-->
<!doctype html>
<html lang="eng">

    <head>
        <meta charset="UTF-8">
	    <title>E-Fit Home</title>

		<!--Favicon-->
		<link rel="icon" type="favicon.ico" href="img/eFitLogov3.png">
		<!--End of Favicom-->

	    <!--Google fonts-->
	    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
	    <!--End of Google fonts-->	   
	   
        <!--CSS Styles-->
	    <link rel="stylesheet" href="../css/index.css" type="text/css">
	    <!--End of CSS Styles-->
    </head>

    <body>
	<!--Navigation Bar-->
	<?php include('../php/header.php'); ?>
	<!--End of Navigation Bar-->

	<?php

		//If they click submit for the insertProductfiel then run code.
		if( isset($_POST['signup']) ) {
			//connects to dbcontroller.php file
			require_once("dbcontroller.php");
			$db_handle = new DBController();
			
			//Variable of item of elements to be INSERTED into database.
			$firstName = $_POST['fName'];
			$lastName = $_POST['lName'];
			$birthDate = $_POST['bDate'];
			$email = $_POST['email'];
			$password = $_POST['password']; 

			//validate user input
			
			//Connect to database
			$conn = $db_handle->connectDB();
			
			//INSERT Queries puts data into database
			$sql1 = mysqli_query($conn, "INSERT INTO Customers (FirstName, LastName, Birthdate) VALUES
										('$firstName', '$lastName', '$birthDate')", MYSQLI_USE_RESULT);
										
			$sql2 = mysqli_query($conn, "INSERT INTO CustomerAccounts(Email, Password) VALUES
										('$email', '$password')", MYSQLI_USE_RESULT);		
			
			//Query Validation
			if ($sql1 && $sql2) {
				//true, insert query is successful
				echo "<h1>Welcome $firstName $lastName</h1>";
				echo '<a href="../index.php">Start Shopping</a>';
				mysqli_close($conn);
			}
			else {
				//data failed to be inserted
				echo "<h1>Failed to insert</h1>";
				mysqli_close($conn);
			}	
		}//End of if statement
	?>

	<!--Footer-->
       <?php include('../php/footer.php'); ?>
   <!--End of Footer-->

    </body>
</html>