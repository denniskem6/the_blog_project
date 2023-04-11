<?php

session_start()


?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>blog project</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>

<div class="container border bg-secondary " align="align-middle">
	<br><br><br><br><br><br>
  	<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">WELCOME TO BLOG PROJECT</p>
</div>
<br><br><br><br><br>
<div class="container text-center">
  <div class="row">
    <div class="col">
    	<b>WHAT IS A BLOG PROJECT?</b><br>
      	<p><b>BLOG PROJECT</b> is a regularly updated website or web page, typically one run by an individual or small group, that is written in an informal or conversational style.</p>
    </div>
    <div class="col">
      <b>ALREADY A MEMBER?</b><br><br>
      <p>Click to login</p>
      <a class="btn btn-outline-primary" href="../login" role="button"><b>LOGIN</b></a>
    </div>
    <div class="col">
      <B>BECOME A MEMBER?</B><br><br>
      <p>Click to register</p>
      <a class="btn btn-outline-success" href="../registration" role="button"><b>REGISTER</b></a>
    </div>
  </div>
</div>

<?php 

$_SESSION['pgname']="landing";

?>


<script src="../bootstrap/js/bootstrap.js"></script>
</body>
</html>