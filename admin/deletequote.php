New quote form will go here

<?php
// cehck user is logged in 
if (isset($_SESSION['admin'])) {
    
    // delete quote!
    $deletequote_sql = "DELETE FROM `quotes` WHERE `quotes`.`ID`=".$_REQUEST['ID'];
    $deletequote_query = mysqli_query($dbconnect, $deletequote_sql);

?>

<h1>Delete Success</h1>

<p>The quote has been deleted</p>

<?php

} // end user logged in if

else {

    $login_error = 'Please login to access this page';
    header("Location: index.php?page=../admin/login&error=$login_error");

} // end user not logged in else

?>