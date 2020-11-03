<?php 
    require 'inc/public/connection.php';
    session_start();
    //Checking if a user is logged in
    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php"); 
    }
?>





<!-- Webpage Start -->

<?php
    
    $title = "Add New Page";
    require('public/header.php'); 
 ?> 




<div class="wrapper">

    <?php 
            require('public/sidebar.php');    //Sidebar
            $navbar_title = "Index Page";
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
                    <form action="inc/add-new.inc.php" method="post" class="addnewform">

                        <?php 
        
                        require 'inc/public/function.inc.php';
                        $errors = $_GET;
                        if(!empty($errors)) {
                            display_error1($errors,7);
                        }
                        
                        ?>
                        
                        <div class="row">
                        <label for="#"><i class="material-icons">perm_identity</i>Owner ID:</label>
                        <input type="text" name="owner_user_id"
                        <?php 
                            if(isset($_GET['owner_user_id'])) {
                                echo 'value="' . $_GET['owner_user_id'] . '"';
                            } 
                            else {
                                echo 'placeholder="###"';
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
                                echo 'placeholder="Tharindu"';
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
                                echo 'placeholder="Gihan"';
                            }
                            
                            ?>
                            >
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">mail</i>Email Address:</label>
                            <input type="text" name="email"
                            <?php 
                            
                            if(isset($_GET['email'])) {
                                echo 'value="' . $_GET['email'] . '"';
                            } 
                            else {
                                echo 'placeholder="gihan@gmail.com"';
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
                                echo 'placeholder="000000"';
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
                                echo 'placeholder="57/A Galle Road"';
                            }
                            
                            ?>
                            > 
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">contacts</i>Contact Number:</label>
                            <input type="text" name="contact_num"
                            <?php 
                            
                            if(isset($_GET['contact_num'])) {
                                echo 'value="' . $_GET['contact_num'] . '"';
                            } 
                            else {
                                echo 'placeholder="0777456123"';
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
                </div>  <!--End Card Body -->
            </div>  <!--End Card -->

            
        </div>
    </div>   <!-- End Table design -->
    
</div>
    
<?php require('public/footer.php'); ?>



