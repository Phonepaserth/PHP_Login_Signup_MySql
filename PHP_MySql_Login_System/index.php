<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/style_alert.css">
</head>

<body>
    <?php
    if (@$_GET['error']) {
        //echo "<script>alert('ພົບຂໍ້ຜິດພາດ, ກະລຸນາກວດສອບ username ຫຼື password ຄືນ');</script>"; //ສະແດງ alert ເພື່ອແຈ້ງເຕືອນ
        echo "<div class=\"alert2\"><h3>ພົບຂໍ້ຜິດພາດ, ກະລຸນາກວດສອບ username ຫຼື password ຄືນ</h3></div>"; //ສະແດງ alert ເພື່ອແຈ້ງເຕືອນ
    } else if (@$_GET['registration']) {
        //echo "<script>alert('ການລົງທະບຽນຊື່ຜູ້ໃຊ້ງານໃໝ່ຂອງທ່ານສຳເລັດ');</script>";
        echo "<div class=\"alert\"><h3>ການລົງທະບຽນຊື່ຜູ້ໃຊ້ງານໃໝ່ຂອງທ່ານສຳເລັດ</h3></div>"; //ສະແດງ alert
    } else {
        echo "&nbsp;";
    }
    ?>
    

    <div class="login">
        <h1>ລົງຊື່ເຂົ້າໃຊ້ງານ</h1>
        <form action="./controllers/authenticate.php" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="ເຂົ້າສູ່ລະບົບ">
            <p>ທ່ານມີຊື່ຜູ້ໃຊ້ງານແລ້ວບໍ ? <a href="./page/signup.php"><u>ລົງທະບຽນຜູ້ໃຊ້ງານໃໝ່</u></a></p>
        </form>
    </div>
</body>

</html>