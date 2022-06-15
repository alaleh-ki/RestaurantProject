<?php
// connect to database 
$conn = mysqli_connect('localhost','alaleh', '11137900','baxmat');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
    }
    
    ?>