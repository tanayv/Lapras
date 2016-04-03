<?php 
    
    include 'connection.php';
    
    session_start();
    $query1 = mysqli_query($connection, "SELECT * FROM botMsg GROUP by seshID");
    
    while ($row = mysqli_fetch_array($query1)) {
        $lastSeshID = $row['seshID'];
    }
    
    $newSeshID = $lastSeshID+1;
    $_SESSION['seshID'] = $newSeshID;

?>