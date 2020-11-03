<?php 


require '../inc/public/connection.php';

// wtgihan@gmail.com = 1234
// anura@gmail.com = 1111
// chintha@gmail.com = 2222
// thanuj@gmail.com = 3333
// ravindu@gmail.com = 4444
// dilshani@gmail.com = 5555
// nimni@gmail.com = 6666

// $emp_id = 1;
// $user_level = 2;
// $username = "Tharindu";
// $password = 1234;
// $email = "wtgihan@gmail.com";




// $hashed_password = sha1($password);
// $query = "INSERT INTO reception ( 
//     emp_id, user_level, username, password, email)
//     VALUES (
//     '{$emp_id}', '{$user_level}', '{$username}', '{$hashed_password}',  '{$email}'
//     )";

// $result = mysqli_query($connection, $query);

// if($result) {
//         echo 'success';
//     }


$customer_id = 1;
$reception_user_id = 1;
$room_id = 1;
$no_of_guest = 5;
$check_in_date1= '2020-09-30';
$check_out_date2 = '2020-10-03';
$time1 = strtotime($check_in_date1);
$time2 = strtotime($check_out_date2);
$check_in_date = date('Y-m-d',$time1);
$check_out_date = date('Y-m-d',$time2);

echo '9';

$query = "INSERT INTO reservation (";
$query .= "customer_id, reception_user_id, room_id, check_in_date, check_out_date, no_of_guest, is_valid";
$query .= ") VALUES (";
$query .= "'{$customer_id}', '{$reception_user_id}', '{$room_id}', '{$check_in_date}', '{$check_out_date}', '{$no_of_guest}', 1";
$query .= ")";
echo '10';

// $is_booked = 1;
// $room_id =1;
// $query1 = "UPDATE room SET ";
// $query1 .= "is_booked = '{$is_booked}' ";
// $query1 .= "WHERE room_id = '{$room_id}' LIMIT 1";

$result = mysqli_query($connection, $query);
echo '11';
if($result) {
    echo 'success';
}
echo '12';   

// $contact_num = '0774664827';
// $query4 = "SELECT * FROM customer WHERE contact_number= '{$contact_num}'  LIMIT 1";
// $customers = mysqli_query($connection, $query4);
// // echo 'customer1';
// // echo $customers;
// if($customers) {
//     echo "success";
//     if(mysqli_num_rows($customers) == 1) {
//         echo "10<br>";
//         $customer = mysqli_fetch_assoc($customers);
//         $customer_id = $customer['customer_id'];
//         echo $customer_id;
        
//         // echo '\n';
//     }
// }




