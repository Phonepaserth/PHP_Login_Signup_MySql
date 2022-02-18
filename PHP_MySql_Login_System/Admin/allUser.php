<?php
include "../controllers/session.php";

include "../config/dbcon.php";

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$sql = "SELECT accounts.password, accounts.status, accounts.photo, role.role_name FROM `accounts` JOIN `role` on (role.id = accounts.status) where accounts.id = ?";
$stmt = $con->prepare($sql);
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $status, $photo, $role);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>All User Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css/style_main.css">
</head>
<?php
require("../config/dbcon.php");
$sql = "SELECT accounts.id, accounts.username, accounts.password, accounts.photo, accounts.date_time, role.role_name, logging.login_time ,logging.src_ip FROM `accounts` JOIN `role` on (role.id = accounts.status) JOIN `logging` ON (logging.user_id = accounts.id)";
if (!$rs = mysqli_query($con, $sql)) {
    echo "<center style='color:red'>Error: " . $sql . "<br>" . mysqli_error($con) .
        "</center>";
    exit;
}
?>

<body class="loggedin">
    <nav class="navtop">
        <div>
            <h1><a href="dashborad.php">Website Phonepaserth Company</a></h1>
            <a href="AdminProfile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="allUser.php"><i class="fas fa-user-circle"></i>User</a>
            <a href="../controllers/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <br>
    <table border=1 align=center width=800>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Status</th>
            <th>Date Signup</th>
            <th>Last Login</th>
            <th>Ip Address</th>
            <th>Profile</th>
            <th>Options</th>
            
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($rs)) {
            echo "
            <tr align=center>
                <td>$row[id]</td><td>$row[username]</td> 
                <td>$row[role_name]</td>
                <td>$row[date_time]</td>
                <td>$row[login_time]</td>
                <td>$row[src_ip]</td>
                <td><img src=\"$row[photo]\" alt=\"Profile\" class=\"img\"></td>
                <td><a href=\"edit.php?id=$row[id]\">ແກ້ໄຂ</a> | <a href=\"drop.php?id=$row[id]\" onclick=\"return confirm('Do you really want to delete the selected data?')\">ລົບບັນຊີ</a></td>
            </tr>";
        }
        mysqli_close($con);
        ?>
        <tr>
            <td></td>
            <td colspan=5><input style="width: 200px; height: 40px; color: white; background-color: #2868c7;" type=button value="ສະໝັກບັນຊີໃໝ່" onclick="location='../page/signup.php'"></td>
        </tr>
    </table>
</body>

</html>