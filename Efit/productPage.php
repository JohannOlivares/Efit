<!--
	Author: Johann Olivares
	file: productPage.php
	Date: 08/12/2020
	Version: 1.0
	Description: Dynamic web page that pulls up the
	             details of a selected product.
-->
<!doctype html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
	    <title>Product Page</title>

        <!--CSS Styles-->
	    <link rel="stylesheet" href="css/productpageStyles.css" type="text/css">
	    <!--End of CSS Styles-->

    </head>

    <!--Header-->
    <?php include('php/header.php'); ?>
    <!--End of Header-->	
   
    <body>
	    <!--Product Details-->
	    <section id="product-details-container">
		    <?php
			//Connect to database
			require_once("dbcontroller/dbcontroller.php");
			$db_handle = new DBController();			
			//Get item code
			$id = $_GET["code"];
			//Run Query and store results
		    $item_details = $db_handle->runQuery("SELECT Code, Name, Image, Price
							    FROM Products
							    WHERE Code = '" . $id ."' ");
			//Display results
	        if(!empty($item_details)) {
			    foreach($item_details as $key=>$value) { 
		    ?>
	        <div id="img-container">
		        <img src="<?php echo $item_details[$key]["Image"] ?>" height="500" width="420">
		    </div>

		    <div id="details-container">
		       <form class="item" method="post" action="cart-process.php?action=add&code=<?php echo $id; ?>">
	      		    <div class="item-name">
						  <h1><?php echo $item_details[$key]["Name"] ?></h1>
					</div>
				    <div class="item-price">
						<h2>$<?php echo $item_details[$key]["Price"] ?></h2>
					</div>
					<div class="item-description"> 
						<p>
						I have traveled the world in search of the best
						quality products to sell. I have been to Atlantis, Egypt and the North Pole,
						just to name a few. This product is the most amazing thing in existence. Please Buy.
					    </p>
				    </div>

				    <div class="item-cart-action">
				        Quanity:<input class="product-qty" type="text" name="quantity" value="1" size="2" required>
				        <input class="item-add-btn" type="submit" value="Add to Cart"/>
			       </div>

		        </form>
		    </div>

			<?php
			    }
			}
			?>
	    </section>
	    <!--End of Product Details-->
			   
	   <!--Footer-->
       <?php include('php/footer.php'); ?>
	   <!--End of Footer-->
	   
   </body>
</html>
