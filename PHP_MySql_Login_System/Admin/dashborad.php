<?php
include "../controllers/session.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashborad</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css/style_main.css">
</head>


<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1><a href="dashborad.php">Website Phonepaserth Company</a></h1>
            <a href="AdminProfile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="allUser.php"><i class="fas fa-user-circle"></i>User</a>
            <a href="../controllers/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <div class="content">
        <h2>Home Page Admin</h2>
        <p>Welcome back, <?= $_SESSION['name'] ?>!</p>
    </div>
</body>

</html>