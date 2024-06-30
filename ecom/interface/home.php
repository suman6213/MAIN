<?php

include '../include/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
   include 'wishlist_cart.php';
} else {
   $user_id = '';
   include 'wishlist_cart.php';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!--swiper cdn link-->
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

   <!--custom css link-->
   <link rel="stylesheet" href="../css/user_style.css">

</head>

<body>

   <?php include '../include/user_header.php'; ?>

   <div class="home-bg">

      <section class="home">

         <div class="swiper home-slider">

            <div class="swiper-wrapper">

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="../images/tv.png" alt="">
                  </div>
                  <div class="content">
                     <span>upto 50% off</span>
                     <h3>latest LED TV</h3>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="../images/lap.png" alt="">
                  </div>
                  <div class="content">
                     <span>upto 30% off</span>
                     <h3>latest Laptops</h3>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="../images/refri.png" alt="">
                  </div>
                  <div class="content">
                     <span>upto 60% off</span>
                     <h3>latest Refrigerator</h3>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div>

            </div>

            <div class="swiper-pagination"></div>

         </div>

      </section>

   </div>

   <!--home category section starts-->
   <section class="category">

      <h1 class="heading">Shop by Category</h1>

      <div class="swiper category-slider">

         <div class="swiper-wrapper">

            <a href="category.php?category=laptop" class="swiper-slide slide">
               <img src="../images/icon-1.png" alt="">
               <h3>Laptop</h3>
            </a>

            <a href="category.php?category=tv" class="swiper-slide slide">
               <img src="../images/icon-2.png" alt="">
               <h3>Tv</h3>
            </a>

            <a href="category.php?category=camera" class="swiper-slide slide">
               <img src="../images/icon-3.png" alt="">
               <h3>Camera</h3>
            </a>

            <a href="category.php?category=mouse" class="swiper-slide slide">
               <img src="../images/icon-4.png" alt="">
               <h3>Mouse</h3>
            </a>

            <a href="category.php?category=fridge" class="swiper-slide slide">
               <img src="../images/icon-5.png" alt="">
               <h3>Fridge</h3>
            </a>

            <a href="category.php?category=washing" class="swiper-slide slide">
               <img src="../images/icon-6.png" alt="">
               <h3>Washing Machine</h3>
            </a>

            <a href="category.php?category=smartphone" class="swiper-slide slide">
               <img src="../images/icon-7.png" alt="">
               <h3>Phone</h3>
            </a>

            <a href="category.php?category=watch" class="swiper-slide slide">
               <img src="../images/icon-8.png" alt="">
               <h3>Watch</h3>
            </a>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>
   <!--home category section ends-->


   <!--home products section starts-->
   <section class="home-products">

      <h1 class="heading">Latest Products</h1>

      <div class="swiper products-slider">

         <div class="swiper-wrapper">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                  <form action="" method="post" class="swiper-slide slide">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="../uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name"><?= $fetch_product['name']; ?></div>
                     <div class="flex">
                        <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                  </form>
            <?php
               }
            } else {
               echo '<p class="empty">No products added yet!</p>';
            }
            ?>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

   <!--home product section ends-->

   <?php include '../include/footer.php'; ?>
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="script.js"></script>

   <script>
      var swiper = new Swiper(".home-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
      });

      var swiper = new Swiper(".category-slider", {
         loop: true,
         spaceBetween: 30,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 2,
            },
            650: {
               slidesPerView: 3,
            },
            768: {
               slidesPerView: 4,
            },
            1024: {
               slidesPerView: 5,
            },
         },
      });

      var swiper = new Swiper(".products-slider", {
         loop: false,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            550: {
               slidesPerView: 2,
            },
            768: {
               slidesPerView: 2,
            },
            1024: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>