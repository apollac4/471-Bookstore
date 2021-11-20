
<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<header align="center">Confirm Order</header> 
</head>
<body>
	<?php
	//Get user info from DB
		$user = 'root';
		$pass = '';
		$db = 'bookstore471';

		$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

		if (mysqli_connect_errno()) {
		echo "not connected! ".$db->error;
		echo $db->error;
		}
		$username = $_GET['username'];
		$que = "SELECT * FROM customer WHERE username = '$username'";
		
		$res = mysqli_query($db, $que);

	?>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="proof_purchase.php" method="post">
	<tr>
	<td>
	Shipping Address:
	</td>
	</tr>
	<?php
	if ($res != null and $res->num_rows > 0) {
			$row = mysqli_fetch_assoc($res);
			echo '<td colspan="2"> ' . $row['Fname'] . " " . $row['Lname']	. '</td>';
			echo '<td rowspan="3" colspan="2">';
			echo '<input type="radio" name="cardgroup" value="profile_card" checked>Use Credit card on file<br />' . $row['CCCompany'] . " - " . $row['CCNumber'] . " - " . $row['CCExpiration']."<br />";
	}
	?>
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
		<?php
		echo'<tr>
			<td colspan="2">
				'. $row['Address']. '	</td>		
			</tr>
			<tr>
			<td colspan="2">
				'. $row['City'] .'	</td>
			</tr>
			<tr>
			<td colspan="2">
				'. $row['State'] . ', ' . $row['Zip'] . '</td>
			</tr>';
		?>
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
			echo "<tr><td>" . $shoppingcart[$i+1] . "</br><b>By</b> " . $shoppingcart[$i + 2] . "</br><b>Publisher:</b> TODO</td><td class='qty'>" . $quantities[$i/4] .
			"</td><td class='price'>" . ((float)$shoppingcart[$i+3]) * ((int) $quantities[$i/4]) . "</td></tr></table>";
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
		SubTotal:$<span id='subtotal'></span></br>Shipping_Handling: $<span id='shipping'></span></br>_______</br>Total:$<span id='total'></span>	</div>
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

	function calculateTotal(){
		var prices = document.getElementsByClassName('price')
		var subTotal = 0;
		for(price of prices) {
			subTotal += parseFloat(price.innerHTML);
		}
		var shipping = calculateShipping();
		var total = (subTotal + shipping).toFixed(2);
		document.getElementById('subtotal').innerHTML=subTotal;
		document.getElementById('shipping').innerHTML=shipping;
		document.getElementById('total').innerHTML=total;
	}

	function calculateShipping(){
		var qtys = document.getElementsByClassName('qty');
		var total = 0
		for(qty of qtys){
			total += parseInt(qty.innerHTML);
		}
		return total * 2;
	}
	calculateTotal();
</script>
</HTML>
