

<?php
include('config/db_connect.php');

$username = $password = '';
$errors = array('username'=>'','password'=>'');


  if (isset($_POST['submit'])){
    

    // $sql = "INSERT INTO users(username,password,email) VALUES ('john',MD5('22334455'),'john@email.com')";

    // // save to db
    // if(mysqli_query($conn,$sql)){
    //   // succes
    //   echo 'succes';
    // }else{
    //   echo 'query error'.mysqli_error($conn);
    // }
 
// check username
  if (empty($_POST['username'])){
    $errors['username']= "username is required<br/>";
  }else{
    $username =  mysqli_real_escape_string($conn, $_POST['username']);
  }

// check password
if (empty($_POST['password'])){
  $errors['password']= "password is required<br/>";
}else{
  $password =  mysqli_real_escape_string($conn, $_POST['password']);
}


if (array_filter($errors)){
  //echo 'there are errors in the form';
}else{

	// write query for all meals
	$sql = 'SELECT * FROM users ';

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $myarr = [];
    foreach( $users as $user){
        if($user['username']==$username ){
          //sign in was successful
           if($user['password']==MD5($password)){
               session_start();
               $_SESSION["user"] = $user['username'];
               header('location:dashboard/dashboard.php');
              }
              // password is wrong
               else{
                $errors['password']= "password is wrong<br/>";  
               }
            break;
        }else{
          //put all the users that werent matching w the usernames in an array
global $myarr ;
array_push($myarr,$user['username']);
        }
    }
    //we check if our username is in this array which means username is wrong
foreach($myarr as $user){
  if($user = $username){
    $errors['username']= "username is wrong<br/>";

  }
}





  mysqli_free_result($result);


}


}

?>


<?php include('template/header.php'); ?>
<style>
    .red-text{
        color:#f31261;
        background:#ffedf3;
        margin-top:3px;
        border-radius:10px;
    }
</style>








<section style=" background-color: var(--global) !important;" >
  <div class="container py-5 \">
    <div class="row d-flex justify-content-center align-items-center ">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Sign in</h3>

            <form action="signIn.php" method="post">

            <div class="form-outline mb-4">
            <label class="form-label" >Username</label>
            <input type="text" name="username" value="<?php  echo htmlspecialchars($username);?>" class="form-control form-control-lg">
<div class="red-text"><?php echo $errors['username'];?></div>
            </div>

            <div class="form-outline mb-4">
            <label class="form-label" >Password</label>
            <input type="text" name="password"value="<?php echo htmlspecialchars($password) ;?>" class="form-control form-control-lg"  >
<div class="red-text"><?php echo $errors['password'];?></div>
            </div>

            

            <input type="submit" name="submit" value ="sign in" class="btn search-btn btn-lg btn-block">
            

</form>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<script src="./js/main.js"></script> 
</body>
</html>