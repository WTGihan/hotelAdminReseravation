
<?php
    session_start();
    $title = "Index Page";
    require('public/header.php'); 
    
?>




    <div class="wrapper">

        <!-- Sidebar Design -->
        <?php 
            
            require('public/sidebar.php');
        ?>

        <!-- Navbar -->
        <?php 
            $navbar_title = "Index Page";
            $search = 0;
            require('public/navbar.php');
        ?>
        
        <!-- Table design -->
        <div class="content">
            <div class="tablecard">
                <div class="card">
                    <div class="cardheader">
                        <div class="options">
                            <h4>Index Page
                            <!-- <span>
                                <a href="employee.php" class="addnew"><i class="material-icons">arrow_back</i>Back To Employee Table</a>  
                            </span> -->
                        </h4>  
                            
                        </div>
                        <p class="textfortabel">See What is Complete</p>
                    </div>
                    <div class="cardbody">
                         <h4>1.Employee Page #Done</h4>
                         <h4>2.Add New Employee Page #Done</h4>
                         <h4>3.Modify Employee Page #Done</h4>
                         <h4>4.Room Page #Done</h4>
                         <h4>5.Room View Page #Done</h4>
                         <h4>6.Room Refresh #Done</h4>
                         <h4>7.Basic Reservation Page #Done But Payment Details Validation NOT DONE</h4>

                    </div>
                </div>

                
            </div>
        </div>
    </div>
    
<?php require('public/footer.php'); ?>



