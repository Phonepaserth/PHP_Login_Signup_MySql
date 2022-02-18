<?php
if ( @!$_GET['id'] ) { header("Location: allUser.php"); exit; }
$id = @$_GET['id'];
// if ( @!$_GET['confirm'] ) {

// echo "<center><div style=\"color:red; width:800; font-size:18pt; 
// border:1px solid red; padding:10px; text-align:center\">Do you really want 
// to delete the selected data?</div> [<a href=\"guestlist.php\">Cancel</a>] | 
// [<a href=\"?confirm=1&id=$id\">Yes</a>]</center>";

// } else {

require("../config/dbcon.php");
$sql = "DELETE FROM accounts WHERE id='$id' ";
if (mysqli_query($con, $sql)) {
    // echo "A record deleted successfully <br><a href=\"guestlist.php\">View Data</a>";
    mysqli_close($con);
    header("Location: allUser.php");
    exit;
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
// }
