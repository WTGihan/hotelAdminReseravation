<?php 


require 'connection.php';

// wtgihan@gmail.com = 1234
// anura@gmail.com = 1111
// chintha@gmail.com = 2222
// thanuj@gmail.com = 3333
// ravindu@gmail.com = 4444
// dilshani@gmail.com = 5555
// nimni@gmail.com = 6666
// $first_name = "Nimni";
// $last_name = "Nirmani";
// $email = "nimni@gmail.com";
// $password = 6666;

// $username = "WTGihan";
// $email  = "wtgihan@gmail.com";
// $password = 1111;
// $user_level = 1;


//Owner table
// $owner_user_id = 2;
// $first_name = "Ravindu";
// $last_name = "Ranaweera";
// $email = "rane@gmail.com";
// $salary = "75000";
// $location = "Weligam,Matara";
// $contact_num = "0774561256";


//room_type table

// $floor_number = 2;
// $max_guest = 4;
// $facilites = "Free Wifi and Free Breakfast";
// $room_price = "$100";
// $description = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, commodi!";
// $type_name = "Single";

// //$hashed_password = sha1($password);

// $query = "INSERT INTO room_type ( 
//          floor_number, max_guest, facilites, room_price, description, type_name)
//          VALUES (
//          '{$floor_number}', '{$max_guest}', '{$facilites}', '{$room_price}', '{$description}', '{$type_name}'
//          )";

// $room_type_id = 1;
// $room_number = "B104";
// $is_booked = 0;

// $query = "INSERT INTO room ( 
//          room_type_id, room_number, is_booked)
//          VALUES (
//          '{$room_type_id}', '{$room_number}', '{$is_booked}'
//          )";


// $room_type_id = 1;
// $query = "SELECT * FROM room_type WHERE room_type_id = {$room_type_id} LIMIT 1";

// $result_set = mysqli_query($connection, $query);

// if($result_set) {
//     // Check num of rows
//     if(mysqli_num_rows($result_set) == 1) {
//         $result = mysqli_fetch_assoc($result_set);
//         $facilites = $result['facilites'];  
        
//     }

// }

// echo $facilites;


$room_type_id = 1;
$discount_rate = 10;
$start_date = "2020-10-10";
$end_date = "2020-10-30";

$query = "INSERT INTO room_discount ( 
         room_type_id, discount_rate, start_date, end_date)
         VALUES (
         '{$room_type_id}', '{$discount_rate}', '{$start_date}', '{$end_date}'
         )";

mysqli_query($connection, $query);

