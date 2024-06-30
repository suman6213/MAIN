<?php

include '../include/connect.php';

session_start();

if(isset($_SESSION['admin_id'])){
    $admin_id = $_SESSION['admin_id'];
}
else{
    $admin_id='';
};

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
 
    $update_profile = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
    $update_profile->execute([$name, $admin_id]);
 
    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $prev_pass = $_POST['prev_pass'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
 
    if($old_pass == $empty_pass){
       $message[] = 'Please enter old password!';
    }elseif($old_pass != $prev_pass){
       $message[] = 'Old password not matched!';
    }elseif($new_pass != $cpass){
       $message[] = 'Confirm password not matched!';
    }else{
       if($new_pass != $empty_pass){
          $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
          $update_admin_pass->execute([$cpass, $admin_id]);
          $message[] = 'Password updated successfully!';
          session_destroy();
          header('Location:admin_login.php');
       }else{
          $message[] = 'Please enter a new password!';
       }
    }
    
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UX-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>

    <!-- font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!--custom css link-->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
    
<?php include '../include/admin_header.php'; ?>

<!--update user section starts-->

<section class="form-container">

   <form action="" method="post">
      <h3>Update Now</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <input type="text" name="name" required placeholder="Enter your username" maxlength="20"  class="box" value="<?= $fetch_profile["name"]; ?>">
      <input type="password" name="old_pass" placeholder="Enter your old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="Enter your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" placeholder="Confirm your new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" class="btn" name="submit">
   </form>

</section>

<!--update user section ends-->

<!--custom js link-->
<script src="../js/script.js"></script>

</body>
</html>
