<?php

session_start();

require_once '../session/index.php';
require '../connection/index.php';


$names='';
$pnumber='';
$email='';
$pass='';
$confirm_password='';


$errors=[

'names'=>'',
'pnumber'=>'',
'email'=>'',
'password'=>'',
'confirm_password'=>'',
'form'=>''
];



if ($_SERVER['REQUEST_METHOD']=='POST') {
	
	//to validate names
	$names=$_POST['names'];
	if (!isset($names) || empty($names)) {
		$errors['names'] = 'Your full name is required';
	}elseif (!clean_input($names)){
		$errors['names']= 'please enter correct name without special characters';
	}elseif (!clean_name($names)){
		$errors['names']= 'names can only be characters';
	}

	//to validate phone number
	$pnumber=$_POST['pnumber'];
	if (!isset($pnumber) || empty($pnumber)) {
		$errors['pnumber'] = 'Your phone number is required';
	}elseif (!clean_input($pnumber)) {
		$errors['pnumber'] = 'please enter a valid phone number';
	}
	elseif (!phone_number($pnumber)) {
		$errors['pnumber'] = 'enter 9 digit number in this formatt 712345***';
	}



	//to validate email
	$email=$_POST['email'];
	if (!isset($email) || empty($email)) {
		$errors['email'] = 'Your email is required';
	}elseif (!clean_input($email)) {
		$errors['email'] = 'please enter a valid id number';
	}elseif (!email_verification($email)) {
		$errors['email'] = 'Please enter a proper email format';
	}


	//to validate password
	$pass=$_POST['password'];
	if (!isset($pass) || empty($pass)) {
		$errors['password'] = 'Password is required';
	}elseif (psw_len($pass)) {
		$errors['password'] = 'Password should have 8 characters minimum and maximum of 20 characters';
	}elseif (!clean_input($pass)){
		$errors['password'] = 'Password should be a combination of letters and special characters';
	}



	//to validate confirm password

	if (!isset($_POST['confirm_password']) || empty($_POST['confirm_password'])) {
		$errors['confirm_password'] = 'Confirm Password is required';
	}

	$confirm_password=clean_input($_POST['confirm_password']);
	if (pass_validate($pass, $confirm_password)) {
		$errors['confirm_password'] = 'Confirm password and password must match and be 8-20 characters';
	}


if (!hasErrors($errors)) {
	

	$prefix="254";
	$new_number =$prefix.$pnumber;

		  // to check if phone and email already exist in the dbase
		  $stmt = $conn->prepare("SELECT * FROM USERS WHERE phone=:phone or email=:email");
		  $stmt->execute(array(':phone'=>$new_number, 'email'=>$email));
		  $row=$stmt->fetch(PDO::FETCH_ASSOC);
	if ($row) {
		  	if ($row['phone']==$new_number) {
		  		$errors['pnumber'] ="phone already registered";
		  	}if ($row['email']==$email) {
		  		$errors['email'] ="email already registered";
		  	}
		  		
          	}// if errors are empty insert values into database
         		else{

         			$hashpass=password_hash($pass, PASSWORD_DEFAULT);

				  	$sql = "INSERT INTO users (names, email, phone, password)
				  	VALUES ('$names', '$email', '$new_number', '$hashpass')";
				 
				  	$conn->exec($sql);

				$success_message ="Account created succesfully";

					$_SESSION['rgpage']="registration_page";
	
				   	$_SESSION['registration_data']=[
				   		'email'=>$email,
				   		'names'=>$names];


				   	//print_r($_SESSION['registration_data']);

				   	header("Location: ../login");
         		 }

	$conn = null;


}else{
	$errors['form']="Please correct the areas marked in red";
}


}
