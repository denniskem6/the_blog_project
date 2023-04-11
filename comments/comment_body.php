<?php
if (!isset($_SESSION['page_vist']) && ($_SESSION['page_vist'])!="yes") {
	// means the previous page has not been visited so we redirect it back
	header("Location: ../home");
}else{
	//we unset it by giving the session variable a different value
	$_SESSION['page_visit']="unset";
}


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

          	    <div class="card mb-4">
				          <div class="card-body">
				            <?php
				            echo $row['body'];

				             ?>

				            <div class="d-flex justify-content-between">
				              <div class="d-flex flex-row align-items-center">
				                <img src="
				                <?php  
				                if (($row['profile_photo'])!=null) {
				                	// means that there is a picture
				                	echo $row['profile_photo'];
				                }else{
				                	echo "../profile_uploads/avatar.jpg";
				                }



				                ?>



				                " alt="avatar" width="25"
				                  height="25" />
				                <p class="small text-primary mb-1"><?php echo $row['names'];  ?></p>
				              </div>
				              <div class="d-flex flex-row align-items-center">
				                <p class="small text-muted mb-0">Upvote?</p>
				                <i class="far fa-thumbs-up mx-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
				                <p class="small text-muted mb-0">3</p>
		             	 </div>
		            </div>
		          </div>
		        </div>

<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>