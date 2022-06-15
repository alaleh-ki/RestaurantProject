



<style>

    .quantity{
        border: 2px solid #f4f4f4 ;
        color:black ;
        border-radius:15px;
        padding:2;
    }
    .quantity span{
   color:var(--global);
    }
    .quantity p{
      display: inline;
    }


</style>





<div class="margin py-3 clearfix col-md-6 col-lg-4 col-sm-12" id="<?php echo htmlspecialchars($meal['id'])?>-meal">
  <div class="row items py-3 d-flex ">
    <div class="col-6 col-lg-4 image-d  p-0">
      <img src="pictures/<?php echo htmlspecialchars($meal['image'])?>.jpg" alt="" class="images ">
    </div>
    <div class="col-6 col-lg-8 content">
<h5>
<?php echo htmlspecialchars($meal['title'])?></h5>
    <p >
    <?php echo htmlspecialchars($meal['ingredients'])?>
    </p>



    <div class="d-flex clearfix">
   <div class="col price "><?php echo htmlspecialchars($meal['price'])?>$</div>
   
   <div class="col">
     <button class="btn add btn-sm" data-id="<?php echo htmlspecialchars($meal['id'])?>" ><i class="fa fa-plus" aria-hidden="true"></i></button>


    </div>
    </div>

    <?php if(!isset($_SESSION['id'])==''){ ?>
      <?php foreach ($count as $key => $value) {?>
        <?php if($meal['id']==$key){?>
        <div class="row">
    <div class="col-6 quantity mt-3" id=<?php echo htmlspecialchars($key)?> >

<span>quantity:</span> <p><?php echo $value ?></p>


  </div>

  <div class="col-6 mt-3 delete.col">
  <button class="btn btn-sm btn-danger delete" data-delete="<?php echo htmlspecialchars($key)?>" id='<?php echo htmlspecialchars($key)?>-d' onclick="deleteMenu(this)" ><i class="fa fa-minus" aria-hidden="true"></i>
</button>
</div>

</div>
<?php }?>
<?php }?>


<?php }?>

    </div>
  </div>
</div>
<br>

