
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./css/style.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <title>Restaurant Name</title>

<style>


</style>

</head>
<body>
    
<nav class="navbar navbar-light ">
  <a class="navbar-brand" href="#">
    <img src="pictures/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
     name
  </a>
  <div id='nav-div'>

  <?php if(isset($_SESSION{'user'})) {?>

  <a href="http://localhost/restaurant/dashboard/dashboard.php"><button class="btn btn-nav "><i class="fa fa fa-user "></i></button></a>

<?php } else{ ?>
  <a href="http://localhost/restaurant/index.php"><button class="btn btn-nav "><i class="fa fa fa-home "></i></button></a>
  <a href="http://localhost/restaurant/cart.php"><button class="btn btn-nav cart-icon"><i class="fa fa fa-shopping-cart"></i>
 <?php if(!isset($_SESSION['id'])==''&& !count($_SESSION['id'])==''): ?>
  <span class="pl-2 span" style="color:var(--global);"
  ><?php echo count($_SESSION['id']); ?></span>
  <?php endif ?>
  </button></a>
<?php }?>
  </div>
</nav>