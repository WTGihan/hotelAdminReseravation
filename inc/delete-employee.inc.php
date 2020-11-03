<?php 

require 'public/connection.php';
require 'public/function.inc.php';



if(isset($_GET['emp_id'])) {

    //getting the user information
    $emp_id = mysqli_real_escape_string($connection, $_GET['emp_id']);

    
        // Delete the user 
        // Update is_deleted coloumn 0 to 1
        $query = "UPDATE employee SET is_deleted =1 WHERE emp_id = {$emp_id} LIMIT 1";

        $result = mysqli_query($connection, $query);
        
        if($result) {
            // user deleted
            header("Location: ../employee.php ?user_delete=success");
            exit();
        }
        else {
            header("Location: ./employee.php?err=delete_failed");
            exit();
        }
    }

else {
    header("Location: ../employee/employee.php");
    exit();
}



    

