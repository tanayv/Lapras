<?php 

    include 'engine/connection.php';
    session_start();
    $customerID = "56c66be6a73e492741507583";
    $seshID = $_SESSION['seshID'];
    echo $customerID;
    
    $query1 = mysqli_query($connection, "SELECT * FROM botMsg WHERE customerID = '$customerID' ORDER BY time DESC");
    while ($row = mysqli_fetch_array($query1)) {
        
        $content = $row['content'];
        $sender = $row['sender'];
        $timest = $row['time'];
        
        
        if ($sender == 1) { //Message from bot
        echo "<p align='left'><b>Lapras</b><br>$content<br>$timest<br></p>";
        }
        
        elseif ($sender == 0 ) { //Message from user
        echo "<p align='right'><b>You</b><br>$content<br>$timest<br></p>";
        }
        
    }

?>