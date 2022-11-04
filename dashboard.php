<?php

session_start();

if (isset($_SESSION['MOBILE'])) {
    echo "Hello" . "  ". "<b>" . ucwords($_SESSION['NAME']). "</b>";		
}else{
    header("Location:login.php");
    die();
}

?>
<br><br>
<p><a href="logout.php">Logout</a></p>