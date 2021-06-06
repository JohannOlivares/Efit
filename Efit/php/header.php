<!--   
     Author: Johann Olivares
     Date: 03/02/2021
     Version: 1.0

     Description: HTML for the navigation bar

-->
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
	    <link rel="stylesheet" href="css/index.css" type="text/css">
	    <!--End of CSS Styles-->

    </head>
    
	<!--Navigation-->
    <nav class="nav-bar">

        <a id="store-logo" href="index.php">
			<img src="img/logo1.png">
		</a>
		
	    <a class="links" href="index.php">Shop</a>
	    <a class="links" href="login.php">Login</a>
        <a class="links" href="signup.php">Sign Up</a>
	    <a class="links" href="shopCart.php">Cart</a>

	    <input id="search-field" type="text" placeholder="Search..." size="50" required>
	    <input id="search-btn" type="submit" value="Q"> <!--type=image-->

	</nav>
	<!--End of Navigation-->
