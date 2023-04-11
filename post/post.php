<?php 
$_SESSION['post_info']=$row;

//if post info is not set we cannot access the post.php the post.php contains the design of a single post

if (!isset($_SESSION['post_info']) && empty($_SESSION['post_info'])) {
  // means the session is not set and it is empty then we redirect to home page
  if (!isset($_SESSION['home_page_visit']) && ($_SESSION['home_page_visit'])!="yes") {
    // code means the page has not been visited and the session value is not yes the we redirect back to home page
    header("Location: ../home");
  } 
}else{
  $_SESSION['home_page_visit']="unset";
}



 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>POST</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>

  <div class="container my-1 py-3" style="background-color: #eee;">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body py-2">
            <div class="d-flex flex-start align-items-center">
              <img class="rounded-circle shadow-1-strong me-3"
                src="

                 <?php  
                    if (($row['profile_photo'])!=null) {
                      // means we have the profile photo
                      echo $row['profile_photo'];
                    }else{
                      echo "../profile_uploads/avatar.jpg";
                    }

                      ?>

                " alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold text-primary mb-1">
                    <?php  
                  echo ucwords($row['names']);

                  ?>
                </h6>
                <p class="text-muted small mb-0">

                  Published on: 
                        <?php  
                        $date =date_create($row['created_at']);
                    echo date_format($date, "D F d Y");

                    ?>
                </p>
              </div>
            </div>

            <p class="small">
                
                <h6 class="text-primary mb-0">
                   <a href="../comments/comments_no_image.php?id=<?php echo $_SESSION['post_info']['id'];?>&name=<?php echo $_SESSION['post_info']['names']; ?>&profile_photo=<?php echo $_SESSION['post_info']['profile_photo'];?>">
                    <?php  
                  echo ucwords($row['title']);

                  ?>
                </a>
                </h6>
                
           

              <?php  
              echo $row['body'];

              ?>

            <div class="small d-flex justify-content-start">
              <a href="#!" class="d-flex align-items-center me-3">
                <i class="far fa-thumbs-up me-2"></i>
                <p class="mb-0">Like</p>
              </a>
              
                <i class="far fa-comment-dots me-2"></i>
                <p class="mb-0">Comments
                <div class="text-succes">
                  <?php

                  $id=$_SESSION['post_info']['id'];

                  $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id =$id");
                  $stmt->execute();
                    
                      // set the resulting array to associative
                  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                  $num_rows=count($results);
                  if ($num_rows>=1) {
                    // 
                    echo $num_rows;


                  }
                  ?>

                </p>
              </div>
              
              <a href="#!" class="d-flex align-items-center me-3">
                <i class="fas fa-share me-2"></i>
                <p class="mb-0">Share</p>
              </a>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>

             

<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>