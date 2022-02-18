<?php
session_start();

include "../config/dbcon.php";

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

$ip_add = $_SERVER['REMOTE_ADDR'];

$UserAdmin = "Admin";
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
//if ($stmt = $con->prepare('SELECT id, password, status FROM accounts WHERE username = ?')) {
if ($stmt = $con->prepare('SELECT accounts.id, accounts.password, role.role_name FROM `accounts` JOIN `role` on (role.id = accounts.status) WHERE accounts.username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', strtolower($_POST['username']));
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password, $status);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (md5($_POST['password']) === $password) {
            // Set md5 password
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            echo 'Welcome ' . $_SESSION['name'] . '!';

            $sql2 = "UPDATE `logging` SET `login_time`=now(),`src_ip`='$ip_add' WHERE user_id = '$id'";
            $stmt2 = $con->prepare($sql2);
            $stmt2->execute();
            $stmt2->close();

            if ($UserAdmin === $status){
                header('Location: ../Admin/dashborad.php');
            }else {
                header('Location: ../page/home.php');
            }
            
        } else {
            // Incorrect password
            echo 'Incorrect username and/or password!';
            header("Location: ../index.php?error=1");
        }
    } else {
        // Incorrect username
        echo 'Incorrect username and/or password!2';
        header("Location: ../index.php?error=2");
    }

	$stmt->close();
}
