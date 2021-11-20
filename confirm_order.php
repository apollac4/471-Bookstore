
<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<header align="center">Confirm Order</header> 
</head>
<body>

	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="proof_purchase.php" method="post">
	<tr>
	<td>
	Shipping Address:
	</td>
	</tr>
	<td colspan="2">
		test test	</td>
	<td rowspan="3" colspan="2">
		<input type="radio" name="cardgroup" value="profile_card" checked>Use Credit card on file<br />MASTER - 1234567812345678 - 12/2015<br />
		<input type="radio" name="cardgroup" value="new_card">New Credit Card<br />
				<select id="credit_card" name="credit_card">
					<option selected disabled>select a card type</option>
					<option>VISA</option>
					<option>MASTER</option>
					<option>DISCOVER</option>
				</select>
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
				<br />Exp date<input type="text" id="card_expiration" name="card_expiration" placeholder="mm/yyyy">
	</td>
	<tr>
	<td colspan="2">
		test	</td>		
	</tr>
	<tr>
	<td colspan="2">
		test	</td>
	</tr>
	<tr>
	<td colspan="2">
		Tennessee, 12345	</td>
	</tr>
	<tr>
	<td colspan='3' align='center'>
	<?php 
	$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$url_components = parse_url($url);
	parse_str($url_components['query'], $params);
	$book1 = $params['shoppingcart'];
	$shoppingcart = (explode(",",$book1));
	$quantities = $params['quantities'];
	$quantities = (explode(",",$quantities));

	for($i = 0; $i < count($shoppingcart); $i+=4){
		echo "<div id='bookdetails' style='overflow:scroll;height:180px;width:520px;border:1px solid black;'>";
		echo "<table border='1'>";
		echo "<th>Book Description</th><th>Qty</th><th>Price</th>";
		echo "<tr><td>" . $shoppingcart[$i+1] . "</br><b>By</b> " . $shoppingcart[$i + 2] . "</br><b>Publisher:</b> TODO</td><td>" . $quantities[$i/4] .
		"</td><td>" . ((float)$shoppingcart[$i+3]) * ((int) $quantities[$i/4]) . "</td></tr></table>";
	}

	?>
	</div>
	</td>
	</tr>
	<tr>
	<td align="left" colspan="2">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue">
	<b>Shipping Note:</b> The book will be </br>delivered within 5</br>business days.
	</div>
	</td>
	<td align="right">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;">
		SubTotal:$12.99</br>Shipping_Handling:$2</br>_______</br>Total:$14.99	</div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="BUY IT!">
		</td>
		</form>
		<td align="right">
			<form id="update" action="update_customerprofile.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="Update Customer Profile">
			</form>
		</td>
		<td align="left">
			<input type="submit" onclick="cancel()" id="cancel" name="cancel" value="Cancel">
		</td>
	</tr>
	</table>

</body>
<script>
	var shoppingCart = "<?php echo $_GET["shoppingcart"] ?>";
	var username = "<?php echo $_GET["username"] ?>";
	function cancel(){
		window.location.href="screen2.php?shoppingCart="+shoppingCart+"&username="+username;
	}
</script>
</HTML>
