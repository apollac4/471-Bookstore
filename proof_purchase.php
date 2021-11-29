
<!DOCTYPE HTML>
<head>
	<title>Proof purchase</title>
	<header align="center">Proof purchase</header> 
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
	<form id="buy" action="" method="post">
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
			echo '<b>UserID:</b>' . $_GET['username'] . '<br />';
			echo '<b>Date:</b>'.date("Y/m/d").'<br /><b>Time:</b>'.date("H:i:s").'<br />';
			echo '<b>Card Info:</b>' . $row['CCCompany'] . '<br />' . $row['CCExpiration'] . ' - ' . $row['CCNumber'] .	'</td>';
		}
	echo '
	<tr>
	<td colspan="2">
		'.$row['Address'].	'</td>		
	</tr>
	<tr>
	<td colspan="2">
		'.$row['City'] .' </td>
	</tr>
	<tr>
	<td colspan="2">
		' .$row['State'].", ". $row['Zip'].'</td>
	</tr>'
	?>
	<tr>
	<td colspan="3" align="center">
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
			echo "<tr><td>" . $shoppingcart[$i+1] . "</br><b>By</b> " . $shoppingcart[$i + 2] . "</br><b>Price: $</b>" . $shoppingcart[$i+3] . " </td><td class='qty'>" . $quantities[$i/4] .
			"</td><td class='price'>" . ((float)$shoppingcart[$i+3]) * ((int) $quantities[$i/4]) . "</td></tr></table>";
		}

	?>
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
		SubTotal:$<?php echo $params['subtotal']?></br>Shipping_Handling:$<?php echo $params['shipping']?>
	</br>_______</br>Total:$<?php echo $params['total']	?></div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="Print" disabled>
		</td>
		</form>
		<td align="right">
			<form id="update" action="screen2.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="New Search">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="index.php" method="post">
			<input type="submit" id="exit" name="exit" value="EXIT 3-B.com">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
