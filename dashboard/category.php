
<?php

include('../config/db_connect.php');
// write query for all meals
$sql = "SELECT * FROM categories ";

// get the result set (set of rows)
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

session_start();

if(isset($_GET['category'])){
 // $category = mysqli_real_escape_string($conn,$_GET['category']);

// write query for all meals
$sql = "SELECT * FROM meals WHERE category='".$_GET['category']."'";

// get the result set (set of rows)
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);
    }
    

?> 

<?php include('../template/dashboard.php');?>
    <style>


.nav-head a{
color:#d5d5d5;
}
.signout{
  left: 0;
  bottom: 0;
  background-color: var(--global);
  color: white;
  text-align: center;
  z-index:2;
    }
    .signout:hover{
      color:white;
      background:var(--global)78;
    }
    @media screen and (max-width: 425px) {
th{
  font-size: 10px !important;
}
td{
font-size: 10px !important;
}

  }
  
.search-btn{
    background-color: var(--global) !important;
    color: white !important;
}
    

</style>


  
  <?php if(isset($_SESSION["user"])){ ?>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5 nav-head">
          <h5><a href="index.html" class="logo">    <img src="../pictures/logo.png" width="30" height="30" class="d-inline-block align-top" alt=""> Hey <?php echo $_SESSION["user"] ?></a></h1>

	        <ul class="list-unstyled components mb-5 mt-5">
	          <li class="active">
            <a href="dashboard.php">Add a product</a>
	          </li>
            <li>
	              <a href="./addcat.php">Add a category</a>
	          </li>
	          <li>
	              <a href="../index.php">View the website</a>
	          </li>
	          <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">categories</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
              <?php foreach($categories as $cat):?>
                <li>
                    <a  href="category.php?category=<?php echo $cat['category']?>"><?php echo $cat['category']?></a>
                </li>
                <?php endforeach; ?>

              </ul>
	          </li>

	        </ul>
          <td><button class="btn signout col-12" data-id="<?php echo $_SESSION["user"]?>" >Sign out</button></td>	      </div>
    	</nav>

        <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">

<div class="main">


   <div class="row d-flex justify-content-center align-items-center">
     <div class="col-12 col-md-10 col-lg-10 col-xl-10 p-0">
       <div class="card shadow-2-strong " style="border-radius: 1rem;">
         <div class="card-body text-center">
         <h3 class='py-2'><?php echo $_GET['category'];?></h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">title</th>
      <th scope="col">ingredients</th>
      <th scope="col">category</th>
      <th scope="col">price</th>
      <th scope="col">image</th>
      <th scope="col">Edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($meals as $meal){?>
    <tr id="<?php echo $meal['id']?>-meal">
      <th scope="row"><?php echo $meal['id']?></th>
      <td><?php echo $meal['title']?></td>
      <td><?php echo $meal['ingredients']?></td>
      <td><?php echo $meal['category']?></td>
      <td><?php echo $meal['price']?></td>
      <td><?php echo $meal['image']?></td>
      <td>  <a href="http://localhost/restaurant/dashboard/edit.php?id=<?php echo $meal['id'] ?>"><button class="btn btn-block search-btn" data-id="<?php echo htmlspecialchars($meal['id'])?>" ><i class="fa fa-paint-brush" aria-hidden="true"></i>
</button></a>
</td>
      <td><button class="btn btn-block btn-danger delete-admin" data-id="<?php echo htmlspecialchars($meal['id'])?>" ><i class="fa fa-trash" aria-hidden="true"></i></button></td>
    </tr>

   <?php }?>
  </tbody>
</table>
</div>
</div> 
</div>
</div>

<?php }  else{?>

<div class="row d-flex justify-content-center align-items-center error-page">
<div class="col-8 col-md-8 col-lg-6 col-xl-6">
<div class="card shadow-2-strong m-4 vw-50" style="border-radius: 1rem;">
<div class="card-body p-5 text-center ">
<h3>sign in first!</h3>
<br>
<a href="../signIn.php"><button class="btn search-btn">sign in</button></a>
</div>
</div>
</div>
</div>
</div>
<?php } ?>





    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>

  </body>
</html>
