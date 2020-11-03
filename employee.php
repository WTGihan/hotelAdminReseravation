<?php 
    
    require 'inc/public/connection.php';
    session_start();
    //Checking if a user is logged in
    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php");  //Then when your not logged in can't access users.php file
    }
    $user_list = '';
    $search = '';

    // echo 'success';
    // die();

    // Search User
    if(isset($_GET['search'])) {
        $search = mysqli_real_escape_string($connection, $_GET['search']);
    
        $query = "SELECT * FROM employee WHERE 
                (first_name LIKE '%{$search}%' OR last_name LIKE '%{$search}%' OR email LIKE '%{$search}%')
                AND is_deleted=0 ORDER BY first_name";
        // echo 'success';
        // die();        
            
    }
    // Not Search User
    else {
        // Getting the list of users
        $query = "SELECT * FROM  employee WHERE is_deleted=0 ORDER BY emp_id";
        // echo 'success1';
        // die();
    }
    


    


    
    $users = mysqli_query($connection, $query);

    //verify_query($users);  //This function also check query is correct and also inlcude this folder to top require 'inc/function.inc.php'
    if($users) {
        while($user = mysqli_fetch_assoc($users)) {
            $user_list .= "<tbody>";
            $user_list .= "<td>{$user['emp_id']}</td>";
            $user_list .= "<td>{$user['first_name']}</td>";
            $user_list .= "<td>{$user['last_name']}</td>";
            $user_list .= "<td>{$user['email']}</td>";
            $user_list .= "<td>{$user['salary']}</td>";
            $user_list .= "<td>{$user['location']}</td>";
            $user_list .= "<td>{$user['contact_num']}</td>";
            $user_list .= "<td><a href=\"modify-employee.php?emp_id={$user['emp_id']}\" class=\"edit\"><i class=\"material-icons\">edit</i>Edit</a></td>";
            $user_list .= "<td><a href=\"inc/delete-employee.inc.php?emp_id={$user['emp_id']}\" onclick=\"return confirm('Are you sure?');\" class=\"delete\"><i class=\"material-icons\">delete</i>Delete</a></td>";
            $user_list .= "<tr>";
        }
    }
    else {
        echo "Database query failed"; 
    }
?>


<!-- Webpage Start -->

<?php
    
    $title = "Employee Page";
    require('public/header.php'); 
    
?>


<div class="wrapper">

    
    <?php 
            require('public/sidebar.php');    //Sidebar
            $navbar_title = "Index Page";
            $search = 1;
            $page = 'employee.php';
            $search_by = "First Name";
            require('public/navbar.php');     //Navbar
    ?>


    <!-- Table design -->
    <div class="content">
        <div class="tablecard">
            <div class="card">
                <div class="cardheader">
                    <div class="options">
                        <h4>Emloyee Table 
                        <span>
                            <a href="add-new.php" class="addnew"><i class="material-icons">add</i>Add New</a> 
                            <a href="employee.php" class="refresh"><i class="material-icons">refresh</i>Refresh</a> 
                        </span>
                    </h4>  
                        
                    </div>
                    <p class="textfortabel">Employee View Following Table</p>
                </div>

                <div class="cardbody">
                    <div class="tablebody">
                        <table>
                            <thead>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Salary</th>
                                <th>Location</th>
                                <th>Contact Number</th>
                                <th>Edit</th>
                                <th>Delete</th>  
                            </thead>

                            <?php echo $user_list; ?>
                        </table>
                    </div>
                </div>  <!--End Card Body -->
            </div>

            
        </div>
    </div>  <!--End Table design -->

    
</div>
    
<?php require('public/footer.php'); ?>


