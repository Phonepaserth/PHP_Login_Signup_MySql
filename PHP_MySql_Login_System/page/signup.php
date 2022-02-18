<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_alert.css">
</head>

<body>
    <?php
    if (@$_GET['registration']) {
        //echo "<script>alert('ການລົງທະບຽນຊື່ຜູ້ໃຊ້ງານໃໝ່ຂອງທ່ານບໍ່ສຳເລັດ !!');</script>"; //ສະແດງ alert ເພື່ອແຈ້ງເຕືອນ
        echo "<div class=\"alert2\"><h3>ການລົງທະບຽນຊື່ຜູ້ໃຊ້ງານໃໝ່ຂອງທ່ານບໍ່ສຳເລັດ !!</h3></div>";
    } else if (@$_GET['PasswordError']) {
        //echo "<script>alert('ກະລຸນາກວດສອນລະຫັດຜ່ານຄືນ');</script>";
        echo "<div class=\"alert2\"><h3>ກະລຸນາກວດສອນລະຫັດຜ່ານຄືນ</h3></div>";
    } else if (@$_GET['UsernameError']) {
        //echo "<script>alert('ກະລຸນາກວດສອນຊື່ຜູ້ໃຊ້ງານຄືນ ມີຄົນໃຊ້ຊື່ນັ້ນແລ້ວ');</script>";
        echo "<div class=\"alert2\"><h3>ກະລຸນາກວດສອນຊື່ຜູ້ໃຊ້ງານຄືນ ມີຄົນໃຊ້ຊື່ນັ້ນແລ້ວ</h3></div>";
    } else {
        echo "&nbsp;";
    }
    ?>
    <div class="login">
        <h1>ສະໝັກບັນຊີໃໝ່</h1>
        <form action="../controllers/auth_register.php" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password2" placeholder=" Confirm Password" id="password" required>
            <input type="submit" value="ລົງທະບຽນ">
            <p>ທ່ານມີຊື່ຜູ້ໃຊ້ງານແລ້ວບໍ ? <a href="../index.php"><u>ເຂົ້າສູ່ລະບົບ</u></a></p>
        </form>
    </div>
</body>

</html>