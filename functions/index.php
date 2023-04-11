<?php


function clean_input($input){
	$input = trim($input);
	$input = stripcslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}


function email_verification($email){

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
} else {
    return false;
}
}

function clean_name($name){

	if (preg_match('/^[a-zA-Z ]*$/', $name)) {
      return true;
    }else{
    	return false;
    }
}

function psw_len($pass){
if (strlen($pass)<8 || strlen($pass)>20){
	return true;
}
return false;
}


function pass_validate($pass,$confirm_pass){
	//reject if password do not match
	if ($pass != $confirm_pass){
	return true;
	}
	if (strlen($confirm_pass)<8 || strlen($confirm_pass)>20){
		return true;
	}
	return false;
}

function phone_number($phone){

if(preg_match('/^[0-9]{9}+$/', $phone)) {
return true;
} else {
return false;
}
}


function hasErrors($errors)
{
	foreach ($errors as $error => $value) {
		if (!empty($value)) {
			return true;
		}
	}
	return false;
}


// function to encrypt and decrypt the cookie value
function safeEncrypt($plaintext, $password, $encoding = null) {
    $iv = openssl_random_pseudo_bytes(16);
    $ciphertext = openssl_encrypt($plaintext, "AES-256-CBC", hash('sha256', $password, true), OPENSSL_RAW_DATA, $iv);
    $hmac = hash_hmac('sha256', $ciphertext.$iv, hash('sha256', $password, true), true);
    return $encoding == "hex" ? bin2hex($iv.$hmac.$ciphertext) : ($encoding == "base64" ? base64_encode($iv.$hmac.$ciphertext) : $iv.$hmac.$ciphertext);
}

function safeDecrypt($ciphertext, $password, $encoding = null) {
    $ciphertext = $encoding == "hex" ? hex2bin($ciphertext) : ($encoding == "base64" ? base64_decode($ciphertext) : $ciphertext);
    if (!hash_equals(hash_hmac('sha256', substr($ciphertext, 48).substr($ciphertext, 0, 16), hash('sha256', $password, true), true), substr($ciphertext, 16, 32))) return null;
    return openssl_decrypt(substr($ciphertext, 48), "AES-256-CBC", hash('sha256', $password, true), OPENSSL_RAW_DATA, substr($ciphertext, 0, 16));
}

// function to validate the profile picture of a user
function picaction(){
$file = $_FILES['photo'];

 $file_name = $_FILES['photo']['name'];
 $fileTmpName = $_FILES['photo']['tmp_name'];
 $file_size = $_FILES['photo']['size'];
 $file_error = $_FILES['photo']['error'];
 $file_type = $_FILES['photo']['type'];

//allowed files to be uploaded in the website

 $fileExt= explode('.',  $file_name);
 $fileAactualExt = strtolower(end($fileExt));

 $allowed = array('jpg', 'jpeg', 'png');

 if (in_array($fileAactualExt, $allowed)) {
 	if ($file_error ===0) {
 		if ($file_size < 2097152) {
 			$file_name_new = uniqid('', true).".".$fileAactualExt;
 			$file_destination = '../profile_uploads/'.$file_name_new;

 			move_uploaded_file($fileTmpName, $file_destination);

 			return $file_destination;
 			
 			// $_POST['photo']= $file_name_new;
 			// //echo $_POST['photo'];
 			// $img = "uploads/".$_POST['photo'];
 			// echo '<img src= "'.$img.'"style="width:300px; height:300px;" alt="my photo" /><br />';
 			// //To display the image uploaded
 			// // $image=$_FILES["photo"]["name"]; 
 			// // $img="uploads/".$image;
 			// // echo '<img src= "'.$img.'"style="width:200px; height:200px;" alt="my photo" /><br />';


 		}else{
 		 return	false;


 		}
 	}else{
 		return false;

 	}
 }else{
 	return  false;


}
}

//function to validate the post picture the function will return an image path or a false if there is an error

function post_image(){
$file = $_FILES['post_image'];

 $file_name = $_FILES['post_image']['name'];
 $fileTmpName = $_FILES['post_image']['tmp_name'];
 $file_size = $_FILES['post_image']['size'];
 $file_error = $_FILES['post_image']['error'];
 $file_type = $_FILES['post_image']['type'];

//allowed files to be uploaded in the website

 $fileExt= explode('.',  $file_name);
 $fileAactualExt = strtolower(end($fileExt));

 $allowed = array('jpg', 'jpeg', 'png');

 if (in_array($fileAactualExt, $allowed)) {
 	if ($file_error ===0) {
 		if ($file_size < 2097152) {
 			$file_name_new = uniqid('', true).".".$fileAactualExt;
 			$file_destination = '../post_image/'.$file_name_new;

 			move_uploaded_file($fileTmpName, $file_destination);

 			return $file_destination;
 			
 			// $_POST['photo']= $file_name_new;
 			// //echo $_POST['photo'];
 			// $img = "uploads/".$_POST['photo'];
 			// echo '<img src= "'.$img.'"style="width:300px; height:300px;" alt="my photo" /><br />';
 			// //To display the image uploaded
 			// // $image=$_FILES["photo"]["name"]; 
 			// // $img="uploads/".$image;
 			// // echo '<img src= "'.$img.'"style="width:200px; height:200px;" alt="my photo" /><br />';


 		}else{
 		 return	false;


 		}
 	}else{
 		return false;

 	}
 }else{
 	return  false;


}
}




