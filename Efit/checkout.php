<!doctype html>
<html lang="eng">
   <head>
       <meta charset="UTF-8">
	   <title>E-Fit Home</title>

	   <!--Google fonts-->
	   <link rel="preconnect" href="https://fonts.gstatic.com">
       <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
	   <!--End of Google fonts-->	   
	   
       <!--CSS Styles-->
	   <link rel="stylesheet" href="css/checkout.css" type="text/css">
	   <!--End of CSS Styles-->
   </head>

   <!--Navigation Bar-->
   <?php include('php/header.php'); ?>
	   <!--End of Navigation Bar-->	  
   
   <body>
		<section id="container">
			<!--Checkout Form-->
			<div class="checkOutForm">
				<h3>Payment</h3>

				<form id="submit-form" action="process-order.php" method="post">
					
					<div class="customerForm">
						<input id="lName" type="hidden" name="lName" value="" >
						<input id="fName" type="hidden" name="fName" value="" >
						<input id ="email" type="hidden" name="email" value="" >
						<input id="address" type="hidden" name="address" value="" >
						<input id="city" type="hidden" name="city" value="" >
						<input id="state" type="hidden" name="state" value="" >
						<input id="zip-code" type="hidden" name="zip-code" value="" >
						<input id="country-code" type="hidden" name="country-code" value="">
					</div>
				
					<div id="checkout-btn">

					</div>
				</form>
			</div>
			<!--End of Checkout Form-->
			
			<!--Order Summary-->
			<div id ="checkout-Container">
				<h3>Order Summary</h3>
				<?php
				//Get Cart and connect to database
				session_start();
				require_once("dbcontroller/dbcontroller.php");
				$db_handle = new DBController();

				if(isset($_SESSION["cart"])){
					$total_quantity = 0;
					$total_price = 0;
				?>	
				<table class="checkOutTable">
					<tr>
						<th>Product</th>
						<th>Quanity</th>
						<th>Unit Price</th>
						<th>Total Price</th>
					</tr>
				<?php		
					foreach ($_SESSION["cart"] as $items){
						$item_price = $items["quantity"]*$items["Price"];
							
				?>
					<tr>
						<td>
							<img src="<?php echo $items["Image"]; ?>" width="100" height="110" class="cart-item-image" /><?php echo $items["Name"]; ?>
						</td>
						<td><?php echo $items["quantity"]; ?></td>
						<td><?php echo "$ ".$items["Price"]; ?></td>
						<td><?php echo "$ ". number_format($item_price,2); ?></td>
					</tr>
					<?php
						$total_quantity += $items["quantity"];
						$total_price += ($items["Price"]*$items["quantity"]);
					}
				?>
					<tr>
						<td colspan="1" align="right">Total:</td>
						<td><?php echo $total_quantity; ?></td>
						<td align="right" colspan="3" ><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
					</tr>
				</table>
				<?php
					}
				?>
			</div>
			<!--End of Order Summary-->
		</section>
	   
	   <!--Footer-->
       <?php include('php/footer.php'); ?>
	   <!--End of Footer-->
	   
       <!--Paypal Payment Gateway-->
	   <script src="https://www.paypal.com/sdk/js?client-id=AViaaFwcaQ3siCZUaTHAb3ftjBLyJ5hlwpXdYThDtG_ajFxbZOqe5jh3i2BjkgBaRK-w7Zv1uGXW-p5R&disable-funding=credit,card"></script>
	   <script>      
	   paypal.Buttons({
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?php Print($total_price); ?>'
              }
            }]
          });
        },
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(details) {
			  document.getElementById("fName").value = details.payer.name.given_name
			  document.getElementById("lName").value = details.payer.name.surname
			  document.getElementById("email").value = details.payer.email_address
			  document.getElementById("address").value = details.purchase_units[0].shipping.address.address_line_1
			  document.getElementById("state").value = details.purchase_units[0].shipping.address.admin_area_1
			  document.getElementById("city").value = details.purchase_units[0].shipping.address.admin_area_2
			  document.getElementById("zip-code").value = details.purchase_units[0].shipping.address.country_code
			  document.getElementById("country-code").value = details.purchase_units[0].shipping.address.postal_code
			  document.getElementById("submit-form").submit()
			//window.location.replace("process-order.php")
          });
        }
      }).render('#checkout-btn');</script>
   </body>
</html>