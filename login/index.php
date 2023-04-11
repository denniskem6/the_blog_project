<?php 


require '../functions/index.php';
require '../validation/loginvalidation.php';



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>

<div class="container border bg-secondary">
	<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">LOGIN</p>
</div><br><br><br><br>

<div class="container">
  <div class="row align-items-start">
    <div class="col align-items-center">
      <p><b>What BLOG means?</b><br>
A blog, short for weblog, is a frequently updated web page used for personal commentary or business content. Blogs are often interactive and include sections at the bottom of individual blog posts where readers can leave comments.</p><br>
<p>Kindly enter your correct details in the form on the right for you to login</p><br>
<p>If you dont have an account <a href="../registration"><b>CLICK HERE TO REGISTER</b></a></p>
	</div>
    <div class="col">
    	<div class="card">
  		<div class="card-body">
			   	<form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
			    	<p>
			    		<?php 
				  					if (isset($_SESSION['registration_data'])) {
													$reg_name = $_SESSION['registration_data']['names'];
													echo "<div class= text-success role = 'alert'>" ."<b>" ."Hello ".ucwords($reg_name)." Kindly enter your password to login"."</b>"."</div>";
													}else{
														if (!empty($errors['form'])) {
															echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['form'] ."</b>" ."</div>";
														}else{
															echo "<b> Kindly enter your login details </b>";
														}
														
													}

				  			?></p>
				     <div class="form-floating">
				  			<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="
				  			<?php 
				  					if (isset($_SESSION['registration_data'])) {
													$reg_email = $_SESSION['registration_data']['email'];
													echo $reg_email;
												  	session_unset();
													}else{
														echo $email;
													}

				  			?>">
				  			<label for="floatingInput">Email address</label>
				  			<?php 
			          //$errors array or the email variable is still accessible since it was pulled by the validation.php
			                      if (!empty($errors['email'])) {
			                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['email'] ."</b>" ."</div>";
			                        $errors['email'] = '';
			                      }

			                ?>
				  			
						</div><br>
						<div class="form-floating ">
				  			<input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
				  			<label for="floatingPassword">Password</label>
				  			<?php 
			          //$errors array or the password variable is still accessible since it was pulled by the validation.php
			                      if (!empty($errors['password'])) {
			                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['password'] ."</b>"."</div>";
			                        $errors['password'] = '';
			                      }

			                ?>
						</div><br>
						<div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember-me">
                <label class="form-check-label" for="remember-me">Remember me</label>
            </div>
						<div class="d-grid">
							<button type="submit" class="btn btn-primary">LOGIN</button>
						</div>
						
				</form>
  </div>
</div>
    
    </div>
    </div>
</div>
		




<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>