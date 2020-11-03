<?php 

if(isset($_POST['submit'])) {
    $room_id = $_POST['room_id'];
    header("Location: ../reservation.php?room_id=".$room_id);
} 