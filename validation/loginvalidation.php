<?php

session_start();

require_once '../session/index.php';
require '../connection/index.php';

		
$email ='';
$pass='';
$login_success= null;


$errors = [

'email' =>'',
'password' =>'',
'form'=>''
];


		// For Auto Login when the user uses remember me 
						if (isset($_COOKIE['userid'])) {
								
								$userid =safeDecrypt($_COOKIE['userid'], $encryption_key);
							   

								    $email = trim(htmlspecialchars($_POST['email']));
    								$password = trim(htmlspecialchars($_POST['password']));
    								

							        $stmt = $conn->prepare("SELECT * FROM users WHERE id =$userid");
							        $stmt->execute();
							      
							        // set the resulting array to associative
							        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

							        
							        if ($results && (count($results) == 1)) {
							            $user = $results[0];
							            $_SESSION['user'] = $user;
							            header("Location: ../home"); // redirect to home page
							        }

							        $login_success = false;

							    
							    
						 }


//For a new user or a user who has not activated the remember me checkbox to login and set cookie if he or she wants

			if ($_SERVER['REQUEST_METHOD']=='POST') {
				
				//check email validation
				$email= $_POST['email'];
				if (!isset($email) || empty($email)) {
					$errors['email'] = 'Email is required';
				}elseif (!clean_input($email)) {
					$errors['email'] = 'invalid email';
				}
				elseif (!email_verification($email)) {
					$errors['email'] = 'Please enter a proper email format';
				}



				//check password validation
				$pass = $_POST['password'];

				if (!isset($pass) || empty($pass)) {
					$errors['password'] = 'Password is required';
				}
				elseif (!clean_input($pass)){
					$errors['password'] = 'invalid password';
				}



					if (!hasErrors($errors)) {

									$stmt = $conn->prepare("SELECT * FROM users WHERE email ='$email'");
									$stmt->execute();
									
								        // set the resulting array to associative
									$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

									
									if ($results && (count($results) == 1)) {
										$user = $results[0];

										$user_password_hash = $user['password'];

								            if (password_verify($pass, $user_password_hash)) { //successfull login
								            	$login_success = true;

								                $_SESSION['user'] = $user; // create session data for logged in user

								                if ($_POST['remember'] == 'on') {
								                	$encrypted =safeEncrypt($user['id'], $encryption_key);
								                	setcookie('userid',$encrypted, time() + (86400 * 30), "/");
								                
								                }
								                header("Location: ../home"); // redirect to home page
								            }else{
								            	$errors['password']="Invalid password";
								            	$login_success = false;
								            }	


								        }else{
								        	$errors['email']= "Email not found";
								        	$login_success = false;
								        }

							}
					 else{
						$errors['form']="Please correct areas marked in red!!";
					}

			}
			



