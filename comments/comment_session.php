<?php  

//this page will be blank hence limmited security threat



// print_r($_SESSION['post_info']) ;
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
         $url = "https://";   
    else  
         $url = "http://";   
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI'];    
      
    // echo $url; 
    $post_id= $_GET['id'];
    $poster_name= $_GET['name'];
   

    if (isset($_GET['profile_photo'])) {
    	// means the photo is not empty
    	 $poster_photo= $_GET['profile_photo'];
    	 // echo $poster_photo."<br>";
    }

    // echo $post_id."<br>";
    // echo $poster_name."<br>";
   
    $user_id = $_SESSION['user']['id'];
    // echo $user_id."<br>";

    