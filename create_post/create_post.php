<?php 
require '../functions/index.php';
require "../validation/create_post_validation.php";

// check if the user is logged in

if (isset($_SESSION['user'])) {

  
  $username = $_SESSION['user']['names'];
}else{
  header("Location: ../landingpage");
}




 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create post</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>

	<div class="container border bg-secondary">
		<p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-4">CREATE A POST</p>
	</div><br>

		<div class="container bg-light p-1">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="../home">Go to Home</a></li>
			    <li class="breadcrumb-item"><a href="../profile/profile.php">Go to Profile</a></li>
			    <li class="breadcrumb-item active" aria-current="page">Create post page</li>
			  </ol>
			</nav>
		</div><br>

	<div class="container p-5 border bg-light">

		<form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
			<p><b>Enter details for the post</b></p>
			<div >
			<input type="text" class="form-control" width="w-50" name="title" placeholder="Enter title or topic">
				 <?php 
          //$errors array  is still accessible since it was pulled by the validation.php
                      if (!empty($errors['title'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['title'] ."</b>" ."</div>";
                        $errors['title'] = '';
                      }

                ?>
			</div><br>

			 <div class="form-group">
			    <textarea class="form-control" id="exampleFormControlTextarea1" name="body" rows="4" placeholder="Decsribe the content of the topic"></textarea>
			    <?php 
          //$errors array  is still accessible since it was pulled by the validation.php
                      if (!empty($errors['body'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['body'] ."</b>" ."</div>";
                        $errors['body'] = '';
                      }

                ?>
		  	</div><br>

		  	<div class="mb-3">
		
				  <input class="form-control" type="file" id="formFile" name="post_image">
				  			    <?php 
          //$errors array  is still accessible since it was pulled by the validation.php
                      if (!empty($errors['post_image'])) {
                        echo "<div class= text-danger role = 'alert'>" ."<b>" . $errors['post_image'] ."</b>" ."</div>";
                        $errors['post_image'] = '';
                      }

                ?>
			</div>

			<div class="d-grid">
 				 <button class="btn btn-primary" type="submit">SUBMIT</button>
			</div>


		</form>

	</div>



<script src="../bootstrap/js/bootstrap.js"></script><script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>