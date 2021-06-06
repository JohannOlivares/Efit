<!doctype html>
<html lang="eng">
    <head>
	    <title>Login</title>
       <!--CSS Styles-->
	   <link rel="stylesheet" href="css/login.css" type="text/css">
	   <!--End of CSS Styles-->		
	</head>
	<!--Navigation Bar-->
	<?php include('php/header.php');  ?>
	   <!--End of Navigation Bar-->	
	   
	<body>
   
	   <!--Login Form-->
	   <div id="login-form">
	       <form action="dbcontroller/process-login.php" method="post">
		       <div class="user-input">
			       <label for="username">Email Address</label>
		           <input type="text" name="email" required>      
			   </div>
			   <div class="user-input">
			       <label for="password">Password</label>
			       <input type="text" name="password" required>
               </div>			 
               <div id="login-btn">
			       <input type="submit" name="login" value="Login">
               </div>			    
		   </form>
	   </div>
	   <!--End of Login Form-->
	   
	</body>
</html>