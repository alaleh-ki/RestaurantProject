
<?php

include('../config/db_connect.php');

session_start();

// write query for all meals
$sql = "SELECT * FROM categories ";

// get the result set (set of rows)
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);


$title = $ingredients = $price = $image ='';
$errors = array('title'=>'','ingredients'=>'','price'=>'','image'=>'','category'=>'');

?>

<?php include('../template/dashboard.php');?>

  
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
          <h5><a href="index.html" class="logo"><img src="../pictures/logo.png" width="30" height="30" class="d-inline-block align-top" alt=""> Hey <?php echo $_SESSION["user"] ?></a></h1>

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
              <?php foreach($categories as $category):?>
                <li>
                    <a  href="../dashboard/category.php?category=<?php echo $category['category']?>"><?php echo $category['category']?></a>
                </li>
                <?php endforeach; ?>

              </ul>
	          </li>

	        </ul>
          <td><button class="btn signout col-12" data-id="<?php echo $_SESSION["user"]?>" >Sign out</button></td>

          <!-- <button class="btn signout col-12">Sign out</button> -->
	      </div>
    	</nav>


 <!-- Page Content  -->
  <div id="content" class="p-4 p-md-5 pt-5">
<!-- Page content -->
<div class="main">



<section class="yellow-background " >
 <div class="">
   <div class="row d-flex justify-content-center align-items-center">
     <div class="col-12 col-md-8 col-lg-8 col-xl-8">
       <div class="card shadow-2-strong my-3" style="border-radius: 1rem;">
         <div class="card-body p-5 text-center">

           <h3 class="mb-5">Add a product</h3>

           <form id="add-pruduct">

           <div class="form-outline mb-4">
           <label class="form-label" >Title</label>
           <input type="text" name="title" value="<?php echo htmlspecialchars($title) ;?>" class="form-control form-control-lg">
           <div class="red-text mb-4" id='title'></div>
           </div>


           <div class="form-outline mb-4">
   <label class="form-label">Category</label>
   <select class="form-control" type="text" name="category" class="form-control form-control-lg">
     <?php foreach($categories as $category):?>
      <option><?php echo $category['category']?></option>
   <?php endforeach; ?>
   </select>
 </div>

 <div class="form-outline mb-4">
           <label class="form-label" >Ingredients (comma seperated)</label>
           <textarea type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ;?>" class="form-control form-control-lg" rows="2"></textarea>
           <div class="red-text mb-4" id='ingredients'></div>
           </div>



           <div class="form-outline mb-4">
           <label class="form-label" >Price</label>
           <input type="text" name="price" value="<?php echo htmlspecialchars($price) ;?>" class="form-control form-control-lg"  >
           <div class="red-text mb-4" id='price'></div>
           </div>
           
           <div class="form-outline mb-4">
           <label class="form-label" >Image name</label>
           <input type="text" name="image" value="<?php echo htmlspecialchars($image) ;?>" class="form-control form-control-lg"  >
           <div class="red-text mb-4" id='image'></div>
           </div>

           <input type="submit" name="submit" value ="Add" class="btn search-btn btn-lg btn-block">

</form>

         </div>
       </div>
     </div>
   </div>
 </div>
</section>


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
<?php } ?>





    <!-- <script src="js/jquery.min.js"></script> -->
    <script src="../js/main.js"></script>
    <script src="js/main.js"></script>
	<script src="js/bootstrap.min.js"></script>

  </body>
</html>