<?php 
include "config/db_connect.php";

// write query for all meals
$sql = "SELECT * FROM meals ";

// get the result set (set of rows)
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free the $result from memory (good practise)
mysqli_free_result($result);

// write query for all meals
$sql = "SELECT * FROM categories ";

// get the result set (set of rows)
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

// close connection
mysqli_close($conn);
session_start();
if (!isset($_SESSION["id"]) == "") {
  $producs = $_SESSION["id"];
  $count = array_count_values($producs);
}
?>
<!DOCTYPE html>

<?php include('template/header.php'); ?>




<div class="container-1">
<!-- The searchbar -->

  <div class="row mt-2
  ">
    <div class="col-10">
      <input type="text" class="form-control search-input " id="live_search" placeholder="Search"  autocomplete="off" onkeyup="liveSearch(this)" >
    </div>
    <button type="text" class="btn col-2 search-btn " onclick="liveSearch(this)"><i class="fa fa-search" ></i></button>
  </div>
</div>
<div id="search_result"class=" col-lg-5 col-10 display ml-lg-3" >
<ul class="list-group" >
</ul>
</div>

<!--showcase-->
<div class="showcase ">
    <img src="pictures/logo.png" alt="" class="img">
</div>


<div class="foods">



  <!-- scrolling menu -->
  <div class="scrollmenu px-2 text-center ">
  <?php foreach($categories as $cat){ ?>
    <a href="#<?php echo $cat['category'] ?>"><?php echo $cat['category'] ?></a>
    <?php }?>
  </div>

<br>


<?php foreach($categories as $cat){ ?>
<div>
<div id="<?php echo $cat['category'] ?>"><h3 class="category-t text-center"><?php echo $cat['category'] ?></h3></div>
<div  class="food row px-4 " >
<?php foreach($meals as $meal):?>
  <?php if($meal['category']==$cat['category'] ){ ?>
    <?php include('template/items.php'); ?>
<?php } ?>
<?php endforeach; ?>
</div>
<br>
<hr>
<br>
 <?php }?>


</div>
</div>
</div>
</div>
<a href="http://localhost/restaurant/cart.php" class='cart-fixed'>
<?php if(isset($_SESSION['id']) && !count($_SESSION['id'])==''): ?>
<button class="fixed-bottom float-right btn cart_active m-3"><i class="fa fa fa-shopping-cart"></i>
  <span class="pl-2 new-span " 
  ><?php echo count($_SESSION['id']); ?></span>
  </button>
  <?php endif ?>
  </a>

<?php include('template/footer.php'); ?>

<script src="./js/main.js"></script> 

</body>
</html>