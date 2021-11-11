
<!DOCTYPE HTML>
<head>
	<title>Shopping Cart</title>
	<script>
	//remove from cart
	function del(title){
		window.location.href="shopping_cart.php?delIsbn="+ title;
	}
	</script>
</head>
<body>

<?php
$user = 'root';
$pass = '';
$db = 'bookstore471';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

if (mysqli_connect_errno()) {
  echo "not connected! ".$db->error;
  echo $db->error;
}

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
     
$book1 = $params['shoppingCart'];

$book_arr = (explode(",",$book1));

?>

	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
				<form id="checkout" action="confirm_order.php" method="get">
					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
				</form>
			</td>
			<td align="center">
				<form id="new_search" action="screen2.php" method="post">
					<input type="submit" name="search" id="search" value="New Search">
				</form>								
			</td>
			<td align="center">
				<form id="exit" action="index.php" method="post">
					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
				</form>					
			</td>
		</tr>

		<tr>
				<form id="recalculate" name="recalculate" action="" method="post">

			<td  colspan='3'>
			<div id='bookdetails' style='overflow:scroll;height:180px;width:400px;border:1px solid black;'>
			<table align='center' BORDER='2' CELLPADDING='2' CELLSPACING='2' WIDTH='100%'>
			<?php
			if(count($book_arr) > 1){
				for ($x = 0; $x < count($book_arr); $x+=4) {
					echo "<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>";
					echo "<tr>";
					echo "<td><button name='delete' id='delete' onClick='del($book_arr[$x]);return false;'>Delete Item</button></td>";
					echo "<td>" . $book_arr[$x+1] . "</br><b>By</b> " . $book_arr[$x+2] . "</br></td>";
					echo "</br>";
					echo "<td>";
					echo "<input id='txt123441' name='txt123441' value='1' size='1' />";
					echo "</td>";
					echo "<td class='price'>" . $book_arr[$x+3] .  "</td>";
					echo "<td></td>";
					echo "</tr>";
					}
			}
								?>
				</table>
				</div>
				</td>

		</tr>

		<tr>
			<td align="center">				
					<input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment">
				</form>
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center" id="total"></td>
		</tr>
	</table>
</body>
<script>

function calculateSubtotal(){
	var total = 0;
	var books = document.getElementsByClassName("price");
	for(var i = 0; i < books.length; i++){
		console.log(books[i].innerHTML);
		total += parseFloat(books[i].innerHTML);
	}
	document.getElementById("total").innerHTML = "Subtotal: " + total;
}
calculateSubtotal();
</script>
