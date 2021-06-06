<!--
	Author: Johann Olivares
	Date: 08/12/2020
	Version: 1.0
	Description: The homepage to a custom Ecommerce website
	            I like to call EFit.
-->
<!doctype html>
<html lang="eng">

    <!--Header-->
	<?php include('php/header.php'); ?>
	<!--End of Header-->	

    <body>
	    <!--Banner Section-->
	    <div id="Banner">
		   <h1>High Quality Clothing</h1>
		    <div id="shopBtn">
			    <a href="#product-header">View Products</a>
		    </div>
	    </div>
	    <!--End of Banner Section-->

	    <!--Banner Product Slider-->
	    <h1 id="product-header"> Best Selling </h1>
	    <section class="product-slider">

	        <div class="slider-btn-left">
		        <button><</button>
		    </div>	   

		    <?php
			//create connection to database
		    require_once("dbcontroller/dbcontroller.php");
		    $db_handle = new DBController();
			//query
		    $product_array = $db_handle->runQuery("SELECT Code, Name, Image, Price
							    FROM Products
							    ORDER BY Price DESC
							    LIMIT 5");
			//loop through result and display results
		    if(!empty($product_array)) {
			    foreach($product_array as $key=>$value) { 
				?>
			    <div class="product-item">
			 	    <form class="item" method="post" action="productPage.php?action=add&code=<?php echo $product_array[$key]["Code"]; ?>">
					    <div class="image">
						    <a href="productPage.php?code=<?php echo $product_array[$key]["Code"]; ?>">
							    <img src="<?php echo $product_array[$key]["Image"]; ?>" width="230" height="250">
							</a>
						</div>
						<div class="item-details">
					        <div class="name">
						        <?php echo $product_array[$key]["Name"]; ?>
						    </div>
					        <div class="price">
						        <?php echo "$".$product_array[$key]["Price"]; ?>
						    </div>
					        <div class="cart-action">
						        <input class="add-btn" type="submit" value="View"  />
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

	    <!--Product Listings-->
	    <h1 id="product-header"> Newest Arrivals </h1>
	    <section class="product-grid">	   
		    <?php
			//Create connection to database
		    require_once("dbcontroller/dbcontroller.php");
		    $db_handle = new DBController();
			//stores results in array
		    $product_array = $db_handle->runQuery("SELECT Code, Name, Image, Price
			  				     FROM Products
							     ORDER BY ItemID ASC");
			//loop through results and display results
		    if(!empty($product_array)) {
			    foreach($product_array as $key=>$value) { 
				?>
			    <div class="product-item">
				    <form class="item" method="post" action="productPage.php?action=add&code=<?php echo $product_array[$key]["Code"]; ?>">
					    <div class="image">
					        <a href="productPage.php?code=<?php echo $product_array[$key]["Code"]; ?>">
							    <img src="<?php echo $product_array[$key]["Image"]; ?>" width="230" height="250">
							</a>
					    </div>
						<div class="item-details">
					        <div class="name">
						        <?php echo $product_array[$key]["Name"]; ?>
						    </div>
					        <div class="price">
						        <?php echo "$".$product_array[$key]["Price"]; ?>
						    </div>
					        <div class="cart-action">
						        <input class="add-btn" type="submit" value="View"  />
					        </div>
						</div>
				   </form>
			    </div>
			    <?php
			    }
			 }
			 ?>
	    </section>
	    <!--End of Product Listings-->

	    <!--Footer-->
        <?php include('php/footer.php'); ?>
	    <!--End of Footer-->
	   
    </body>
</html>
