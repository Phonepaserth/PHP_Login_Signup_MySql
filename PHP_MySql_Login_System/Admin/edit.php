<!DOCTYPE html>
<html lang="en">
<?php
include "../controllers/session.php";
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
    <br>
    <?php
    if (@!$_GET['id']) {
        header("Location: allUser.php");
        exit;
    }
    $id = @$_GET['id'];
    require("../config/dbcon.php");
    if (@!$_POST['id']) {
        $sql = "select * from accounts where id='$id' ";
        if (!$rs = mysqli_query($con, $sql)) {
            echo "<center style='color:red'>Error: " . $sql . "<br>" . mysqli_error($con) . "</center>";
            exit;
        }
        $row = mysqli_fetch_assoc($rs);
    ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <table border="1" align="center" style="width: auto;">
                <tr>
                    <th>Username:</th>
                    <td><input name="Username" value="<?php echo $row['username'] ?>"></td>
                </tr>
                <tr>
                    <th>status:</th>
                    <td>
                        <select name="status">
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                        </select>
                    </td>
                    <!-- <td><input name="status" value="<?php echo$row['status'] ?>"></td> -->
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" value=" ບັນທຶກ "></td>
                </tr>
            </table>
        </form>
    <?php
    } else {
        $sql = "UPDATE accounts SET username='$_POST[Username]', status='$_POST[status]' WHERE id='$_POST[id]' ";
        if (mysqli_query($con, $sql)) {
            // echo "A record updated successfully <br><a href=\"guestlist.php\">View Data</a>";
            mysqli_close($con);
            header("Location: allUser.php");
            exit;
        } else echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
    ?>
</body>

</html>