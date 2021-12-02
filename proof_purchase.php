
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

		//Check if a new card was entered
		if(isset($_GET['type'])){
			$cardNum = mysqli_real_escape_string($db,$_GET['card_num']);
			$type = mysqli_real_escape_string($db,$_GET['type']);
			$exp = mysqli_real_escape_string($db,$_GET['exp']);
			$que ="UPDATE customer SET CCNumber='$cardNum', CCCompany='$type', CCExpiration='$exp' WHERE username = '$username'";
		
			$updateCardResult = mysqli_query($db, $que);
			if($updateCardResult){
				echo "Card updated successfully.";
			} else {
				echo "Something went wrong with card update.";
				echo mysqli_error($db);
			}
		}

		//Get values from URL to use on the rest of the page
		$que = "SELECT * FROM customer WHERE username = '$username'";
		
		$res = mysqli_query($db, $que);

		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url_components = parse_url($url);
		parse_str($url_components['query'], $params);
		$book1 = $params['shoppingcart'];
		$shoppingcart = (explode(",",$book1));
		$quantities = $params['quantities'];
		$quantities = (explode(",",$quantities));

		//Create order in database
		$newPurchaseId = rand(0, 1000000000);
		$purchaseName = mysqli_real_escape_string($db,$_GET['username']);
		$purhchaseTotal = mysqli_real_escape_string($db,$params['total']);
		$purchaseDate = mysqli_real_escape_string($db,date("m/d/y"));
		$purchaseTime = mysqli_real_escape_string($db,date("H:i:s"));
		$que ="INSERT INTO purchase VALUES ($newPurchaseId, '$purchaseName', $purhchaseTotal, '$purchaseDate', '$purchaseTime');";

		$insertPurchaseResult = mysqli_query($db, $que);
		if($insertPurchaseResult){
			echo "Order created successfully.";
		} else {
			echo "Something went wrong with purchase table.";
			echo mysqli_error($db);
		}

		//Insert into holds table for each book purchased
		for($i = 0; $i < count($shoppingcart); $i+=4){
			$holdsISBN = mysqli_real_escape_string($db, $shoppingcart[$i]);
			$holdsQty = mysqli_real_escape_string($db, $quantities[$i/4]);
			$que ="INSERT INTO holds VALUES ($newPurchaseId, $holdsQty, '$holdsISBN', '$purchaseName');";

			$insertHoldsResult = mysqli_query($db, $que);
			if($insertHoldsResult){
				echo "Insert into holds successful.";
			} else {
				echo "Something went wrong with holds table.";
				echo mysqli_error($db);
			}
		}
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
			<input type="submit" id="buyit" name="btnbuyit" value="Print" onclick="printPage()">
		</td>
		</form>
		<td align="right">
			<input onclick=newSearch() type="submit" id="update_customerprofile" name="update_customerprofile" value="New Search">
		</td>
		<td align="left">
			<form id="cancel" action="index.php" method="post">
			<input type="submit" id="exit" name="exit" value="EXIT 3-B.com">
			</form>
		</td>
	</tr>
	</table>
</body>
<script>
	var username = "<?php echo $_GET['username'] ?>";
	function newSearch(){
		window.location.href="screen2.php?username=" + username;
	}

	function printPage(){
     	window.print();
	}
</script>
</HTML>
