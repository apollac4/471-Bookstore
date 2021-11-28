<head>
	<?php 
		$user = 'root';
		$pass = '';
		$db = 'bookstore471';
		$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
		$username = $_GET['username'];
		$row = null;
		if (mysqli_connect_errno()) {
			echo "not connected! ".$db->error;
			echo $db->error;
		}

		if(isset($_POST['update_submit'])){
			$pin = $_POST['new_pin'];
			$firstName = $_POST['firstname'];
			$lastName = $_POST['lastname'];
			$state= $_POST['state'];
			$address = $_POST['address'];
			$city = $_POST['city'];
			$zip = $_POST['zip'];
			$cardNum = $_POST['card_number'];
			$cardType = $_POST['credit_card'];
			$exp = $_POST['expiration_date'];

			$query = "UPDATE customer SET Fname = '$firstName', Lname = '$lastName', PIN = '$pin', Address = '$address', 
						City = '$city', Zip = '$zip', CCNumber = '$cardNum', CCExpiration='$exp', CCCompany = '$cardType', State = '$state' WHERE Username='$username'";
			$result = mysqli_query($db, $query);
			$updated = 1;
		} else {
			$updated = 0;
		}
		if(isset($_POST['cancel_submit'])){//Return to confirm order page with existing values
			$back = 1;
		} else {
			$back = 0;
		}
		if($updated == 0 && $back == 0){//perform query to retrieve customer profile values
			$query = "SELECT * FROM customer WHERE Username='$username'";

			$result = mysqli_query($db, $query);	

			if ($result != null and $result->num_rows > 0) {
				$row = mysqli_fetch_assoc($result);
			}
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
				<?php if($row != null) echo "<input type='text' id='new_pin' name='new_pin' value='" . $row['PIN'] . "'>" ?>
			</td>
			<td align="right">
				Re-type New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<?php if($row != null) echo "<input type='text' id='retypenew_pin' name='retypenew_pin' value='" . $row['PIN'] . "'>" ?>
			</td>
		</tr>
		<tr>
			<td align="right">
				First Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<?php if($row != null) echo "<input type='text' id='firstname' name='firstname' value='" . $row['Fname'] . "'>" ?>
			</td>
		</tr>
		<tr>
			<td align="right"> 
				Last Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<?php if($row != null) echo "<input type='text' id='lastname' name='lastname' value='" . $row['Lname'] . "'>" ?>
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<?php if($row != null) echo "<input type='text' id='address' name='address' value='" . $row['Address'] . "'>" ?>
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<?php if($row != null) echo "<input type='text' id='city' name='city' value='" . $row['City'] . "'>" ?>
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td>
				<select id="state" name="state">
				<?php if($row != null) echo "<option selected disabled>" . $row['State'] . "</option>" ?>
				<option>Michigan</option>
				<option>California</option>
				<option>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td>
				<?php if($row != null) echo "<input type='text' id='zip' name='zip' value='" . $row['Zip'] . "'>" ?>
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>:
			</td>
			<td>
				<select id="credit_card" name="credit_card">
				<?php if($row != null) echo "<option selected disabled>" . $row['CCCompany'] . "</option>" ?>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td align="left" colspan="2">
				<?php if($row != null) echo "<input type='text' id='card_number' name='card_number' value='" . $row['CCNumber'] . "'>" ?>
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<?php if($row != null) echo "<input type='text' id='expiration_date' name='expiration_date' value='" . $row['CCExpiration'] . "'>" ?>
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