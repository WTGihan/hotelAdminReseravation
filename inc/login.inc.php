<?php 

session_start();
// Check for form submission
if(isset($_POST['submit'])) {
    echo 'Level 10';
    require 'public/connection.php';
    $errors = array();
    // Check if the username and password has been entered
    if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
        echo 'Level 1';
        $errors[] = 'Username is Missing / Invalid';
        header("Location: ../index.php?error=$errors");
        exit();
        
    }

    if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
        echo 'Level 2';
        $errors[] = 'Password is Missing / Invalid';
        header("Location: ../index.php?error=$errors");
        exit();
        
    }

    // Check if there are any errors in the form
    if(empty($errors)) {
        // Save username and password into variables
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $hashed_password = sha1($password);

        // Prepare database query
        $query = "SELECT * FROM owner 
                  WHERE email = '{$email}'
                  AND password = '{$hashed_password}'
                  LIMIT 1";
        // This method use for fix SQL Errors in Project
        // echo $query;
        // die();

        $result_set = mysqli_query($connection, $query);
        echo 'Level 3';

        if($result_set) {
            // Query successfull

            if(mysqli_num_rows($result_set) == 1) {
                echo 'Level 4';
                // Valid user found
                $user = mysqli_fetch_assoc($result_set);
                $_SESSION['user_id'] = $user['owner_user_id'];
                $_SESSION['username'] = $user['username'];
                // $name = $_SESSION['first_name'];

                // Redirect to user.php
                header("Location: ../index.php");
                
                exit();
                
            }
            else{
                //Then checking if reception give the password and email
                $query = "SELECT * FROM reception 
                  WHERE email = '{$email}'
                  AND password = '{$hashed_password}'
                  LIMIT 1";

                $result_set = mysqli_query($connection, $query);
                echo 'Level 3';

                if($result_set) {
                    // Query successfull

                    if(mysqli_num_rows($result_set) == 1) {
                        echo 'Level 4';
                        // Valid user found
                        $user = mysqli_fetch_assoc($result_set);
                        $_SESSION['user_id'] = $user['reception_user_id'];
                        $_SESSION['username'] = $user['username'];
                        // $name = $_SESSION['first_name'];

                        // Redirect to user.php
                        header("Location: ../index.php");
                        
                        exit();
                    }  
                }
                else {
                echo 'Level 5';
                // Username and password invalid
                $errors[] = 'Invalid Username / Password';
                // header("Location: ../index.php?error=invalid");
                header("Location: ../index.php?error=$errors");
               
                exit();

                }
                
            }
        }
        else {
            echo 'Level 6';
            $errors[] = 'Database query failed';
            header("Location: ../index.php?error=$errors");
            
            exit();
            
        }

        
    }


  


}




