<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

</head>

<body>

    <?php include_once('header.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <?php  include_once('sidebar.php'); ?>
            </div>
            <div class="col-md-9">        
                <div class="row">

                   <?php                        

                        require_once('connectDB.php');
                        

                    
                        //check if there is a GET data (category)
                        if(isset($_GET['category'])){
                            $item_category= $_GET['category'];


                            //http://localhost/sarisari/home.php?category=All
                            if($item_category=='all' ){

                                $statement = "SELECT * FROM items" ;

                            }else{
                                $statement = "SELECT * FROM items WHERE category='$item_category'" ;
                            }
                            
                        }else{
                            //(http://localhost/sarisari/home.php)
                            $statement = "SELECT * FROM items" ;
                        }
            

                        

                        $result = mysqli_query($conn,$statement);
                        echo "$statement <br>";


                        if($result){
                            echo "<br> has result<br>";

                            //loop for all rows
                            while($row = mysqli_fetch_assoc($result)){
                                // print_r($row);
                                $itemname = $row['name'];   //'name' is the db column 
                                $item_image = $row['image'];
                                $item_description = $row['description'];
                                $item_price = $row['price'];

                               
                                //is_user_logged_in declared at line 83
                                if($is_user_logged_in){
                                    $add_to_cart="<button class='btn'>Add $itemname to Cart</button>";
                                }else{
                                    $add_to_cart="";    //no button if not logged in
                                }
                                

                                $item =<<<END
                                  <!-- Start of div for each product entry-->
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img class="fit" src="images/$item_image" alt="">
                        <div class="caption">
                            <h4 class="pull-right">P$item_price</h4>
                            <h4><a href="#">$itemname</a>
                            </h4>
                            <p>$item_description</p>
                        </div>

                        $add_to_cart
                        <!--
                        <div class="ratings">
                            <p class="pull-right">15 reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </p>
                        </div>
                        -->
                    </div>
                </div>
                <!-- End of div for each product entry-->
END;
                                echo $item;
                               

                            }
                        }else{
                            echo "<br> ERROR IN SQL STATEMENT<br>";
                        }


                    ?>


                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
    <?php include_once('footer.php'); ?>
</body>

</html>
