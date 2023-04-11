<?php 

require '../functions/index.php';
require '../validation/registrationvalidation.php';

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration</title>

<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>

<div class="container border bg-secondary">
	<p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-4">REGISTER</p>
</div><br>

<div class="container">
  <div class="row align-items-start">
    <div class="col align-items-center">
      <p><b>Why BLOG?</b><br>
Blogs are often interactive and include sections at the bottom of individual blog posts where readers can leave comments.<b><a href="../landingpage"><b>WELCOME TO BLOG</b></a></p></b></p><br>
<p>Kindly enter your correct details in the form on the right for you to register</p><br>
<p>Already have an account? <a href="../login"><b>CLICK HERE TO LOGIN</b></a></p>
	</div>
    <div class="col">
   		<div class="card">
  <div class="card-body">
     <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    	<p><b>
    		<?php 
    			if (!empty($errors['form'])) {
    				echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['form'] ."</b>" ."</div>";
    			}else{
    				echo "Enter your registration details";
    			}

    		 ?>
    	</b></p>
    	<div class="form-floating">
	  			<input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="names" value="<?php echo $names;?>">
	  			<label for="floatingInput">Enter Full Names</label>
	  			<?php 
          //$errors array or the names variable is still accessible since it was pulled by the validation.php
                      if (!empty($errors['names'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['names'] ."</b>" ."</div>";
                        $errors['names'] = '';
                      }

                ?>
		</div><br>
		<div class="row">
	<div class="col">
				<div class="form-floating">
	  			<input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="pnumber" value="<?php echo $pnumber;?>">
	  			<label for="floatingInput">254</label>
	  			<?php 
          //$errors array or the pnumber variable is still accessible since it was pulled by the validation.php
                      if (!empty($errors['pnumber'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['pnumber'] ."</b>" ."</div>";
                        $errors['pnumber'] = '';
                      }

                ?>
		</div>
		
	</div>
	<div class="col">
			    <div class="form-floating">
	  			<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?php echo $email;?>">
	  			<label for="floatingInput">Email address</label>
	  			<?php 
          //$errors array or the email variable is still accessible since it was pulled by the validation.php
                      if (!empty($errors['email'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['email'] ."</b>" ."</div>";
                        $errors['email'] = '';
                      }

                ?>
		</div>
		
	</div>
	
</div><br>


<div class="row">
	<div class="col">
				<div class="form-floating ">
	  			<input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
	  			<label for="floatingPassword">Password</label>
	  			<?php 
          //$errors array or the password variable is still accessible since it was pulled by the validation.php
                      if (!empty($errors['password'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['password'] ."</b>" ."</div>";
                        $errors['password'] = '';
                      }

                ?>
				</div>
	</div>
		<div class="col">
				<div class="form-floating">
	  			<input type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password" name="confirm_password">
	  			<label for="floatingPassword">Confirm Password</label>
	  			<?php 
          //$errors array or the password confirm variable is still accessible since it was pulled by the validation.php
                      if (!empty($errors['confirm_password'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['confirm_password'] ."</b>" ."</div>";
                        $errors['confirm_password'] = '';
                      }

                ?>
				</div>
	</div>
	
</div><br>


		<div class="d-grid">
		<button type="submit" class="btn btn-primary">REGISTER</button>
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