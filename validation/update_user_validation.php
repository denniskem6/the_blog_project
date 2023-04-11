<?php
require '../connection/index.php';

$names="";
$email="";
$pnumber="";


//set the errors into an array
$errors=[
'names'=>'',
'email'=>'',
'pnumber'=>''];

if ($_SERVER['REQUEST_METHOD']=="POST") {
	// means something was posted then we validate the input that we have recieved

	$names=$_POST['names'];
		if (!isset($names) || empty($names)) {
		$errors['names'] = 'Your full name is required';
	}elseif (!clean_input($names)){
		$errors['names']= 'please enter correct name without special characters';
	}elseif (!clean_name($names)){
		$errors['names']= 'names can only be characters';
	}

	$email=$_POST['email'];
		if (!isset($email) || empty($email)) {
		$errors['email'] = 'Your email is required';
	}elseif (!clean_input($email)) {
		$errors['email'] = 'please enter a valid id number';
	}elseif (!email_verification($email)) {
		$errors['email'] = 'Please enter a proper email format';
	}

	$pnumber=$_POST['pnumber'];
		if (!isset($pnumber) || empty($pnumber)) {
		$errors['pnumber'] = 'Your phone number is required';
	}elseif (!clean_input($pnumber)) {
		$errors['pnumber'] = 'please enter a valid phone number';
	}
	elseif (!phone_number($pnumber)) {
		$errors['pnumber'] = 'enter 9 digit number in this formatt 712345***';
	}

if (!hasErrors($errors)) {
	// means that there are no errors
}




}
