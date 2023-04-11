<?php 
session_start();

require '../connection/index.php';
require '../functions/index.php';
require_once 'comment_session.php';
require '../validation/comment_validation.php';

// here we check if the user is logged in

if (isset($_SESSION['user'])) {

  
  $username = $_SESSION['user']['names'];
}else{
  header("Location: ../landingpage");
}



// A blank user id cannot visit the comment section it must be an id that has been passed by the URL
    if (empty($user_id) && !isset($user_id)) {
      // means there is no user id we redirect it to home page
      header("Location: ../home");
    }

     
              
                  

                  $stmt = $conn->prepare("SELECT * FROM posts WHERE id =$post_id limit 1");
                  $stmt->execute();

                    
                 // set the resulting array to associative
                  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                
                  // echo $results[0]['title'];

		
                  
                  // if (($results[0]['profile_photo'])!=null) {
                  //   // means there is a path so we echo the path 
                  //   echo $results[0]['profile_photo'];
                  // }else{
                  //   echo "../profile_uploads/avatar.jpg";
                  // }


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>comment</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>

<div class="container bg-light p-1 w-50">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../home">Home</a></li>
    <li class="breadcrumb-item"><a href="../profile/profile.php">Profile</a></li>
    <li class="breadcrumb-item active" aria-current="page">comments section</li>
  </ol>
</nav>
</div>

  <div class="container my-1 py-3 w-50" style="background-color: #eee;">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body py-2">
            <div class="d-flex flex-start align-items-center">
              <img class="rounded-circle shadow-1-strong me-3"
                src="

                 <?php 
		                if (isset($_GET['profile_photo']) && !empty($_GET['profile_photo'])) {
					    	// means the photo is not empty
					    	 $poster_photo= $_GET['profile_photo'];
					    	 echo $poster_photo;
		   				 }else{
		                    echo "../profile_uploads/avatar.jpg";
		                  }	
                      ?>

                " alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold text-primary mb-1">
                    <?php  
                  echo ucwords($poster_name);

                  ?>
                </h6>
                <p class="text-muted small mb-0">

                  Published on: 
                        <?php  
                        $date =date_create($results[0]['created_at']);
                    echo date_format($date, "D F d Y");

                    ?>
                </p>
              </div>
            </div>

            <p class="small">
            
                <h6 class="text-primary mb-0">
                    <?php  
                  echo ucwords($results[0]['title']);


                  ?>
                </h6>
              
           

              <?php  
              echo $results[0]['body'];

              ?>

            </p>
            </p>
            <div class="container">
              <img src="
                  <?php  
              echo $results[0]['post_image'];

             	 ?>


              " style="width: auto; height: 300px; border-radius: 15px; ">
              
            </div>



          </div>
          <div class="card-footer py-1 border-0" style="background-color: #f8f9fa;">
            <div class="d-flex flex-start w-100">
              <img src="

                      <?php  

                      if (!empty($_SESSION['user']['profile_photo'])) {
                        // means there is a picture
                        echo $_SESSION['user']['profile_photo'];
                      }else{
                        echo "../profile_uploads/avatar.jpg";
                      }


                      ?>

              " class="rounded-circle shadow-1-strong me-3 " alt="avatar" width="40"
                height="40" />
            </div>
             <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	              <div class="form-outline mb-4 pt-2">
			          <input type="text" id="addANote" class="form-control" name="body" placeholder="Type comment..." />
			          <label class="form-label" for="addANote">+ Add comment</label>
			      </div>
	            <div class="float-end">
	              <button type="submit" class="btn btn-primary btn-sm">
	                Post comment
	              </button>
	              <button type="button" class="btn btn-outline-primary btn-sm">
	                Cancel
	              </button>
	            </div>
            </form>

          </div>
         
          <div class="container pt-2">

          	 <?php 

           $stmt = $conn->prepare("SELECT  users.id, users.names, users.profile_photo, comments.comments_id, comments.post_id, comments.user_id, comments.body, comments.created_at
                                  FROM users
                                  RIGHT JOIN comments
                                   ON users.id=comments.user_id
                                   WHERE post_id=$post_id
                                   order by comments_id desc");
            $stmt->execute();
                  
            // set the resulting array to associative
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // $num_rows =count($results);
            // we set session for this page so as to prevent the required page from being accessed

            $_SESSION['page_vist']="yes";

         if (count($results)>0) {
           // code...means that there is comment


                  foreach ($results as $row) {

                      require 'comment_body.php';

                    }

         }else{

          echo "<div class= text-success role = 'alert'>"."Be the first one to comment"."</div>";
         }
            
           



          ?>




          </div>


        </div>
      </div>
    </div>
  </div>





      </div>
    </div>
  </div>
</div>



<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>