<?php 
include('../config/db_connect.php');


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
        echo 1;
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

   }else{
     echo 'query error'.mysqli_error($conn);
   }
  }
      }//end of post check

      ?>