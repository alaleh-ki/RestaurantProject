<?php
// connect to database 
$conn = mysqli_connect('localhost','name', 'password','baxmat');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }
    
    ?>
