<?php 

require 'public/connection.php';
session_start();
//Checking if a user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");  //Then when your not logged in can't access users.php file
}

$errors = array();
$query = "SELECT * FROM  room WHERE is_booked=1 ORDER BY room_id";

$rooms= mysqli_query($connection, $query);

if($rooms) {
    while($room = mysqli_fetch_assoc($rooms)) {
        //var_dump($room);
        $room_id = $room['room_id'];

        //Get Last date of Check_out_date of relative room_id with current_date
        $query1 = "SELECT * FROM  reservation WHERE  room_id = $room_id ORDER BY check_out_date DESC LIMIT 1";

        

        $reservations= mysqli_query($connection, $query1);

        if($reservations) {

            // while($reservation = mysqli_fetch_assoc($reservations)) {
                $reservation = mysqli_fetch_assoc($reservations);
                // var_dump($reservation);
                echo $reservation['check_out_date'];
                echo "<br>";
                $current_date = date("Y-m-d");
                $check_out_date = $reservation['check_out_date'];

                if($current_date > $check_out_date) {
                    $query2 = "UPDATE reservation SET is_valid = 0 WHERE room_id = '{$room_id}' LIMIT 1";
                    $reservationResult = mysqli_query($connection, $query2);

                    if($reservationResult) {
                        $query3 = "UPDATE room SET is_booked = 0 WHERE room_id = '{$room_id}' LIMIT 1";
                        $roomResult = mysqli_query($connection, $query3); 
                        if($roomResult) {
                            echo "Room Details Updated";
                        } 
                        else {
                            $errors[] = "Query ERROR1";
                            break;
                        }
                    }
                    else {
                        $errors[] = "Query ERROR2";
                        break;
                    }
                    
                    
                    
                }
            //}
        }
        else {
            $errors[] = "Query ERROR3";
            break;
        }


    }

}
else {
    $errors[] = "Query ERROR4"; 
}

if(empty($errors)) {
    header("Location: ../room.php?refresh=success");
    exit();
}
else {
    var_dump($errors);
}



