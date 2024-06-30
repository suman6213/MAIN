<?php

include '../include/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UX-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

   <!--custom css link-->
   <link rel="stylesheet" href="../css/user_style.css">

</head>

<body>
<?php include '../include/user_header.php'; ?>

<!--about section starts-->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="../images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>Why choose us?</h3>
         <p>Welcome to Online Electronic Mart, where sophistication finds its virtual abode. Our meticulously curated collection unveils a world of timeless elegance, a haven for those who seek distinction beyond trends. With an unwavering commitment to quality, each item gracing our selection is a testament to craftsmanship.
            We don't just offer products; we offer an experience. Our team is dedicated to guiding you towards selections that mirror your tastes and aspirations, ensuring that every choice echoes your individuality. Beyond the act of shopping, we stand for an ethos – a seamless journey where refinement takes center stage.
            Join us in redefining online commerce, where elegance meets functionality and each interaction becomes a brushstroke on the canvas of sophistication.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<!--about section ends-->

<!--reviews section starts-->

<section class="reviews">

   <h1 class="heading">Client's Reviews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="../images/pic1.jpg" alt="">
            <p>"I've finally found my haven for all things stylish. Online Electronic Shop isn't just a marketplace; it's an immersion into sophistication. From their seamless interface to the quality of products, every aspect speaks of excellence."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Suman Khatri</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="../images/pic2.jpg" alt="">
            <p>"A remarkable experience with Online Electronic Shop. Every purchase feels like investing in art. The curated selection exudes elegance, and their personalized assistance is a testament to their commitment to refinement."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Puskar Neupane</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="../images/pic3.jpg" alt="">
            <p>"Online Electronic Shop has raised the bar for online shopping. It's not just about the products; it's about the experience. The team's guidance has led me to discover pieces that resonate with my style, and I can't imagine shopping elsewhere."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Ashish Khadka</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="../images/pic4.jpg" alt="">
            <p>"Navigating Online Electronic Shop is like strolling through a gallery of taste. The range of products is exquisite, and their dedication to assisting clients in finding their unique gems truly sets them apart."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Gobinda Oli</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="../images/pic5.jpg" alt="">
            <p>"My journey with Online Electronic Shop has been a revelation. Their collection is a tribute to artistry, and their customer service feels like a partnership. It's refreshing to find a platform that understands and celebrates refined taste."</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Sachin Sulu</h3>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<?php include '../include/footer.php'; ?>
<!-- reviews section ends
<!--custom js link-->
<script src="../js/script.js"></script>
</body>
</html>