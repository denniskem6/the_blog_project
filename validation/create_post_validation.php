<?php

//in the validattion we clean the inputs and save the errors in an array then display the errors in where we want the errors to be seen
session_start();
require '../connection/index.php';

			// print_r($_SESSION['user']);
			// die();
$title ='';
$body='';
$post_image= '';


$errors = [

'title' =>'',
'body' =>'',
'post_image'=>''
];

if ($_SERVER['REQUEST_METHOD']=="POST") {	
// code...
$title = trim(htmlspecialchars($_POST['title']));
if (empty($title)) {
	$errors['title'] = "The title cannot be empty";
}

$body =trim(htmlspecialchars($_POST['body']));
if (empty($body)) {
	$errors['body'] = "The body cannot be empty";
}

$post_image = post_image();
if (($post_image)==false) {
	// it will mean there is an error
	$errors['post_image']="Only files below 2mb and of jpeg, jpg and png are allowed";
}

//if there are no errors we save the post to the database

if (!hasErrors($errors)) {

	
	$user_id=$_SESSION['user']['id'];
	
	$sql = "INSERT INTO posts (user_id, title, body, post_image)
				  	VALUES ('$user_id', '$title', '$body', '$post_image')";
				 
				 $conn->exec($sql);

				$success_message ="post created succesfully";

				$conn=null;
				   	//print_r($_SESSION['registration_data']);

				   	header("Location: ../home");
         		 

}


}

	
?>