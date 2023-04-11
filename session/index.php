<?php

if (isset($_SESSION['pgname'])){
$pgname = $_SESSION['pgname'];

}else{
	header("Location: ../landingpage");
}

?>