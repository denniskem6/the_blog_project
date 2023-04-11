<?php 

$body="";


//set all the errors into an array
$errors=[
'body'=>''];

//something was posted
if ($_SERVER['REQUEST_METHOD']=="POST") {

$body =trim(htmlspecialchars($_POST['body']));
if (empty($body)) {
	$errors['body'] = "The body cannot be empty";
}

if (!hasErrors($errors)) {
	//there are no errors in the body so we go ahead and insert values into the database

	$sql = "INSERT INTO comments (post_id, user_id, body)
				  	VALUES ('$post_id', '$user_id', '$body')";
				 
				 $conn->exec($sql);

				$success_message ="post created succesfully";

				header("Location: $url");

}

}