<?php
session_start();

include "../config/dbcon.php";

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['password2'])) {
    // Could not get the data that should have been sent.
    exit('Please fill both the username and password fields!');
}

// get ip
$ip_add = $_SERVER['REMOTE_ADDR'];


$User = strtolower($_POST['username']);
$Pwd = $_POST['password'];
$Pwd2 = $_POST['password2'];
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT accounts.id, accounts.password, role.role_name FROM `accounts` JOIN `role` on (role.id = accounts.status) WHERE accounts.username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $User);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {

        echo 'ມີຜູ້ໃຊ້ແລ້ວ';
        header("Location: ../page/signup.php?UsernameError=1");
    } else {
        // Incorrect username
        //echo 'Incorrect username and/or password!2';

        if ($Pwd == $Pwd2) {

            $Pwd = md5($Pwd); //encryption password ການເຂົ້າລະຫັດ ໂດຍໃຊ້ງານ Fuction md5

            $sql = "INSERT INTO accounts(username, password, photo, status, date_time) VALUES ('$User', '$Pwd',DEFAULT,DEFAULT,now())";



            if ($con->query($sql) === TRUE) {

                $sql2 = "SELECT `id`FROM `accounts` WHERE username = '$User'";
                $stmt1 = $con->prepare($sql2);
                $stmt1->execute();
                $stmt1->bind_result($id);
                $stmt1->fetch();
                $stmt1->close();

                $sql3 = "INSERT INTO `logging`(`login_time`, `src_ip`, `user_id`) VALUES (now(),'$ip_add','$id')";
                $stmt2 = $con->prepare($sql3);
                $stmt2->execute();
                $stmt2->close();



                echo "New record created successfully";
                header("Location: ../index.php?registration=1");
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
                header("Location: ../page/signup.php?registration=0");
            }
        } else {
            header("Location: ../page/signup.php?PasswordError=1");
        }
    }

    $stmt->close();
}
