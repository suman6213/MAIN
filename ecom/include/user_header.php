<?php
   if(isset($message)){
      foreach($message as $messages){
         echo '
         <div class="message">
            <span>'.$messages.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="../css/user_style.css">
</head>
<body>
<header class="header">

<section class="flex">

   <a href="../interface/home.php" class="logo">ELECTRONIC <span>MART.</span></a>

   <nav class="navbar">
      <a href="../interface/home.php">Home</a>
      <a href="../interface/about.php">About</a>
      <a href="../interface/orders.php">Orders</a>
      <a href="../interface/shop.php">Shop</a>
      <a href="../interface/contact.php">Contact</a>
   </nav>

   <div class="icons">
      <?php
         $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
         $count_wishlist_items->execute([$user_id]);
         $total_wishlist_counts = $count_wishlist_items->rowCount();

         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_counts = $count_cart_items->rowCount();
      ?>
      <div id="menu-btn" class="fas fa-bars"></div>
      <a href="../interface/search_page.php"><i class="fas fa-search"></i></a>
      <a href="../interface/wishlist.php"><i class="fas fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
      <a href="../interface/cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
      <div id="user-btn" class="fas fa-user"></div>
   </div>

   <div class="profile">
      <?php          
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if($select_profile->rowCount() > 0){
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile["name"]; ?></p>
      <a href="../update/update_user.php" class="btn">Update Profile</a>
      <div class="flex-btn">
         <a href="../user/user_register.php" class="option-btn">Register</a>
         <a href="../user/user_login.php" class="option-btn">Login</a>
      </div>
      <a href="../user/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">Logout</a> 
      <?php
         }else{
      ?>
      <p>Please login or register first!</p>
      <div class="block-btn">
         <a href="../user/user_register.php" class="option-btn">Register</a>
         <a href="../user/user_login.php" class="option-btn">Login</a>
      </div>
      <?php
         }
      ?>      
   </div>

</section>

</header>
<script src="../js/script.js"></script>
</body>
</html>