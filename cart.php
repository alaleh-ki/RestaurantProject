
<?php 

session_start();

include('config/db_connect.php');

	// write query for all meals
	$sql = 'SELECT * FROM meals ';

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);


	// fetch the resulting rows as an array
	$meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

//  print_r(array_count_values($producs));


?>



<!DOCTYPE html>
<style>
    .cart {
       background-color: #f4f4f4 !important;
    }
    .price{
        border: 2px solid #f4f4f4 ;
        color:var(--global) ;
        margin-right:2px;
        border-radius:15px;
        padding:0;
    }
    .btn-pay{
      position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: var(--global);
  color: white;
  text-align: center;
  z-index:2;
  height:55px;
    }

</style>
<?php include('template/header.php'); ?>
<!--showcase-->
<div class="showcase">
    <img src="pictures/logo.png" alt="" class="img">
</div>


<?php if(!isset($_SESSION['id'])==''){ ?>
<?php $producs=$_SESSION['id']; ?>
<?php $count=array_count_values($producs); ?>
<div class="cart pt-3">
<?php foreach ($count as $key => $value) {?>
 <?php foreach($meals as $meal){?>
 <?php if($meal['id']==$key){?>

    <div class="margin  clearfix col-12 px-lg-5 px-md-5 my-2" id='<?php echo htmlspecialchars($key)?>-d-meal'>
  <div class="row items d-flex container p-0 ">
    <div class="col-6 col-lg-9 content">
<h5>
<?php echo htmlspecialchars($meal['title'])?></h5>
    <p >
    <?php echo htmlspecialchars($meal['ingredients'])?>
    </p>
    <div class="d-flex clearfix">
   <div class=" price"><?php echo htmlspecialchars($meal['price'])?>$</div>
   
   <div class="">
<div class="price  px-2">
   <button class="btn add-cart btn-sm" data-id="<?php echo htmlspecialchars($meal['id'])?>" ><i class="fa fa-plus" aria-hidden="true"></i></button>
  <span>quantity:</span><span class='quantity'><?php echo $value ?></span> 
    <button class="btn btn-sm btn-danger delete-cart" data-delete="<?php echo htmlspecialchars($key)?>" id='<?php echo htmlspecialchars($key)?>-d-cart'><i class="fa fa-minus" aria-hidden="true"></i>
</button>
</div>
    </div>
    </div>


    </div>
    <div class="col-6 col-lg-3 image-d p-1 ">
      <img src="pictures/<?php echo htmlspecialchars($meal['image'])?>.jpg" alt="" class="images ">
    </div>
  </div>
</div>





<?php }?>
<?php }?>
<?php }?>
</div>
<?php } ?>

<div>

<button class="btn btn-pay">pay</button>

</div>


    
<?php include('template/footer.php'); ?>
<script src="./js/main.js"></script> 
</body>
</html>

