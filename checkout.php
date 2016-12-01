<?php 

session_start();
if(!isset($_SESSION['cart'])){
	header("location:".$_SERVER['HTTP_REFERER']);

}else{
	$cart = $_SESSION['cart'];

	$allow_checkout = true;
	$total = 0;
	//check all items
	foreach ($cart as $key => $item) {

		$itemID = $item['id'];
		$qty = $item['qty'];

		include('connectDB.php');

		$sql = "SELECT qty,price FROM items WHERE id='$itemID'";		//get qty in stock
		$result = mysqli_query($conn,$sql);
		//get results from db
		while($row = mysqli_fetch_assoc($result)){
			echo " Quantity in stock: ".$row['qty']." qty will buy $qty<br>";

			//if qty in stock >= qty in cart; allow
			if($row['qty'] >= $qty){

				$subtotal = $row['price'] * $qty;
				$total = $total + $subtotal;
				echo "Subtotal: $subtotal<br>";
			}else{
				$allow_checkout = false;	//violaion in qty
				break;						//stop the loop
			}
		}
	}

	if($allow_checkout){
		echo "TOTAL: $total";

		//update database. qty in stock = qty in stock - qty in cart
		foreach ($cart as $key =>$item) {
			$itemID = $item['id'];
			$qty_cart = $item['qty'];


			$sql = "UPDATE items SET qty=qty-$qty_cart WHERE id='$itemID'";
			$result = mysqli_query($conn,$sql);
		}

		//save an empty cart in session
		$cart= array();
		$_SESSION['cart'] = $cart;

		echo "done";

	}else{
		echo 'BAWAL SOBRA BILI';
	}
}

 ?>