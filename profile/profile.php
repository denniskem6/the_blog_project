<?php 


require '../functions/index.php';
require '../connection/index.php';

session_start();

if (isset($_SESSION['user'])) {
	
	$username = $_SESSION['user']['names'];
  

}else{
	header("Location: ../landingpage");
}

// print_r($_SESSION['user']);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>profile page</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">

</head>
<body>

<div class="container">
	<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="../home"><b>go to Home</b></a>
   
    <div>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <li>
           <a class="navbar-brand" href="../logout"><b>Logout</b></a>
        </li>

        <li>
          <a class="navbar-brand">
            <b><?php echo ucwords($_SESSION['user']['names']); ?></b>
          </a>
          
        </li>
      </ul>
    </div>
  </div>
</nav>
</div><br>


<section class="container vh-100" style="background-color: grey;">

<div class="container">
<div class="row">
	<div class="col-6">
		<div class="container py-5 h-100">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class=" text-black">
              <div class="flex-shrink-0">
               



             <img src="
                <?php 
              
                  $user_id=$_SESSION['user']['id'];

                  $stmt = $conn->prepare("SELECT * FROM users WHERE id =$user_id limit 1");
                  $stmt->execute();

                    
                 // set the resulting array to associative
                  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  
                  if (($results[0]['profile_photo'])!=null) {
                    // means there is a path so we echo the path 
                    echo $results[0]['profile_photo'];
                  }else{
                    echo "../profile_uploads/avatar.jpg";
                  }



                  ?>" 
                  alt="Generic placeholder image" 
                  style="width: 180px; height: 180px; border-radius: 10px;">

              </div>
              <div class="flex-grow-1">
                <h5 class="mb-1"><b><?php echo ucwords($_SESSION['user']['names']); ?></b></h5>
                <p class="mb-2 pb-1" style="color: #2b2a2a;">Senior Journalist</p>
                <div class="d-flex justify-content-start rounded-3 p-2 mb-2"
                  style="background-color: #efefef;">
                  <div>
                    <p class="small text-muted mb-1">Articles</p>
                    <p class="mb-0">41</p>
                  </div>
                  <div class="px-3">
                    <p class="small text-muted mb-1">Followers</p>
                    <p class="mb-0">976</p>
                  </div>
                  <div>
                    <p class="small text-muted mb-1">Rating</p>
                    <p class="mb-0">8.5</p>
                  </div>
                </div>
                <?php 

                if ($_SERVER['REQUEST_METHOD']=="POST") {
                  $errors=[
                    'photo'=>""];
                  
                  $img= picaction();
                  
                  if ($img) {
                                      // code...

                              $user_id=$_SESSION['user']['id'];

                                    
                             
                             
                              $sql ="UPDATE users 
                                      SET profile_photo='$img' 
                                      WHERE id=$user_id";
                           
                              $conn->exec($sql);

                              $success_message ="image succesfully updated";
                              $_SESSION['profile_pic']=$img;
                              header("Location: profile.php");

                              $conn=null;
                             }else{

                              $errors['photo']="Only files below 2mb and of jpeg, jpg and png are allowed";
                             }


                }


                 ?>

                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                      <div class="d-flex pt-1">
                          <input type="file" id="myFile" name="photo">
                       <?php 
                  //$errors array or the email variable is still accessible since it was pulled by the validation.php
                          if (!empty($errors['photo'])) {
                            echo "<div class= text-danger role = 'alert'>" . $errors['photo'] ."</div>";
                            $errors['photo'] = '';
                          }

                       ?>
                     </div>

                <div class="d-flex pt-1">
                  <button type="submit" class="btn btn-outline-primary me-1 flex-grow-1" >change Image</button>
                </div>
                </form>

              </div>
            </div>
          </div>
        </div>
 
   
  </div>

	</div>
	
	<div class="col-6">
		<div class="container py-5 h-100">
		<div class="card">
  	<div class="card-body p-4">
    	<table class="table">
		  <thead>
		    <tr>
		      	<th scope="col"></th>
		 		<td colspan="3"><b>Your Details</b></td>
		    </tr>
		  </thead>
		  <tbody class="table-group-divider">
		  	<tr>
		      <th scope="row">Your Full Names</th>
		      <td><?php echo ucwords($_SESSION['user']['names']); ?></td>
		    </tr>
		    <tr>
		      <th scope="row">Your Email</th>
		      <td><?php echo $_SESSION['user']['email']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">Your phone number</th>
		      <td><?php echo $_SESSION['user']['phone']; ?></td>
		    </tr>
		    <tr>
		      <th scope="row">Last Login Time</th>
		      <td><?php echo $_SESSION['user']['last_login_at']; ?></td>
		    </tr>
		  </tbody>
		</table>
    <a class="btn btn-outline-success" href="../update_user/update.php" role="button"><b>update profile info</b></a>
  </div>
</div>
</div>
</div>

		

</div>
</div>




  
</section>


<script src="../bootstrap/js/bootstrap.bundle.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>

