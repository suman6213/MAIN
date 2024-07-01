<?php
if (isset($message)) {
    foreach ($message as $messages) {
        echo '
         <div class="message">
            <span>' . $messages . '</span>
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
    <link rel="stylesheet" href="admin_style.css">
</head>

<body>
    <header class="header">

        <section class="flex">

            <a href="../admin/dashboard.php" class="logo">Admin<span>Panel</span></a>

            <nav class="navbar">
                <a href="../admin/dashboard.php">Home</a>
                <a href="../interface/products.php">Products</a>
                <a href="../interface/placed_orders.php">Orders</a>
                <a href="../user/users_accounts.php">Users</a>
                <a href="../interface/messages.php">Messages</a>
            </nav>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="user-btn" class="fas fa-user"></div>
            </div>

            <div class="profile">
                <?php
                if (isset($_SESSION['admin_name'])) {

                    $admin_id = $_SESSION['admin_id'];
                    $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
                    $select_profile->execute([$admin_id]);
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                ?>
                    <p><?php echo $_SESSION['admin_name']; ?></p>
                    <a href="update_profile.php" class="btn">Update Profile</a>
                    <div class="flex-btn">
                        <a href="admin_register.php" class="option-btn">Register</a>
                        <a href="admin_login.php" class="option-btn">Login</a>
                    </div>
                    <a href="admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">Logout</a>
                <?php } else { ?>
                    <p>Please login or register first!</p>
                    <div class="flex-btn">
                        <a href="admin_register.php" class="option-btn">Register</a>
                        <a href="admin_login.php" class="option-btn">Login</a>
                    </div>
                <?php } ?>

            </div>

        </section>

    </header>

    <script src="admin_script.js"></script>
</body>

</html>