<head>
	<?php 
		if(isset($_POST['update_submit'])){
		
		$username = $_GET['username'];
		$pin = $_POST['new_pin'];
		$firstName = $_POST['firstname'];
		$lastName = $_POST['lastname'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$zip = $_POST['zip'];
		$cardNum = $_POST['card_number'];
		$exp = $_POST['expiration_date'];

		$user = 'root';
		$pass = '';
		$db = 'bookstore471';
		$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

		if (mysqli_connect_errno()) {
			echo "not connected! ".$db->error;
			echo $db->error;
		}

		$query = "UPDATE customer SET Fname = '$firstName', Lname = '$lastName', PIN = '$pin', Address = '$address', 
					City = '$city', Zip = '$zip', CCNumber = '$cardNum', CCExpiration='$exp' WHERE Username='$username'";
		$result = mysqli_query($db, $query);
		$updated = 1;
		} else {
			$updated = 0;
		}
		if(isset($_POST['cancel_submit'])){
			$back = 1;
		} else {
			$back = 0;
		}
	?>
<title>UPDATE CUSTOMER PROFILE</title>

</head>
<body>
	<form id="update_profile" action="" method="post">
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="right">
				<?php echo "Username: " . $_GET['username'] ?>
			</td>
			<td colspan="3" align="center">
							</td>
		</tr>
		<tr>
			<td align="right">
				New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="new_pin" name="new_pin" label="123">
			</td>
			<td align="right">
				Re-type New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="retypenew_pin" name="retypenew_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				First Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="firstname" name="firstname">
			</td>
		</tr>
		<tr>
			<td align="right"> 
				Last Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="lastname" name="lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="address" name="address">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="city" name="city">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td>
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option>Michigan</option>
				<option>California</option>
				<option>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="zip" name="zip">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>:
			</td>
			<td>
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td align="left" colspan="2">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY">
			</td>
		</tr>
	
		<tr>
			<td align="right" colspan="2">
				<input type="submit" id="update_submit" name="update_submit" value="Update">
			</td>
			<td align="left" colspan="2">
				<input type="submit" id="cancel_submit" name="cancel_submit" value="Cancel">
			</td>
		</tr>
		
	</table>
	</form>
</body>
<script>
	var shoppingCart = "<?php echo $_GET["shoppingcart"] ?>";
	var username = "<?php echo $_GET["username"] ?>";
	var quantities = "<?php echo $_GET["quantities"] ?>";
	var updated = "<?php echo $updated ?>"
	var back = "<?php echo $back ?>"

	function previous(){
		window.location.href="confirm_order.php?shoppingcart="+shoppingCart+"&username="+username+"&quantities="+quantities;
	}

	if(updated == 1  || back == 1){
		previous();	
	}

</script>
</html>