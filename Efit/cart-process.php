<?php
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
                        'UnitTotal'=>$item[0]["Price"] * $_POST["quantity"],
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

    //present
    $total_quantity = 0;
	$total_price = 0;
	
	foreach ($_SESSION["cart"] as $item) {

		$item_price = $item["quantity"] * $item["Price"];
			
		$total_quantity += $item["quantity"];
		$total_price += ($item["Price"]*$item["quantity"]);

        $_SESSION["total"] = $total_price;
        $_SESSION["totalQty"] = $total_quantity;
	}
    
    header("Location: shopCart.php");
}

?>