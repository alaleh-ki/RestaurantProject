<?php
include('config/db_connect.php');


if (isset($_POST["id"])) {
    
    session_start();
    $cart = isset($_SESSION["id"]) ? $_SESSION["id"] : [];

    array_push($cart, $_POST["id"]);
    
    $_SESSION["id"] = $cart;
    
    echo json_encode($cart);
}



//delete button
if (isset($_POST["delete"])) {
 $delete = $_POST["delete"];
 session_start();
 $session = $_SESSION["id"];
 $index= array_search($delete,$session);
 unset($session[$index]);
 $_SESSION["id"] = $session;

}


//deleting from db
if (isset($_POST["delete-admin"])) {
    $delete = $_POST["delete-admin"];
$sql = "DELETE FROM meals WHERE id='$delete' ";
if(mysqli_query($conn,$sql)){
    echo 'yes';
}else{
    echo 'no';
}
   }





   $title = $ingredients = $price = $image ='';
   $errors = array('title'=>'','ingredients'=>'','price'=>'','image'=>'','category'=>'');
  



  //edit function
  if (isset($_POST['submit'])){
    // check title
    $post= json_decode($_POST['submit'], true);
    if (empty($post['title'])){
      $errors['title']= "Title is required<br/>";
    }else{
      $title = $post['title'];
    }
    // check category
    if (empty($post['category'])){
        $errors['category']= "Category is required<br/>";
      }else{
        $category = $post['category'];
      }
    // check ingredients
    if(empty($post['ingredients'])){
      $errors['ingredients']= 'At least one ingredient is required <br />';
    } else{
      $ingredients = $post['ingredients'];
    }
    // check price
    if (empty($post['price'])){
        $errors['price']= "Price is required<br/>";
      }else{
        $price = $post['price'];
      }
      // check image name
    if (empty($post['image'])){
        $errors['image']= "Imege is required<br/>";
      }else{
        $image = $post['image'];
      }
    if (array_filter($errors)){
   print_r( json_encode($errors));
    }else{
      echo 1;
      // protecting database from codes
       $category =$conn->real_escape_string($post['category']);
       $title = mysqli_real_escape_string($conn,$post['title']);
       $ingredients = mysqli_real_escape_string($conn,$post['ingredients']);
       $price= mysqli_real_escape_string($conn,$post['price']);
       $image = mysqli_real_escape_string($conn,$post['image']);
       $id=$post['id'];

       // creat sql
       $sql ="UPDATE meals SET 
       title='$title',
    price='$price',
        category='$category',
        ingredients='$ingredients',
        image='$image'
        WHERE id ='$id'";
    
       // save to db
       if(mysqli_query($conn,$sql)){
    
        echo 'heyy';
         // succes
          // header('location: index.php');
       }else{
         echo 'query error'.mysqli_error($conn);
       }
    }
    }//end of post check









    //add function
    if (isset($_POST['add'])){
      // check title
      $post= json_decode($_POST['add'], true);

      if (empty($post['title'])){
        $errors['title']= "Title is required<br/>";
      }else{
        $title = $post['title'];
      }
      // check category
      if (empty($post['category'])){
          $errors['category']= "Category is required<br/>";
        }else{
          $category = $post['category'];
        }
      // check ingredients
      if(empty($post['ingredients'])){
        $errors['ingredients']= 'At least one ingredient is required <br />';
      } else{
        $ingredients = $post['ingredients'];
      }
      // check price
      if (empty($post['price'])){
          $errors['price']= "Price is required<br/>";
        }else{
          $price = $post['price'];
        }
        // check image name
      if (empty($post['image'])){
          $errors['image']= "Imege is required<br/>";
        }else{
          $image = $post['image'];
        }
      if (array_filter($errors)){
     print_r( json_encode($errors));
      }else{

        // protecting database from codes
         $category =$conn->real_escape_string($post['category']);
         $title = mysqli_real_escape_string($conn,$post['title']);
         $ingredients = mysqli_real_escape_string($conn,$post['ingredients']);
         $price= mysqli_real_escape_string($conn,$post['price']);
         $image = mysqli_real_escape_string($conn,$post['image']);
  
         // creat sql
   // creat sql
   $sql = "INSERT INTO meals(title,ingredients,price,image,category) VALUES ('$title','$ingredients','$price','$image','$category')";

   // save to db
   if(mysqli_query($conn,$sql)){
     // succes
     echo 1;
   }else{
     echo 'query error'.mysqli_error($conn);
   }
  }
      }//end of post check





    //add category function
    if (isset($_POST['addCategory'])){
      // check title
      $post= json_decode($_POST['addCategory'], true);
      // check category
      if (empty($post['category'])){
          $errors['category']= "Category is required<br/>";
        }else{
          $category = $post['category'];
        }
      if (array_filter($errors)){
     print_r( json_encode($errors));
      }else{
        // protecting database from codes
         $category =$conn->real_escape_string($post['category']);
   // creat sql
   $sql = "INSERT INTO categories(id,category) VALUES (null,'$category')";
   // save to db
   if(mysqli_query($conn,$sql)){
     // succes
     echo 1;
   }else{
     echo 'query error'.mysqli_error($conn);
   }
  }
      }//end of post check



      //deleting category from db
if (isset($_POST["delete-category"])) {
  $delete = $_POST["delete-category"];
$sql = "DELETE FROM categories WHERE id='$delete' ";
if(mysqli_query($conn,$sql)){
  echo 'yes';
}else{
  echo 'no';
}
 }


 //signout
if (isset($_POST["signout"])) {
  session_start();
  unset($_SESSION["user"]);
 echo 1;
 }


 //live search
 if (isset($_POST["input"])) {
$input=$_POST["input"];
$sql = "SELECT * FROM meals WHERE title LIKE '%{$input}%' ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
$search_result = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

foreach($search_result as $res) { ?>
 <li class="list-group-item">
 <div class="row">
 <div class="col-10">
 <a href="#<?php echo $res['id']?>-meal"><?php echo $res['title'] ;?></a>
 </div>
 <div class="col-2">
 <img src="pictures/<?php echo $res['image'];?>.jpg" class="images_result ">
 </div>
 </div>
 </li>


<?php }
 }else{  
  echo"";
}
 }?>
