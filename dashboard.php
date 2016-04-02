<?php 
    session_start();
    $a = $_SESSION['customerID'];
    echo "Customer ID: " . $a;
    
    echo "<a href='signOutScript.php'>Sign Out</a>";
?>