<?php 
 session_start();
  ?>


<php

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">SARI-SARI STORE</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="cart.php">Cart</a>
                    </li>

                    <?php 
                        if(isset($_SESSION['username_sess'])){
                            echo '<li>
                                    <a href="logout.php">Logout</a>
                                </li>';
                        }

                     ?>
                    
                </ul>


                <?php 
                   

                    if(isset($_SESSION['username_sess'])){
                        //display logout
                         $is_user_logged_in = true;     //variable to know if user is logged in
                    }else{
                        //display form
                         $is_user_logged_in = false;

                        $content=  <<<END
                        <form class="navbar-form navbar-right pull-right" role="search" action="login.php" method="POST">
                  <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username (admin)">
                    <input type="password" class="form-control" name="password" placeholder="Password (admin)">
                  </div>
                  <button type="submit" class="btn btn-default">Login</button>
                </form>
END;

                        echo $content;

                    }

                 ?>
      

                <!-- <span class="nav navbar-right pull-right">
                    <button type="submit" class="btn btn-default">Logout</button>
                </span>
 -->
            </div>
            <!-- /.navbar-collapse -->

           
               
           
        </div>
        <!-- /.container -->
    </nav>
