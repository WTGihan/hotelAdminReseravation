<?php 
    
    require 'inc/public/connection.php';
    session_start();
    //Checking if a user is logged in
    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php");  //Then when your not logged in can't access users.php file
    }

    $room_list = '';
    $search = '';

    if(isset($_GET['search'])) {
        $search = mysqli_real_escape_string($connection, $_GET['search']);
    
        $query = "SELECT * FROM room WHERE 
                (room_number LIKE '%{$search}%')
                AND is_booked=0 ORDER BY room_id";
        // echo 'success';
        // die();        
            
    }

    // Not Search User
    else {
        // Getting the list of users
        $query = "SELECT * FROM  room WHERE is_booked=0 ORDER BY room_id";
        // echo 'success1';
        // die();
    }

    
    //Getting the list of users
    


    
    $rooms= mysqli_query($connection, $query);

    //verify_query($rooms);  //This function also check query is correct and also inlcude this folder to top require 'inc/function.inc.php'
    if($rooms) {
        while($room = mysqli_fetch_assoc($rooms)) {
            $room_list .= "<tbody>";
            $room_list .= "<td>{$room['room_id']}</td>";
            $room_list .= "<td>{$room['room_type_id']}</td>";
            $room_list .= "<td>{$room['room_number']}</td>";
            $room_list .= "<td><a href=\"room-view.php?room_type_id={$room['room_type_id']}&room_id={$room['room_id']}\" class=\"edit\"><i class=\"material-icons\">zoom_in</i>Details</a></td>";
            $room_list .= "<td><a href=\"reservation.php?room_id={$room['room_id']}\" onclick=\"return confirm('Are you sure?');\" class=\"edit\"><i class=\"material-icons\">book_online</i>Reservation</a></td>";
            $room_list .= "<tr>";
        }
    }
    else {
        echo "Database query failed"; 
    }
?>



<!-- Webpage Start -->

<?php
    
    $title = "Room Page";
    require('public/header.php'); 
    
?>


<div class="wrapper">

    <?php 
            require('public/sidebar.php');    //Sidebar
            $navbar_title = "Index Page";
            $search = 1;
            $page = 'room.php';
            $search_by = "Room Number";
            require('public/navbar.php');     //Navbar
    ?>

    <!-- Table design -->
    <div class="content">
        <div class="tablecard">
            <div class="card">
                <div class="cardheader">
                    <div class="options">
                        <h4>Room Table 
                        <span>
                            <!-- <a href="employee/add-new.php" class="addnew"><i class="material-icons">add</i>Add New</a>  -->
                            <a href="inc/room-refresh.inc.php" class="refresh"><i class="material-icons">refresh</i>Refresh</a> 
                        </span>
                    </h4>  
                        
                    </div>
                    <p class="textfortabel">Room View Following Table</p>
                </div>

                <div class="cardbody">
                    <div class="tablebody">
                        <table>
                            <thead>
                                <th>ID</th>
                                <th>Room Type ID</th>
                                <th>Room Number</th>
                                <th>Details</th>
                                <th>Make Reservation</th> 
                            </thead>

                            <?php 
                            
                            echo $room_list; ?>
                        </table>
                    </div>
                </div>  <!--End Card Body -->
            </div>

            
        </div>
    </div>  <!--End Table design -->

    
</div>
    
<?php require('public/footer.php'); ?>



