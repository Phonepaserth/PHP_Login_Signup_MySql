<?php
include "../controllers/session.php";

include "../config/dbcon.php";

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT username,password, status, photo, id, date_time FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($username,$password, $status, $photo, $id, $date);
$stmt->fetch();
$stmt->close();
if ($status == 1){
    $status = "Admin";
}else{
    $status = "User";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
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
        <h2>Profile Page</h2>
        <div>
            <p><b>ຂໍ້ມູນຜູ້ດູແລລະບົບ:</b></p>
            <table>
                <tr>
                    <td>
                        <img src="<?= $photo ?>" alt="Profile" class="img">
                    </td>
                    <td>
                        <?php
                        echo "<form action=\"uploadAdmin.php?id=$id\" method=\"post\" enctype=\"multipart/form-data\">";
                        ?>
                            ເລືອກຮູບພາບຈາກໃນອຸປະກອນຂອງທ່ານ:
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="submit">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><?= $username ?></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><?= $password ?></td>
                </tr>
                <tr>
                    <td>status:</td>
                    <td><?= $status ?></td>
                </tr>
                <tr>
                    <td>date signup:</td>
                    <td><?= $date ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>