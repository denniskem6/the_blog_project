<?php
session_start();

if (isset($_SESSION['user'])) {

session_unset();
session_destroy();

// to delete the cookie in that when one wants to login again it wont login automatically
setcookie("userid", "", time() - 3600);

	
}
header("Location: ../landingpage");


?>