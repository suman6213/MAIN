<?php

include '../include/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:../admin/admin_login.php');
};

if (isset($_POST['add_product'])) {

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $details = $_POST['details'];
    $details = filter_var($details, FILTER_SANITIZE_STRING);

    $image_01 = $_FILES['image_01']['name'];
    $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
    $image_size_01 = $_FILES['image_01']['size'];
    $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
    $image_folder_01 = '../uploaded_img/' . $image_01;

    $image_02 = $_FILES['image_02']['name'];
    $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
    $image_size_02 = $_FILES['image_02']['size'];
    $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
    $image_folder_02 = '../uploaded_img/' . $image_02;

    $image_03 = $_FILES['image_03']['name'];
    $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
    $image_size_03 = $_FILES['image_03']['size'];
    $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
    $image_folder_03 = '../uploaded_img/' . $image_03;

    $category = $_POST['category'];
    $category = filter_var($details, FILTER_SANITIZE_STRING);

    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
    $select_products->execute([$name]);

    if ($select_products->rowCount() > 0) {
        $message[] = 'Product name already exist!';
    } else {

        $insert_products = $conn->prepare("INSERT INTO `products`(name, details, price, image_01, image_02, image_03, category) VALUES(?,?,?,?,?,?,?)");
        $insert_products->execute([$name, $details, $price, $image_01, $image_02, $image_03, $category]);

        if ($insert_products) {
            if ($image_size_01 > 2000000 or $image_size_02 > 2000000 or $image_size_03 > 2000000) {
                $message[] = 'Image size is too large!';
            } else {
                move_uploaded_file($image_tmp_name_01, $image_folder_01);
                move_uploaded_file($image_tmp_name_02, $image_folder_02);
                move_uploaded_file($image_tmp_name_03, $image_folder_03);
                $message[] = 'New product added!';
            }
        }
    }
};

if (isset($_GET['delete'])) {

    $delete_id = $_GET['delete'];
    $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_product_image->execute([$delete_id]);
    $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
    unlink('../uploaded_img/' . $fetch_delete_image['image_01']);
    unlink('../uploaded_img/' . $fetch_delete_image['image_02']);
    unlink('../uploaded_img/' . $fetch_delete_image['image_03']);
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_product->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
    $delete_cart->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
    $delete_wishlist->execute([$delete_id]);
    header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <!--font awesome cdnjs link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!--custom css file link-->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

    <?php include '../include/admin_header.php' ?>

    <!--add products section starts-->


    <section class="add-products">

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="flex">
                <div class="inputBox">
                    <span>Product Name (required)</span>
                    <input type="text" required placeholder="Enter product name" name="name" maxlength="100" class="box">
                </div>
                <div class="inputBox">
                    <span>Product Price (required)</span>
                    <input type="number" min="0" max="99999999999999" required placeholder="Enter product Price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
                </div>
                <div class="inputBox">
                    <span>image 01 (required)</span>
                    <input type="file" name="image_01" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>image 02 (required)</span>
                    <input type="file" name="image_02" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>image 03 (required)</span>
                    <input type="file" name="image_03" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                </div>
                <div class="inputBox">
                    <span>product details (required)</span>
                    <textarea name="details" placeholder="Enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
                </div>
                <div class="inputBox">
                    <span class="drop">Category (required)</span>
                    <select name="category" class="select" id="">
                        <option value="laptop">Laptop</option>
                        <option value="tv">Tv</option>
                        <option value="camera">Camera</option>
                        <option value="mouse">Mouse</option>
                        <option value="fridge">Fridge</option>
                        <option value="washing">Washing</option>
                        <option value="smartphone">Smartphone</option>
                        <option value="watch">Watch</option>
                    </select>
                </div>
            </div>

            <input type="submit" value="add product" class="btn" name="add_product">
            </div>
        </form>

    </section>

    <!--add products section ends-->

    <!--show product section starts-->

    <section class="show-products">

        <h1 class="heading"> New Products</h1>
        <div class="box-container">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                    <div class="box">
                        <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
                        <div class="name"><?= $fetch_products['name']; ?></div>
                        <div class="price"><?= $fetch_products['price']; ?></div>
                        <div class="details"><?= $fetch_products['details']; ?></div>
                        <div class="flex-btn">
                            <a href="../update/update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Update</a>
                            <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">Delete</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No products added yet!</p>';
            }
            ?>

        </div>

    </section>


    <!--show product section ends-->

    <!--custon js file link-->
    <script src="../js/admin_script.js"></script>

</body>

</html>