<?php 

session_start();
require ('public/connection.php');
require ('public/function.inc.php');


//Checking if a user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); 
}

$errors = array();


$first_name = '';
$last_name = '';
$location = '';
$contact_num = '';
$date_of_birth = '';
$age = '';
$email = '';

$no_of_guest = '';
$room_id = '';
$check_in_date = '';
$check_out_date = '';

$name_of_card = '';
$credit_card_number = '';
$expire_month = '';
$expire_year = '';
$cvv = '';





if(isset($_POST['submit'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $location = $_POST['location'];
    $contact_num = $_POST['contact_num'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $no_of_guest = $_POST['no_of_guest'];
    $room_id = $_POST['room_id'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];

    $name_of_card = $_POST['name_of_card'];
    $credit_card_number = $_POST['credit_card_number'];
    $expire_month = $_POST['expire_month'];
    $expire_year = $_POST['expire_year'];
    $cvv = $_POST['cvv'];
    
    
    
    
    // Form Validation and Checking empty input fields
    
    $req_fields = array('first_name', 'last_name', 'location', 'contact_num', 'date_of_birth', 'age', 'email', 'no_of_guest', 'room_id', 'check_in_date', 'check_out_date', 'name_of_card', 'credit_card_number', 'expire_month', 'expire_year', 'cvv');

    $errors = array_merge($errors, check_req_fields($req_fields));
    

    // Checking max length

    $max_len_fields = array('first_name' => 50, 'last_name' => 100, 'location' => 50, 'contact_num' => 10, 'date_of_birth' => 10, 'age' => 3, 'email' => 50, 'no_of_guest' => 2, 'room_id' => 3, 'check_in_date' => 10, 'check_out_date' => 10, 'name_of_card' => 20, 'credit_card_number' => 19, 'expire_month' => 3, 'expire_year' => 4, 'cvv' => 3 );

    $errors = array_merge($errors, check_max_len($max_len_fields));




    // Checking email address

    if(!is_email($_POST['email'])) {
        $errors[] = 'Email address is Invalid';
    }

    //Check-In Date and Check-Out Date Validation
    $current_date = date("Y-m-d");
    $time1 = strtotime($check_in_date);
    $time2 = strtotime($check_out_date);
    $check_in_date = date('Y-m-d',$time1);
    $check_out_date = date('Y-m-d',$time2);

    if($current_date > $check_in_date || $check_in_date >= $check_out_date) {
        echo "Date is Not Valid";
        echo "<br>";
        $errors[] = 'Check-In and Check-Date is not_valid';
    }
    // echo "Date is Valid";
    // echo "<br>";


    // Checking Payment Details is Valid?

       //Have to Code

    
     //Room_checking(Valid or NOT)
     $room_id = mysqli_real_escape_string($connection, $_POST['room_id']);

     $query1 = "SELECT * FROM reservation WHERE room_id= '{$room_id}'  LIMIT 1";
     
     $result_set1= mysqli_query($connection, $query1);
 
     if($result_set1) { //Check Query Successful
         if(mysqli_num_rows($result_set1) == 1) {
            $reservations = mysqli_fetch_assoc($result_set1);
            $reservations_valid = $reservations['is_valid'];
            if($reservations_valid == 1) {
                $errors[] = 'Room already reserved Sorry';
            }
             
         }
     }

     
    if(!empty($errors)) {
        //pass the arrray through php file to another php file using .http_build_query($errors)
        header("Location: ../reservation.php?" . http_build_query($errors) . "&first_name=" . $first_name. "&last_name=" . $last_name."&location=" . $location. "&contact_num=" . $contact_num. "&date_of_birth=" . $date_of_birth. "&age=" . $age. "&email=" . $email. "&no_of_guest=" . $no_of_guest. "&room_id=" . $room_id. "&check_in_date=" . $check_in_date. "&check_out_date=" . $check_out_date. "&name_of_card=" . $name_of_card. "&credit_card_number=" . $credit_card_number. "&expire_month=" . $expire_month. "&expire_year=" . $expire_year. "&cvv=" . $cvv); 
        exit();
        //var_dump($errors);
    }
    // End of Form Validation

    else {
        echo 'No Errors';
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']); 
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $location = mysqli_real_escape_string($connection, $_POST['location']);
        $contact_num = mysqli_real_escape_string($connection, $_POST['contact_num']);
        $date_of_birth = mysqli_real_escape_string($connection, $_POST['date_of_birth']);
        $age = mysqli_real_escape_string($connection, $_POST['age']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);

        $no_of_guest = mysqli_real_escape_string($connection, $_POST['no_of_guest']);
        // $room_id = mysqli_real_escape_string($connection, $_POST['room_id']);    already done this
        $check_in_date = mysqli_real_escape_string($connection, $_POST['check_in_date']);
        $check_out_date = mysqli_real_escape_string($connection, $_POST['check_out_date']);

        $name_of_card = mysqli_real_escape_string($connection, $_POST['name_of_card']);
        $credit_card_number = mysqli_real_escape_string($connection, $_POST['credit_card_number']);
        $expire_month = mysqli_real_escape_string($connection, $_POST['expire_month']);
        $expire_year = mysqli_real_escape_string($connection, $_POST['expire_year']);
        $cvv = mysqli_real_escape_string($connection, $_POST['cvv']);

        echo $first_name.":".$last_name.":".$location.":".$contact_num.":".$date_of_birth.":".$age.":".$email;
        echo "<br>";
        echo $no_of_guest.":".$room_id.":".$check_in_date.":".$check_out_date;
        echo "<br>";
        echo $name_of_card.":".$credit_card_number.":".$expire_month.":".$expire_year.":".$cvv;
        echo "<br>";
        $customer_value = 0;
        //Check Customer already used customer

        

        $query2 = "SELECT * FROM customer WHERE email= '{$email}'  LIMIT 1";
        
        $result_set2= mysqli_query($connection, $query2);
        // echo "1\n";
        
        if($result_set2) { //Check Query Successful
            if(mysqli_num_rows($result_set2) == 1) {
                $customer_value = 1;
                // echo "2\n";
            }
        }
        echo $customer_value;
        echo "<br>";
        
        
        //Check Payment already Stored
        $payment_value = 0;
        $query3 = "SELECT * FROM payment WHERE credit_card_number= '{$credit_card_number}'  LIMIT 1";
        
        $result_set3= mysqli_query($connection, $query3);
        //echo "3\n";

        if($result_set3) { //Check Query Successful
            if(mysqli_num_rows($result_set3) == 1) {
                $payment_value = 1;
                //echo "4\n";
            }
        }

        echo $payment_value;
        echo "<br>";

        if($customer_value == 0) {
            echo "Active add customer";
            echo "<br>";
            //$email = mysqli_real_escape_string($connection, $_POST['email']);

            $age = (int)$age;

            $query = "INSERT INTO customer (";
            $query .= "first_name, last_name, location, contact_number, date_of_birth, age, email";
            $query .= ") VALUES (";
            $query .= "'{$first_name}', '{$last_name}', '{$location}', '{$contact_num}', '{$date_of_birth}', '{$age}', '{$email}'";
            $query .= ")";

            $result1 = mysqli_query($connection, $query);
            //echo "5\n";
            

            if($result1 == 0) {
                $errors[] = 'Failed to add the new Customer record';
                echo "6\n";
                header("Location: ../reservation.php?" . http_build_query($errors) . "&first_name=" . $first_name. "&last_name=" . $last_name."&location=" . $location. "&contact_num=" . $contact_num. "&date_of_birth=" . $date_of_birth. "&age=" . $age. "&email=" . $email. "&no_of_guest=" . $no_of_guest. "&room_id=" . $room_id. "&check_in_date=" . $check_in_date. "&check_out_date=" . $check_out_date. "&name_of_card=" . $name_of_card. "&credit_card_number=" . $credit_card_number. "&expire_month=" . $expire_month. "&expire_year=" . $expire_year. "&cvv=" . $cvv); 
                exit();
                echo "Active add customer";
                echo "<br>";

            }
            echo "Active add customer Success";
            echo "<br>";


        }     //Customer already user or not check Complete



        //Insert Reservation Details

        echo "Active make RESERVATION";
        echo "<br>";
        
        //echo "9\n";
        //$customer_id
        $query4 = "SELECT * FROM customer WHERE email= '{$email}'  LIMIT 1";
        $customers = mysqli_query($connection, $query4);
        // echo 'customer1';
        // echo $customers;
        if($customers) {
            if(mysqli_num_rows($customers) == 1) {
                echo "10<br>";
                $customer = mysqli_fetch_assoc($customers);
                $customer_id = $customer['customer_id'];
                echo $customer_id;
                echo "Customer id found";
                echo "<br>";
                
                // echo '\n';
            }
        }
        // Date Strings convert to Date data types 
        $time1 = strtotime($check_in_date);
        $time2 = strtotime($check_out_date);
        $check_in_date = date('Y-m-d',$time1);
        $check_out_date = date('Y-m-d',$time2);
        $reception_user_id = $_SESSION['user_id'];
        $customer_id = (int)$customer_id;
        $reception_user_id = (int)$reception_user_id;
        $room_id = (int)$room_id;
        $no_of_guest = (int)$no_of_guest;

        echo $check_in_date.":".$check_out_date.":".$reception_user_id.":".$customer_id.":".$room_id.":".$no_of_guest;
        echo "<br>";

        // echo '9\r\n';

        $query = "INSERT INTO reservation (";
        $query .= "customer_id, reception_user_id, room_id, check_in_date, check_out_date, no_of_guest, is_valid";
        $query .= ") VALUES (";
        $query .= "{$customer_id}, {$reception_user_id}, {$room_id}, '{$check_in_date}', '{$check_out_date}', '{$no_of_guest}', 1";
        $query .= ")";
        // echo '10\r\n';
        
        $result = mysqli_query($connection, $query);
        
        
        
        //Room_id how to update is_boooked in the hotel_management_system

        if($result) {
            // Date Strings convert to Date data types 
            echo "Make a Reservation Success:room:";
            echo $room_id;
            echo "<br>";
            //Room tabel should update
            $is_booked = 1;
            $query1 = "UPDATE room SET ";
            $query1 .= "is_booked = '{$is_booked}' ";
            $query1 .= "WHERE room_id = '{$room_id}' LIMIT 1";

            $Finalresult = mysqli_query($connection, $query1);

            if($Finalresult == 0) {
                $errors[] = 'Failed to update Room';
                header("Location: ../reservation.php?" . http_build_query($errors) . "&first_name=" . $first_name. "&last_name=" . $last_name."&location=" . $location. "&contact_num=" . $contact_num. "&date_of_birth=" . $date_of_birth. "&age=" . $age. "&email=" . $email. "&no_of_guest=" . $no_of_guest. "&room_id=" . $room_id. "&check_in_date=" . $check_in_date. "&check_out_date=" . $check_out_date. "&name_of_card=" . $name_of_card. "&credit_card_number=" . $credit_card_number. "&expire_month=" . $expire_month. "&expire_year=" . $expire_year. "&cvv=" . $cvv); 
                exit();
                echo "Room Update is Unsuccess";
                echo "<br>";
            }
            echo "Room Update is Success";
            echo "<br>";
        }
        else {
            // echo '14\r\n';
            $errors[] = 'Failed to reserve Room';
            header("Location: ../reservation.php?" . http_build_query($errors) . "&first_name=" . $first_name. "&last_name=" . $last_name."&location=" . $location. "&contact_num=" . $contact_num. "&date_of_birth=" . $date_of_birth. "&age=" . $age. "&email=" . $email. "&no_of_guest=" . $no_of_guest. "&room_id=" . $room_id. "&check_in_date=" . $check_in_date. "&check_out_date=" . $check_out_date. "&name_of_card=" . $name_of_card. "&credit_card_number=" . $credit_card_number. "&expire_month=" . $expire_month. "&expire_year=" . $expire_year. "&cvv=" . $cvv); 
            exit();
        }
        // echo '15\r\n';
        //die();
          

        // //Insert Payment Details
        if($payment_value == 0) {
            

            //$reservation_id
            $query5 = "SELECT * FROM reservation WHERE room_id= '{$room_id}'  LIMIT 1";
            $reservations = mysqli_query($connection, $query5);
            
            if($reservations) {
                $reservation = mysqli_fetch_assoc($reservations);
                $reservation_id = $reservation['reservation_id'];
                echo "reservation id found";
                echo "<br>";
            }

            echo $reservation_id.":".$customer_id.":".$name_of_card.":".$expire_month.":".$expire_year.":".$cvv;
            $query = "INSERT INTO payment (";
            $query .= "reservation_id, customer_id, name_of_card, credit_card_number, expire_month, expire_year, cvv";
            $query .= ") VALUES (";
            $query .= "'{$reservation_id}', '{$customer_id}', '{$name_of_card}', '{$credit_card_number}', '{$expire_month}', '{$expire_year}', '{$cvv}'";
            $query .= ")";

            $result = mysqli_query($connection, $query);

            if($result == 0) {
                $errors[] = 'Failed to add the new Payment record';
                header("Location: ../reservation.php?" . http_build_query($errors) . "&first_name=" . $first_name. "&last_name=" . $last_name."&location=" . $location. "&contact_num=" . $contact_num. "&date_of_birth=" . $date_of_birth. "&age=" . $age. "&email=" . $email. "&no_of_guest=" . $no_of_guest. "&room_id=" . $room_id. "&check_in_date=" . $check_in_date. "&check_out_date=" . $check_out_date. "&name_of_card=" . $name_of_card. "&credit_card_number=" . $credit_card_number. "&expire_month=" . $expire_month. "&expire_year=" . $expire_year. "&cvv=" . $cvv); 
                exit();
                echo "Payment Details Add Unsuccessfully";
                echo "<br>";
            }
            else {
                echo "Payment Details Add Successfully";
                echo "<br>";
            }
        }
        
        if($Finalresult) {
            // query successful.. redirecting to users page
            header("Location: ../reservation.php?reservation_process=success"); 
            exit();
            echo "Reservation Process Done Successfully";
            echo "<br>";
            
        }
        
        

    }
}

