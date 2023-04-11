<?php 

session_start();

// print_r($_SESSION['user']);
if (isset($_SESSION['user'])) {

  
  $username = $_SESSION['user']['names'];
}else{
  header("Location: ../landingpage");
}

require '../functions/index.php';
require '../validation/update_user_validation.php';



?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>update_user_info</title>
 <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
 </head>
 <body>
 <div class="container border bg-secondary">
	<p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-4">Update user info</p>
</div>

<div class="container">
 <hr>
<div class="container bg-light p-1">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../home">Home</a></li>
    <li class="breadcrumb-item"><a href="../profile/profile.php">Profile</a></li>
    <li class="breadcrumb-item active" aria-current="page">update user info</li>
  </ol>
</nav>
</div><br>

<div class="container border w-50 bg-light">

<div class="container p-4">
	<form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

		<div>
		<label><b>Kindly Enter New Details to Submit</label></b>
		</div><br>

		<div class="form-floating w-75">
	  		<input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="names" value="">
	  		<label for="floatingInput">Enter New full Names</label>
	  			 <?php 
          //$errors array or the names variable is still accessible since it was pulled by the validation.php
                      if (!empty($errors['names'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['names'] ."</b>" ."</div>";
                        $errors['names'] = '';
                      }

                ?>
	  	</div><br>

	  	<div class="form-floating w-75">
	  		<input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="">
	  		<label for="floatingInput">Enter New email</label>
	  			<?php 
          //$errors array or the email variable is still accessible since it was pulled by the validation.php
                      if (!empty($errors['email'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['email'] ."</b>" ."</div>";
                        $errors['email'] = '';
                      }

                ?>
	  	</div><br>

	  	<div class="form-floating w-75">
	  		<input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="pnumber" value="">
	  		<label for="floatingInput">Enter New Phone Number</label>
	  			 <?php 
          //$errors array or the pnumber variable is still accessible since it was pulled by the validation.php
                      if (!empty($errors['pnumber'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['pnumber'] ."</b>" ."</div>";
                        $errors['pnumber'] = '';
                      }

                ?>
	  	</div><br>

	  	<div class="d-grid">
			<button type="submit" class="btn btn-primary">SUBMIT</button>
		</div>
		
		

	</form>
</div>


</div>



 <script src="../bootstrap/js/bootstrap.js"></script>
 </body>
 </html>