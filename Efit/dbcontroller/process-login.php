<!--
		filename: signUpUser.php
		author: Johann Olivares
		date: 09/29/20
		version: v 1.1
		Brief: This php code serves to enter products into sql database.
		
-->


	<?php
	   $customerID = 0;

		//If they click submit for the insertProductfiel then run code.
		if( isset($_POST['login']) ) {
			//connects to dbcontroller.php file
			require_once("dbcontroller.php");
			$db_handle = new DBController();
			
			//Variable of item of elements to be INSERTED into database.
			$email = $_POST['email'];
			$password = $_POST['password']; 

			//validate user input
			
			//Connect to database
			$conn = $db_handle->connectDB();
			
			//INSERT Queries puts data into database
			$query = mysqli_query($conn, "SELECT CustomerID, Email, Password
                                         FROM CustomerAccounts
                                         WHERE Email = '$email' && Password = '$password'");
										
			//Query Validation
			if (mysqli_num_rows($query) > 0) {
				//true, insert query is successful
				
				echo "<h1>Welcome $email</h1>";
				include("../index.php");

				mysqli_free_result($query);
				mysqli_close($conn);
			}
			else {
				//data failed to be inserted
				include("../login.php");
				echo "<h1>Username or Password is incorrect. Try Again</h1>";

				mysqli_free_result($query);
				mysqli_close($conn);
			}	
		}//End of if statement
	?>


    </body>
</html>