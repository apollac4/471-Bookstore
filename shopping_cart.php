
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
echo $book1;
$book_arr = (explode(",",$book1));
print_r($book_arr);
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
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
						<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>
						<tr>
							<td>
								<?php echo "<button name='delete' id='delete' onClick='del($book_arr[0]);return false;'>Delete Item</button>"
							?>
							</td>
							<td> <?php echo  $book_arr[1]; ?>
							</br>
							<b>By</b> <?php echo  $book_arr[2]; ?></br>
						</td>
						<td>
							<input id='txt123441' name='txt123441' value='1' size='1' />
						</td>
						<td> <?php echo $book_arr[3] ?></td>
					</tr>					
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
			<td align="center">			
				Subtotal: <?php echo $book_arr[3] ?>			</td>
		</tr>
	</table>
</body>
