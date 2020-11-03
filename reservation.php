<?php 
  require 'inc/public/connection.php';
  session_start();
  //Checking if a user is logged in
  if(!isset($_SESSION['user_id'])) {
      header("Location: index.php");  //Then when your not logged in can't access users.php file
  }


?>


<!-- Webpage Start -->

<?php
    
    $title = "Reservation Page";
    require('public/header.php'); 
    
?>

<div class="wrapper">

    <?php 
            require('public/sidebar.php');    //Sidebar
            $navbar_title = "Reservation ";
            $search = 0;
            require('public/navbar.php');     //Navbar
    ?>


    <div class="content">
        <div class="tablecard">
            <div class="card">

                <div class="cardheader">
                    <div class="options">
                        <h4>Make Reservation</h4>  
                    </div>

                    <p class="textfortabel">Complete Following Details</p>
                </div>

                <div class="cardbody">  
                    <form action="inc/reservation.inc.php" method="post" class="addnewform">

                        <?php 
        
                        require 'inc/public/function.inc.php';
                        ///correct this when room.php redirect to reservation
                        $errors = $_GET;
                        $len = count($errors);
                        // echo $len;
                        // die();
                        if($len > 1) {
                            if(!empty($errors)) {
                                display_error1($errors,16);
                            }
                        }
                        ?>

                        <div class="details">
                        <div class="customer-details">
                            
                        <!-- Customer Part -->
                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="first_name"
                                <?php 

                                if(isset($_GET['first_name'])) {
                                    echo 'value="' . $_GET['first_name'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">account_box</i>First Name</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="last_name"
                                <?php 

                                if(isset($_GET['last_name'])) {
                                    echo 'value="' . $_GET['last_name'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">account_box</i>Last Name</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="location"
                                <?php 

                                if(isset($_GET['location'])) {
                                    echo 'value="' . $_GET['location'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">location_on</i>Location</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="contact_num"
                                <?php 

                                if(isset($_GET['contact_num'])) {
                                    echo 'value="' . $_GET['contact_num'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">contacts</i>Contact Number</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="date_of_birth"
                                <?php 

                                if(isset($_GET['date_of_birth'])) {
                                    echo 'value="' . $_GET['date_of_birth'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">account_box</i>Date of Birth</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="age"
                                <?php 

                                if(isset($_GET['age'])) {
                                    echo 'value="' . $_GET['age'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">account_box</i>Age</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="email"
                                <?php 

                                if(isset($_GET['email'])) {
                                    echo 'value="' . $_GET['email'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">mail</i>Email Address</span>
                                </label>
                            </div>

                           <!-- End of Customer Details Part  -->
                            
                            <!-- Reservation Details -->
                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="no_of_guest"
                                <?php 

                                if(isset($_GET['no_of_guest'])) {
                                    echo 'value="' . $_GET['no_of_guest'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">group_add</i>No:of Guest</span>
                                </label>
                            </div>
                        </div>

                        <div class="payment-details">
                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="room_id"
                                <?php 

                                if(isset($_GET['room_id'])) {
                                    echo 'value="' . $_GET['room_id'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">account_box</i>Room ID</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="check_in_date"
                                <?php 

                                if(isset($_GET['check_in_date'])) {
                                    echo 'value="' . $_GET['check_in_date'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">today</i>Check-In Day</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="check_out_date"
                                <?php 

                                if(isset($_GET['check_out_date'])) {
                                    echo 'value="' . $_GET['check_out_date'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">today</i>Check-Out Day</span>
                                </label>
                            </div>
                        <!-- End of Reservation Details -->


                        <!-- Payment Details -->
                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="name_of_card"
                                <?php 

                                if(isset($_GET['name_of_card'])) {
                                    echo 'value="' . $_GET['name_of_card'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">credit_card</i>Name of Card</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="credit_card_number"
                                <?php 

                                if(isset($_GET['credit_card_number'])) {
                                    echo 'value="' . $_GET['credit_card_number'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">card_membership</i>Credite Card Number</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="expire_month"
                                <?php 

                                if(isset($_GET['expire_month'])) {
                                    echo 'value="' . $_GET['expire_month'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">date_range</i>Expire Month</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="expire_year"
                                <?php 

                                if(isset($_GET['expire_year'])) {
                                    echo 'value="' . $_GET['expire_year'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">date_range</i>Expire Year</span>
                                </label>
                            </div>

                            <div class="animate-form">
                                <input type="text"  autocomplete="off" name="cvv"
                                <?php 

                                if(isset($_GET['cvv'])) {
                                    echo 'value="' . $_GET['cvv'] . '"';
                                } 
                                
                                ?>
                                
                                required
                                >
                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">receipt</i>CVV</span>
                                </label>
                            </div>
    

                        
                            
                        </div>

                        </div>

                        <div class="row">
                            <div class="button">
                                <button class="save" name="submit">Booked</button>
                            </div>
                        </div>
                    </form>
                </div>  <!--End Card Body -->
            </div>  <!--End Card -->

            
        </div>
    </div>   <!-- End Table design -->


    
</div>

<?php require('public/footer.php'); ?>








