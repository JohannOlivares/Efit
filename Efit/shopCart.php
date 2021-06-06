<?php
/*
session_start();
//Connect to database
require_once("dbcontroller/dbcontroller.php");
$db_handle = new DBController();

//When button is clicked
if(!empty($_GET["action"])) {
	///Add/Remove/Empty Cart operations
	switch($_GET["action"]) {
		case "add":
			//Check if quanity is not empty
			if(!empty($_POST["quantity"])) {
				
				//Run query and to get item details
				$item= $db_handle->runQuery("SELECT Code, ItemID, Name, Price, Image
											 FROM Products 
											 WHERE Code ='" . $_GET["code"] . "'");
				//Create array 	to hold data
				$itemArray = array(
					$item[0]["Code"] => array(
						'ItemID'=>$item[0]["ItemID"],
					    'Name'=>$item[0]["Name"],
					    'Code'=>$item[0]["Code"], 
					    'quantity'=>$_POST["quantity"],
					    'Price'=>$item[0]["Price"],
					    'Image'=>$item[0]["Image"]));

				//check if cart is NOT empty
				if(!empty($_SESSION["cart"])) {
					//get cart iem keys and item id
					$arrayKeyList = array_keys($_SESSION["cart"]);

					$id = $item[0]["Code"];
					//print_r($_SESSION);

					//if item is already in cart
					if( in_array($id, $arrayKeyList) ) {
						//echo '<h1>match</h1>';
						//Find item in cart
						foreach($_SESSION["cart"] as $k => $v) {
							
							//item is found
							if($id == $k) {

								//if qty is empty 
								if(empty($_SESSION["cart"][$k]["quantity"])) {
									
									//set qty to zero
									$_SESSION["cart"][$k]["quantity"] = 0;
								}
								
								//Increase quanity
								$_SESSION["cart"][$k]["quantity"] += $_POST["quantity"];
							}
						}
					 }	
					 else {
						 
						$_SESSION["cart"] = array_merge($_SESSION["cart"], $itemArray);
					}
				}	
				//Assign session array eqaul to itemArray
				else {
					$_SESSION["cart"] = $itemArray;
				}
			}
		break;
		//Item removed from cart
		case "remove":
			if(!empty($_SESSION["cart"])) {
				foreach($_SESSION["cart"] as $k => $v) {
						//If the Code retrieved is equal to the one in the array then
						if($_GET["code"] == $k) {
							//delete that item off the array
							unset($_SESSION["cart"][$k]);
						}
						
						if(empty($_SESSION["cart"])) {
							unset($_SESSION["cart"]);
						}
				}
			}
		break;
		//Empty Shopping cart
		case "empty":
			unset($_SESSION["cart"]);
	        break;	
	}
}
*/
?>
<!doctype html>
<html lang="eng">

    <head>
        <meta charset="UTF-8">
	    <title>Shopping Cart</title>

        <!--CSS Styles-->
	    <link rel="stylesheet" href="css/cart.css" type="text/css">
	    <!--End of CSS Styles-->

    </head>
    <!--Navigation Bar-->
    <?php include('php/header.php'); ?>
    <!--End of Navigation Bar-->	
   
   <body> 
	    <!--Shopping Cart -->
		<section id="shopping-cart">
			<div class="shop-heading"><h2>Shopping Cart</h2></div>
			
			<?php
			session_start();
			if(isset($_SESSION["cart"])){
				$total_quantity = 0;
				$total_price = 0;
			?>	
			<div class="cart-table-container">
				<table class="cart-table">
					<tr>
						<th>Product</th>
						<th>Name</th>
						<th>Quanity</th>
						<th>Unit Price</th>
						<th>Total Price</th>
						<th>Remove</th>
					</tr>
					<?php		
						foreach ($_SESSION["cart"] as $item){
							//$item_price = $item["quantity"] * $item["Price"];
							
							?>
					<tr>
						<td><img src="<?php echo $item["Image"]; ?>" height="120" width="105"/></td>
						<td><?php echo $item["Name"]; ?></td>
						<td><?php echo $item["quantity"]; ?></td>
						<td><?php echo "$ ".$item["Price"]; ?></td>
						<td><?php echo "$ ". number_format($item["UnitTotal"], 2); ?></td>
						<td>
						    <a href="cart-process.php?action=remove&code=<?php echo $item["Code"]; ?>" class="btnRemoveAction">
							    <img src="img/icon-delete.png" alt="Remove Item" />
							</a>
						</td>
					</tr>
					<?php

						} //end of loop
					?>
					<tr>
						<td colspan="2"></td>
						<td><?php echo $_SESSION["totalQty"]; ?></td>
						<td colspan="3" text-align="center"><strong>Total: <?php echo "$ ".number_format($_SESSION["total"], 2); ?></strong></td>
					</tr>
				</table>
			</div>	
			
			<!--Checkout button-->
			<div class="align-right">
				<a class="btn-action" name="check_out" href="checkout.php"> Go To Checkout </a>
				<a id="btn-empty" href="cart-process.php?action=empty"> Empty Cart </a>
			</div>
			<!--Checkout button-->
			
			<?php
			} else {
			?>
			<div class="no-items"><h2>Your Cart is Empty</h2></div>
			<?php 
			}
			?>
	   </section>
	   <!--End of Shopping Cart-->
	   
	   <!--Banner Product Slider-->
	   <h1 id="productHeader">Best Selling</h1>
	   <section class="product-slider">

	       <div class="slider-btn-left">
		       <button><</button>
		   </div>	   

		   <?php
		   //Connect to database
		   require_once("dbcontroller/dbcontroller.php");
		   $db_handle = new DBController();
		   //Run and store query
		   $product_array = $db_handle->runQuery("SELECT Code, ItemID, Name, Image, Price
							    FROM Products
							    ORDER BY Price DESC
							    LIMIT 5");
		    //Loop and display content
		   if(!empty($product_array)) {
			   foreach($product_array as $key=>$value) { ?>

			   <div class="product-item">
				  <form class="item" method="post" action="cart-process.php?action=add&code=<?php echo $product_array[$key]["Code"]; ?>">
					 <div class="image">
						 <a href="productPage.php?code=<?php echo $product_array[$key]["Code"]; ?>">
						     <img src="<?php echo $product_array[$key]["Image"]; ?>" width="230" height="250">
						</a>
					</div>
					 <div class="name"><?php echo $product_array[$key]["Name"]; ?></div>
					 <div class="price"><?php echo "$".$product_array[$key]["Price"]; ?></div>

					 <div class="item-details"
					     <div class="cart-action">
						     Qty:<input type="text" class="productQuantity" name="quantity" value="1" size="2" />
						     <input class="add-btn" type="submit" value="Add to Cart" />
					    </div>
			        </div>

				  </form>
			   </div>
			   <?php
			   }
			}
			?>

			<div class="slider-btn-right">
		       <button> > </button>
		   </div>

	   </section>
	   <!--End of Banner Product Slider-->	 
	
	   <!--Footer-->
		  <?php include('php/footer.php'); ?>
	   <!--End of Footer-->
	   
   </body>
</html>