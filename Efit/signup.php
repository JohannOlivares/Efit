<!doctype html>
<html lang="eng">
    <head>
	    <title>Sign Up</title>
       <!--CSS Styles-->
	   <link rel="stylesheet" href="css/login.css" type="text/css">
	   <!--End of CSS Styles-->		
	</head>
    <!--Navigation Bar-->
	<?php include('php/header.php'); ?>
	   <!--End of Navigation Bar-->	  

	<body>
	   
	   <!--SignUp Form-->
	   <div id="login-form">
	       <form action="dbcontroller/signUpUser.php" method="post">
		       <div class="user-input">
			       <label for="username">First Name</label>
		           <input type="text" name="fName" required>      
			   </div>
		       <div class="user-input">
			       <label for="username">Last Name</label>
		           <input type="text" name="lName" required>      
			   </div>
			   <div class="user-input">
                   <label for="birthdate">Birtdate</label>
				   <input type="date" name="bDate" required>
               </div>
		       <div class="user-input">
			       <label for="username">EmailAddress</label>
		           <input type="text" name="email" required>      
			   </div>				   
			   <div class="user-input">
			       <label for="password">Password</label>
			       <input type="text" name="password" required>
               </div>			 
               <div id="login-btn">
			       <input type="submit" name="signup" value="Sign Up">
               </div>			   
		   </form>
	   </div>
	   <!--End of SignUp Form-->
	   
	</body>
</html>