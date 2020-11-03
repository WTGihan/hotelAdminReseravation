<?php 
    
    require 'inc/public/connection.php';
    session_start();
    //Checking if a user is logged in
    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php");  
    }

    $user_id = '';
    if(isset($_GET['emp_id'])) {
        //getting the user information
        
        $emp_id = mysqli_real_escape_string($connection, $_GET['emp_id']);
        $query = "SELECT * FROM employee WHERE emp_id = {$emp_id} LIMIT 1";
    
        $result_set = mysqli_query($connection, $query);
    
        if($result_set) {
            // Check num of rows
            if(mysqli_num_rows($result_set) == 1) {
                // user found
                $result = mysqli_fetch_assoc($result_set);
                $owner_user_id = $result['owner_user_id'];
                $first_name = $result['first_name'];
                $last_name = $result['last_name'];;
                $email = $result['email'];  
                $salary = $result['salary']; 
                $location = $result['location'];   
                $contact_num = $result['contact_num']; 
            }
            else {
                // user not found
                header("Location: employee.php?err=user_not_found");
                exit();
            }
        }
        else {
            // Query unsuccessful
            header("Location: employee.php?err=query_failed");
            exit();
        }
    }

?>






<!-- Webpage Start -->

<?php
    
    $title = "Edit Employee Page";
    require('public/header.php'); 
    
?>




<div class="wrapper">

    <?php 
            require('public/sidebar.php');    //Sidebar
            $navbar_title = "Edit Employee Page";
            $search = 0;
            require('public/navbar.php');     //Navbar
    ?>
    
    <!-- Table design -->
    <div class="content">
        <div class="tablecard">
            <div class="card">

                <div class="cardheader">
                    <div class="options">
                        <h4>Add New Employee 
                        <span>
                            <a href="employee.php" class="addnew"><i class="material-icons">arrow_back</i>Back To Employee Table</a>  
                        </span>
                    </h4>  
                        
                    </div>
                    <p class="textfortabel">Complete Following Details</p>
                </div>

                <div class="cardbody">

                    <form action="inc/modify-employee.inc.php" class="addnewform" method="post">
                        <?php 
                        require 'inc/public/function.inc.php';
        
                        $errors = $_GET;
                        if(!isset($_GET["emp_id"])) {
                            if(!empty($errors)) {
                                display_error($errors);
                            }
                        }
                        else {
                            $user_id = $_GET["emp_id"];
                            if(!empty($errors)) {
                                $arr=array_diff($errors,[$user_id]);
                                $len = sizeof($arr);
                                if($len != 0){
                                    display_error($arr);
                                }
                            }
                        }
                        
                        ?>

                        <input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>">


                        <div class="row">
                            <label for="#"><i class="material-icons">perm_identity</i>Owner ID:</label>
                            <input type="text" name="owner_user_id"
                            <?php 
                                if(isset($_GET['owner_user_id'])) {
                                    echo 'value="' . $_GET['owner_user_id'] . '"';
                                } 
                                else {
                                    echo 'value='.$owner_user_id;
                                }
                            ?>
                            >
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">account_box</i>First Name:</label>
                            <input type="text" name="first_name"
                            <?php 
                                if(isset($_GET['first_name'])) {
                                    echo 'value="' . $_GET['first_name'] . '"';
                                } 
                                else {
                                    echo 'value='.$first_name;
                                }
                            ?>
                            >
                        </div>
                        
                        <div class="row">
                            <label for="#"><i class="material-icons">account_box</i>Last Name:</label>
                            <input type="text" name="last_name"
                            <?php 
                                if(isset($_GET['last_name'])) {
                                    echo 'value="' . $_GET['last_name'] . '"';
                                } 
                                else {
                                    echo 'value='.$last_name;
                                }
                            ?>
                            >
                        </div>
                        <div class="row">
                            <label for="#"><i class="material-icons">mail</i>Email Address:</label>
                            <input type="email" name="email"
                            <?php 
                                if(isset($_GET['email'])) {
                                    echo 'value="' . $_GET['email'] . '"';
                                } 
                                else {
                                    echo 'value='.$email;
                                }
                            
                            ?>
                            >
                        </div>
                        
                        <div class="row">
                            <label for="#"><i class="material-icons">payment</i>Salary:</label>
                            <input type="text" name="salary"
                            <?php 
                                if(isset($_GET['salary'])) {
                                    echo 'value="' . $_GET['salary'] . '"';
                                } 
                                else {
                                    echo 'value='.$salary;
                                }
                            
                            ?>
                            >
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">location_on</i>Location:</label>
                            <input type="text" name="location"
                            <?php 
                                if(isset($_GET['location'])) {
                                    echo 'value="' . $_GET['location'] . '"';
                                } 
                                else {
                                    echo 'value='.$location;
                                }
                            
                            ?>
                            >
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">location_on</i>Contact Number:</label>
                            <input type="text" name="contact_num"
                            <?php 
                                if(isset($_GET['contact_num'])) {
                                    echo 'value="' . $_GET['contact_num'] . '"';
                                } 
                                else {
                                    echo 'value='.$contact_num;
                                }
                            
                            ?>
                            >
                        </div>
                        
                        <div class="row">
                            <div class="button">
                                <button class="save" name="submit">Save</button>
                            </div>
                        </div>

                    </form>
                </div> <!--End Card Body -->
            </div>

            
        </div>
    </div>  <!--End Table design -->
</div>
    
<?php require('public/footer.php'); ?>



