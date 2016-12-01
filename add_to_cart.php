<?php

session_start();

$itemID = $_GET['id'];
$quantity = $_GET['qty'];
echo "Adding item ". $itemID . " qty: ". $quantity. "<br>";


$cart = array();
$item_in_cart = array();
$item_in_cart['id'] = $itemID;
$item_in_cart['qty'] = $quantity;

$cart["cart_$itemID"] = $item_in_cart;

print_r($item_in_cart);
echo '<br>';
print_r($cart);

//Save to $_SESSION

if(isset($_SESSION['cart'])){
	$old_cart = $_SESSION['cart'];				//get the old/existing cart


	//check if item already exists in old cart
	if(isset($old_cart["cart_$itemID"])){
		$old_item = $old_cart["cart_$itemID"];				//get old item

		//verify if qty will exceed stock
		//connect to database
		include('connectDB.php');

		
		$new_qty = $old_item['qty'] + $quantity;
		$sql = "SELECT qty FROM items WHERE id='$itemID'";		//get qty in stock
		$result = mysqli_query($conn,$sql);
		//get results from db
		while($row = mysqli_fetch_assoc($result)){
			echo " Quantity in stock: ".$row['qty']."<br>";

			//if qty in stock >= new_qty in cart; allow
			if($row['qty'] >= $new_qty){
				$old_item['qty'] = $old_item['qty'] + $quantity;	//update qty
			}else{
				echo 'Too much na';
			}
		}



		echo "Verifying... new qty: $new_qty";
		
		$old_cart["cart_$itemID"] = $old_item;			//update old item in cart
	}else{
		$old_cart["cart_$itemID"] = $item_in_cart;	//add item in old cart
	}




	
	$_SESSION['cart'] = $old_cart;				//save updated old cart in session
}else{
	$_SESSION['cart'] = $cart;			//no cart at the beginning
}

echo 'Sesson saved<br>';

header("location:".$_SERVER['HTTP_REFERER']);		//go back to the previous page


// if( isset($_SESSION["cart_$itemID"]) ){
// 	$_SESSION["cart_$itemID"]++;
// }
// else $_SESSION["cart_$itemID"]=1;

// header("location:".$_SERVER['HTTP_REFERER']);

?>