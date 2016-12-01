<?php 

session_start();

include('navbar.php');
//$navbar_str comes from navbar.php
$navbar_content_str = $navbar_str;

include('sidebar.php');
$sidebar_content_str = $sidebar_str;

$body_content_str = '';

//----Body for content goes here ------

	if(isset($_SESSION['username_sess']) ){
		$is_user_logged_in = true;
	}else{
		$is_user_logged_in = false;
	}

	//connect to database
	include('connectDB.php');


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
           


	if($result){


	//loop for all rows
	while($row = mysqli_fetch_assoc($result)){
	    // print_r($row);
	    $itemID = $row['id'];
	    $itemname = $row['name'];   //'name' is the db column 
	    $item_image = $row['image'];
	    $item_description = $row['description'];
	    $item_price = $row['price'];
	    $qty_in_stock = $row['qty'];

	    //is_user_logged_in declared at line 83
	    
	    if($is_user_logged_in){
	        $add_to_cart="
	        	<form class='form-inline' action='add_to_cart.php' method='GET'>
	        		Qty:<input class='form-control' type='number' name='qty' min=1 max=$qty_in_stock value=1>
	        		<input type='hidden' name='id' value=$itemID>
	        		<input type='submit' class='btn btn-primary' value='Add to Cart'>
	        	</form>
	        	";
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
				                <h4>Stock: $qty_in_stock</h4>
				            </div>

				            
				            
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
				            
				            <div>
				            	$add_to_cart
				            </div>
				        </div>
				    </div>
				    <!-- End of div for each product entry-->
END;
                    //add the div box to the body
                    $body_content_str .= $item;

                }//end of while loop

            }else{
                $body_content_str .= "<br> ERROR IN SQL STATEMENT<br>";
            }




include('template.php');
 ?>