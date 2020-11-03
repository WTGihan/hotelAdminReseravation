<?php 

require 'public/connection.php';
require 'public/function.inc.php';

session_start();
    //Checking if a user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");  
}

$errors = array();

$owner_user_id = '';
$user_id = '';
$first_name = '';
$last_name = '';
$email = '';
$salary = '';
$Location = '';
$contact_num = '';



if(isset($_POST['submit'])) {
    $emp_id = $_POST['emp_id'];
    $owner_user_id = $_POST['owner_user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $location = $_POST['location'];
    $contact_num= $_POST['contact_num'];


    // Form Validation And Checking empty input fields

    $req_fields = array('emp_id', 'first_name', 'last_name', 'email', 'salary', 'location', 'contact_num');
    $errors = array_merge($errors, check_req_fields($req_fields));
    
    
    // Checking max length

    $max_len_fields = array('first_name' => 50, 'last_name' => 100, 'email' => 100, 'salary' => 10, 'location' => 100, 'contact_num' => 10);

    $errors = array_merge($errors, check_max_len($max_len_fields));



    // Checking email address

    if(!is_email($_POST['email'])) {
        $errors[] = 'Email address is Invalid';
    }

    // Checking if email address already exists
    
    // String sanitizer for SQL injection
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    // Given email address should be given user_id only
    $query = "SELECT * FROM employee WHERE email = '{$email}' AND id != {$emp_id} LIMIT 1";
    
    $result_set= mysqli_query($connection, $query);

    if($result_set) { //Check Query Successful
        if(mysqli_num_rows($result_set) == 1) {
            $errors[] = 'Email address already use another user';
        }
    }

    //Owner_user_id checking
    $owner_user_id = mysqli_real_escape_string($connection, $_POST['owner_user_id']);
    $query = "SELECT * FROM owner WHERE owner_user_id= '{$owner_user_id}'  LIMIT 1";
    
    $result_set= mysqli_query($connection, $query);

    if($result_set) { //Check Query Successful
        if(mysqli_num_rows($result_set) == 0) {
            $errors[] = 'Owner ID isn\'t valid';
        }
    }



    if(!empty($errors)) {
        //pass the arrray through php file to another php file using .http_build_query($errors)
        //echo 'Level 1';
        header("Location: ../modify-Employee.php?" . http_build_query($errors) . "&owner_user_id=" . $owner_user_id. "&emp_id=" . $emp_id . "&first_name=" . $first_name. "&last_name=" . $last_name. "&email=" . $email. "&salary=" . $salary. "&location=" . $location. "&contact_num=" . $contact_num); 
        exit();
    }
    // End of Form Validation

    else {
        // No errors found.. Adding new record         
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']); 
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $salary = mysqli_real_escape_string($connection, $_POST['salary']);
        $location = mysqli_real_escape_string($connection, $_POST['location']);
        $contact_num = mysqli_real_escape_string($connection, $_POST['contact_num']);
        // Email address is already sanitized


        $query = "UPDATE employee SET ";
        $query .= "owner_user_id = '{$owner_user_id}', ";
        $query .= "first_name = '{$first_name}', ";
        $query .= "last_name = '{$last_name}', ";
        $query .= "email = '{$email}', ";
        $query .= "salary = '{$salary}', ";
        $query .= "location = '{$location}', ";
        $query .= "contact_num = '{$contact_num}' ";
        $query .= "WHERE emp_id = {$emp_id} LIMIT 1";

        $result = mysqli_query($connection, $query);
        
        // die(); debugging

        if($result) {
            // query successful.. redirecting to users page
            header("Location: ../employee.php?user_modified=success");
            //echo 'Level 2';
            exit();
        }
        else {
            $errors[] = 'Failed to modify the record';
            header("Location: ../employee/modify-Employee.php?" . http_build_query($errors) . "&emp_id=" . $emp_id . "&first_name=" . $first_name. "&last_name=" . $last_name. "&email=" . $email. "&salary=" . $salary. "&location=" . $location. "&contact_num=" . $contact_num); 
            exit();
        }



    }
}

