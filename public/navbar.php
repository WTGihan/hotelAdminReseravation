

<div class="navbar">
            <h2 class="nav-header"><?php echo $navbar_title; ?></h2>
            <!-- when in logout -->
            <?php 
            if(!isset($_SESSION['user_id'])) {
                echo '<div class="form">
                        <form action="inc/login.inc.php" class="nav-form" method="post">
                            <div class="navbar-input">
                                <input type="email" name="email" autocomplete="off" class="nav-mail" placeholder="Email Address" >
                            </div>
                            <div class="navbar-input">
                                <input type="password" name="password" autocomplete="off" class="nav-pass" placeholder="Password" >
                            </div>
                            <div class="navbar-button">
                                <button type="submit" class="nav-button" name="submit" >Log In</button>
                            </div> 
                        </form>
                      </div>';
            }
            else {
                if($search == 1) {
                    echo '<div class="navform">
                            <div class="form-search">
                                <form action="'.$page.'" class="nav-form1" method="get">  
                                    <input type="search"  class="nav-search" name="search" placeholder="Search By '.$search_by.'::">
                                    <i class="material-icons md-16">search</i>
                                </form>
                            </div>
                            <div class="form1">
                                <div class="form2">
                                <div class="label-login">
                                    <label for="#" class="label-welcome"><i class="material-icons md-18">account_circle</i>Hi '.$_SESSION['username'].'</label>
                                </div>
                                
                                <form action="inc/logout.inc.php" method="post">
                                    <div class="navbar-button">   
                                        <button type="submit" class="nav-button" name="submit">Log Out</button>  
                                    </div> 
                                </form> 
                            </div>
                            </div>
                        </div>';
                }
                else {
                    echo '<div class="navform">
                            <div class="form-search">
                            </div>
                            <div class="form1">
                                <div class="form2">
                                <div class="label-login">
                                    <label for="#" class="label-welcome"><i class="material-icons md-18">account_circle</i>Hi '.$_SESSION['username'].'</label>
                                </div>
                                <form action="inc/logout.inc.php" method="post">
                                    <div class="navbar-button">   
                                        <button type="submit" class="nav-button" name="submit">Log Out</button>  
                                    </div> 
                                </form> 
                            </div>
                            </div>
                        </div>';

                }    
            }
            
            
            ?>
            
            <!-- when login -->

            
        </div>