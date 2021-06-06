<!DOCTYPE html>
<html>
	<head>
		<title>Add Product</title>

		<!--Favicon-->
		<link rel="icon" type="favicon.ico" href="img/eFitLogov3.png">
		<!--End of Favicom-->

	    <!--Google fonts-->
	    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
	    <!--End of Google fonts-->	   
	   
        <!--CSS Styles-->
		<link rel="stylesheet" href="css/add.css" type="text/css">
	    <!--End of CSS Styles-->
		
	</head>
    <!--Header-->
	<?php include('php/header.php');?>
    <!--End of Header-->

	<body>
	    

		<!--AddProduct Form Start-->
		<div id="form-container">
			<h1>Add Product</h1>
			<form class="add-form" action="addProduct.php" method="post">
				<table class="add-table">
					<tr>
						<td>ItemID:</td>
						<td><input type="text" name="id" required>
					</tr>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name" required>
					</tr>
					<tr>
						<td>Image:</td>
						<td><input type="text" name="image" required>
					</tr>	
					<tr>
						<td>Price:</td>
						<td><input type="text" name="price" required>
					</tr>

				</table>

				<div class="add-btn">
					<input type="submit" name="submit" value="Add Product">
				</div>
			</form>
		</div>
		<!--AddProduct Form End -->

	   <!--Product Listings-->
	   
	   <section class="list-container">	   
	   <h1 id="productHeader">Products</h1>
	       <div class="table">
			   <table>	
				   <tr>
				        <th>Product</th>
						<th>ItemID</th>
						<th>Unit Price</th>
						<th>Remove</th>
                   </tr>
		           <?php
		           require_once("dbcontroller/dbcontroller.php");
		           $db_handle = new DBController();
		           $product_array = $db_handle->runQuery("SELECT ItemID, Name, Image, Price
							FROM Products JOIN Price USING(ItemID)
							ORDER BY ItemID ASC");
					if(!empty($product_array)) {
						foreach($product_array as $key=>$value) { 
		 
					?>	
				   <tr>
						<td><img src="<?php echo $product_array[$key]["Image"]; ?>" height="120" width="105"/><?php echo $product_array[$key]["Name"]; ?></td>
						<td><?php echo $product_array[$key]["ItemID"]; ?></td>
						<td><?php echo "$ ".$product_array[$key]["Price"]; ?></td>
						<td>
						    <a href="addProduct.php?action=remove&code=<?php echo $product_array[$key]["ItemID"]; ?>" class="btnRemoveAction">
							    <img src="img/icon-delete.png" alt="Remove Item" />
							</a>
						</td>
					</tr>

			       <?php
			          }
			       }
			       ?>
				   
			    </table>
	       </div>
	   </section>
	   <!--End of Product Listings-->
    
	     <!--Footer-->
		<?php include('php/footer.php');?>
		<!--End of Footer-->

	</body>
</html>	
<?php
	/*filename: insert.php
	* author: Johann Olivares
	* date: 09/29/20
	* version: v 1.1
	* Brief: This php code serves to enter products into sql database.
	*        
	*/
	
	//If they click submit then run code.
	if(isset($_POST['submit'])) {
		//connects to dbcontroller.php file
		require_once("dbcontroller/dbcontroller.php");
		$db_handle = new DBController();
		
		//Variable of item of elements to be INSERTED into database.
		$itemID = $_POST['id'];
		$name = $_POST['name'];
		$image = $_POST['image'];
		$price = $_POST['price']; 
		
		//Connect to database
		$conn = $db_handle->connectDB();
		
		//INSERT Queries puts data into database
		$sql1 = mysqli_query($conn, "INSERT INTO Products (ItemID, Name, Image, Price) VALUES
		                            ('$itemID', '$name', '$image', $price)", MYSQLI_USE_RESULT);
										
		
		//Query Validation
		if ($sql1) {
			//true, insert query is successful
			echo "<h1>Data inserted</h1>";
			
			mysqli_close($conn);
		}
		else {
			//data failed to be inserted
			echo "<h1>Failed to insert</h1>";
			mysqli_close($conn);
		}	
	}//End of if statement

	if(!empty($_GET["action"])) {

        //connects to dbcontroller.php file
		require_once("dbcontroller/dbcontroller.php");
		$db_handle = new DBController();
		
		//Variable of item of elements to be INSERTED into database.
		$ID = $_GET["code"];
		
		//Connect to database
		$conn = $db_handle->connectDB();
		
		$deleteItem = mysqli_query($conn, "DELETE FROM Products
		                             WHERE ItemID = $ID", MYSQLI_USE_RESULT);		
		
		//Query Validation
		if ($deleteItem) {
			//true, insert query is successful
			echo "<h1>Data Removed</h1>";
			
			mysqli_close($conn);
		}
		else {
			//data failed to be inserted
			echo "Failed to remove";

			mysqli_close($conn);

		}	

	} 
?>