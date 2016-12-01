<?php



session_start();

include('navbar.php');
include('sidebar.php');
$navbar_content_str =  $navbar_str;
$sidebar_content_str = $sidebar_str;
$body_content_str = '';


include('connectDB.php');


$body_content_str .= 'CART<br>';

// $cart = array();
// $cart_1 = array();
// $cart_1['id'] = 1;
// $cart_1['qty'] = 5;

// $cart_3 = array();
// $cart_3['id'] = 3;
// $cart_3['qty'] = 20;

// $cart_6 = array();
// $cart_6['id'] = 6;
// $cart_6['qty'] = 4;

// $cart['cart_1'] = $cart_1;
// $cart['cart_3'] = $cart_3;
// $cart['cart_6'] = $cart_6;


// print_r($cart);
//assume $cart is from $_SESSION

if(!isset($_SESSION['cart'])){
	$body_content_str .= 'Shopping ka muna beh!!';
	$cart = array();
}else{
	$cart = $_SESSION['cart'];
}



foreach ($cart as $key => $item) {
	// echo "<br>----------------------------------<br>";

	// echo "Key: ". $key . " item";
	// print_r($item);
	$id = $item['id'];
	$qty = $item['qty'];
	// echo "<br>";

	// echo "DO MySQL Querry for each item here<br>";

	//get other details from db
	$sql = "SELECT * FROM items WHERE id='$id'";
	$result = mysqli_query($conn,$sql);
	// echo "SQL: $sql <br>";

	//get results from db
	while($row = mysqli_fetch_assoc($result)){
		$itemID = $row['id'];
		$body_content_str .= "id: ".$itemID." product name: ".$row['name']." Quantity: ".$qty;

		$body_content_str .= " <a href='remove_from_cart.php?id=$itemID'> Remove</a>";

		$body_content_str .= "<br>";
	}
	

	// echo "<br>----------------------------------<br>";
}
$body_content_str .= "<a href='checkout.php'><button>Checkout</button></a>";
include('template.php');



//
// foreach($_SESSION as $key => $value){
// 	if(substr($key,0,4)=='cart'){
// 		$itemID[] = substr($key,5);
// 		$itemQuantity[] = $value;
// 	}
// }

// for($x=0;$x<count($itemID);$x++){
// 	$id = $itemID[$x];
// 	$sql = "SELECT * FROM items WHERE id='$id'";
// 	$result = mysqli_query($conn,$sql);
// 	while($row = mysqli_fetch_assoc($result)){
// 		echo "product name: ".$row['name']." Quantity: ".$itemQuantity[$x]."<br>";
// 	}
// }

?>