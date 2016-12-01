<?php 
	session_start();

	$itemID = $_GET['id'];

	echo "Removing item $itemID<br>"; 

	if(isset($_SESSION['cart'])){
		$old_cart = $_SESSION['cart'];				//get the old/existing cart



		//check if item already exists in old cart
		if(isset($old_cart["cart_$itemID"])){
			
			unset($old_cart["cart_$itemID"]);			//remove item in old cart array

			
			$_SESSION['cart'] = $old_cart;				//save old cart to session
		}else{
			//no item is not in cart
		}
	}else{
		//no cart
	}

	header("location:".$_SERVER['HTTP_REFERER']);

 ?>