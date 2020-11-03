<?php 
    
    require 'inc/public/connection.php';
    session_start();
    //Checking if a user is logged in
    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php");  //Then when your not logged in can't access users.php file
    }
    
    $user_id = '';
    if(isset($_GET['room_type_id']) && isset($_GET['room_id']) ) {
        //getting the user information
        $room_id = mysqli_real_escape_string($connection, $_GET['room_id']);
        $room_type_id = mysqli_real_escape_string($connection, $_GET['room_type_id']);
        $query1 = "SELECT * FROM room_discount WHERE room_type_id = {$room_type_id} LIMIT 1";
    
        $result_set1 = mysqli_query($connection, $query1);
        $current_date = date("Y-m-d");
        
        if($result_set1) {
            if(mysqli_num_rows($result_set1) == 1) {
                // user found
                $result1 = mysqli_fetch_assoc($result_set1);

                $start_date = $result1['start_date'];
                $end_date = $result1['end_date'];
                if($start_date < $current_date && $end_date > $current_date) {
                    $discount_rate = $result1['discount_rate'];
                    echo 'level 1';
                }
                else {
                    $discount_rate = 0;
                }
                

            }    
        }




        $query = "SELECT * FROM room_type WHERE room_type_id = {$room_type_id} LIMIT 1";
    
        $result_set = mysqli_query($connection, $query);
    
        if($result_set) {
            // Check num of rows
            if(mysqli_num_rows($result_set) == 1) {
                // user found
                $result = mysqli_fetch_assoc($result_set);
                $room_type_id = $result['room_type_id'];
                $floor_number = $result['floor_number'];
                $max_guest = $result['max_guest'];;
                $facilites = $result['facilites'];  
                $room_price = $result['room_price']; 
                $description = $result['description'];   
                $type_name = $result['type_name']; 
            }
            else {
                // user not found
                header("Location: room.php?err=room_not_found");
                exit();
            }
        }
        else {
            // Query unsuccessful
            header("Location: room.php?err=query_failed");
            exit();
        }
    }

?>





<!-- Webpage Start -->

<?php
    
    $title = "Room Details-View";
    require('public/header.php'); 
    
?>




<div class="wrapper">

    <?php 
            require('public/sidebar.php');    //Sidebar
            $navbar_title = "Room View Page";
            $search = 0;
            require('public/navbar.php');     //Navbar
    ?>
    
    <!-- Table design -->
    <div class="content">
        <div class="tablecard">
            <div class="card">

                <div class="cardheader">
                    <div class="options">
                        <h4>Room View 
                        <span>
                            <a href="room.php" class="addnew"><i class="material-icons">arrow_back</i>Back To Room Table</a>  
                        </span>
                    </h4>  
                        
                    </div>
                    <p class="textfortabel">Check Following Details</p>
                </div>

                <div class="cardbody">
                    
                    <form action="inc/room-booked.inc.php" class="addnewform" method='post'>
                        
                        
                        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">

                        <div class="row">
                            <label for="#"><i class="material-icons">perm_identity</i>Type ID:</label>
                            <?php
                            echo "<input type=\"text\" placeholder=\"".$room_type_id."\" disabled></input>";
                            ; ?>
                        </div>

                        <div class="row">
                            <label for="#" ><i class="material-icons">king_bed</i>Type Name:</label>
                            <?php
                            echo "<input type=\"text\" placeholder=\"".$type_name."\" disabled></input>";
                            ?>
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">flag</i>Floor Number:</label>
                            <?php
                            echo "<input type=\"text\" placeholder=\"".$floor_number."\" disabled></input>";
                            ; ?>
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">group_add</i>Max Guests:</label>
                            <?php
                            echo "<input type=\"text\" placeholder=\"".$max_guest."\" disabled></input>";
                            ; ?>
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">monetization_on</i>Room Price:</label>
                            <?php
                            echo "<input type=\"text\" placeholder=\"".$room_price."\" disabled></input>";
                            ; ?>
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">local_offer</i>Offer:</label>
                            <?php
                            echo "<input type=\"text\" placeholder=\"".$discount_rate."%\" disabled></input>";
                            ; ?>
                        </div>


                        <div class="row1">
                            <label for="#" class="more"><i class="material-icons">spa</i>Facilites:</label>
                            <?php
                            echo "<input type=\"textarea\" placeholder=\"".$facilites."\" disabled></input>";
                            ; ?>
                        </div>

                        <div class="row1">
                            <label for="#" class="more"><i class="material-icons">description</i>Description:</label>
                            <?php
                            echo "<input type=\"textarea\" placeholder=\"".$description."\" disabled></input>";
                            //height have to set
                            ; ?>
                        </div>

                        <div class="row">
                            <div class="button">
                                <button class="save" name="submit">Booking</button>
                            </div>
                        </div>

                    </form>
                </div> <!--End Card Body -->
            </div>

            
        </div>
    </div>  <!--End Table design -->
</div>
    
<?php require('public/footer.php'); ?>



