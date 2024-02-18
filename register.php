<?php

include 'config.php';

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

    $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if (mysqli_num_rows($select) > 0) {
        $message[] = 'user already exist!';
    } else {
        mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
        $message[] = 'registered successfully!';
        header('location:login.php');
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        input {
            text-align: center;
        }
    </style>
</head>

<body
    style="  background-image: url(images/login1.jpg);  background-size: cover; background-position: center; background: background: rgba(7, 40, 195, 0.8);">

    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
        }
    }
    ?>

    <div class="form-container">

        <form action="" method="post">
            <h3>انشاء حساب جديد</h3>
            <input type="text" name="name" required placeholder="اسم السمتخدم" class="box">
            <input type="email" name="email" required placeholder="البريد الالكتروني" class="box">
            <input type="password" name="password" required placeholder="كلمة المرور" class="box">
            <input type="password" name="cpassword" required placeholder="تأكيد كلمة المرور" class="box">
            <input type="submit" name="submit" class="btn" value="تسجيل حساب">
            <p>هل لديك حساب؟ <a href="login.php"> تسجيل دخول</a></p>
        </form>

    </div>

</body>

</html>