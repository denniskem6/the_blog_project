<?php

require '../connection/index.php';

session_start();

// print_r($_SESSION['user']);
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
	<title>home page</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>

<div class="container">
  <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="../profile/profile.php"><b>go to Profile</b></a>

   
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


<section class="container vh-30" style="background-color: grey;">
  <div class="container py-3 h-100">
    <div class="row justify-content-start align-items-start h-100">
      <div class="col col-md-9 col-lg-7 col-xl-5">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-1">
            <div class="d-flex text-black">
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
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1"><?php  echo "<b>".ucwords($username)."</b>";  ?></h5>
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
                <div class="d-flex pt-1">
                  <a class="btn btn-outline-primary me-1 flex-grow-1" href="../create_post/create_post.php">Create a post</button></a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container">
 <hr>
<div class="container bg-light p-1">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">All Posts</a></li>
    <li class="breadcrumb-item"><a href="#">My Posts</a></li>
    <li class="breadcrumb-item active" aria-current="page">This is the home page</li>
  </ol>
</nav>
</div>

  <div class="container p-4">
  	<div class="row">
  		<div class="col-2">



  			
  		</div>
  		
  		<div class="col-10">

  	 <?php

            //i used the right join to eliminate the null values that arises

            $stmt = $conn->prepare("SELECT posts.id, posts.user_id, users.names, users.profile_photo, posts.title, posts.body, posts.post_image, posts.created_at
                                  FROM users
                                  RIGHT JOIN posts
                                   ON users.id=posts.user_id
                                   order by id desc");
            $stmt->execute();
                  
            // set the resulting array to associative
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // print_r($results);

           $conn = null;

           $_SESSION['home_page_visit']="yes";
            foreach ($results as $row) {
              // code...

              if (($row['post_image'])!=null) {
                // means there is a picture so we have to display the image
                require "../post/post_img.php";
                // print_r($_SESSION['post_info']);
                
              }else{
                require "../post/post.php";
              }
   
            }



    
     ?>
  			
  		</div>
  	</div>
      

                
     </div>
   </div>




<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>