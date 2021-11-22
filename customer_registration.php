<script>alert('Please enter all values')</script><!-- UI: Prithviraj Narahari, php code: Alexander Martens -->
<head>
<title> CUSTOMER REGISTRATION </title>
</head>
<?php
$user = 'root';
$pass = '';
$db = 'bookstore471';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

if (mysqli_connect_errno()) echo "not connected! ".$db->error;

if(isset($_POST['register_submit'])){
	//Check if user exists
	$username =  mysqli_real_escape_string($db,$_POST['username']);
	$que = "SELECT * FROM customer WHERE username = '". $username ."'";

	$res = mysqli_query($db, $que);
	if($res!=null){
		$pin = mysqli_real_escape_string($db,$_POST['pin']);
		$fname = mysqli_real_escape_string($db,$_POST['firstname']);
		$lname = mysqli_real_escape_string($db,$_POST['lastname']);
		$address = mysqli_real_escape_string($db,$_POST['address']);
		$city = mysqli_real_escape_string($db,$_POST['city']);
		$state = mysqli_real_escape_string($db,$_POST['state']);
		$zip = mysqli_real_escape_string($db,$_POST['zip']);
		$cctype = mysqli_real_escape_string($db,$_POST['credit_card']);
		$ccnumber = mysqli_real_escape_string($db,$_POST['card_number']);
		$expirationdate = mysqli_real_escape_string($db,$_POST['expiration']);

		$insert = $db->query("INSERT INTO `customer` (`username`, `pin`, `fname`, `lname`, `address`, `city`, `state`, `zip`, `cccompany`, `ccnumber`, `ccexpiration`) VALUES ('$username', $pin, '$fname', '$lname', '$address', '$city', '$state', $zip, '$cctype', '$ccnumber', '$expirationdate');");

		if(!$insert)
		{
			echo "Problem inserting";
			echo mysqli_error($db);
		}
		else
		{
			echo "Records added successfully.";
		}
	} else {
		echo "User already exists.  Please enter a valid username";
	}
}
	mysqli_close($db);

?>

<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<form id="register" action="" method="post">
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left" colspan="3">
				<input type="text" id="username" name="username" placeholder="Enter your username">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin">
			</td>
			<td align="right">
				Re-type PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="firstname" name="firstname" placeholder="Enter your firstname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" placeholder="Enter your lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td align="left">
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
			<td align="left">
				<input type="text" id="zip" name="zip">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration" name="expiration" placeholder="MM/YY">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"> 
				<input type="submit" id="register_submit" name="register_submit" value="Register">
			</td>
			</form>
			<td colspan="2" align="center">
				<input type="submit" id="donotregister" name="donotregister" value="Don't Register" onclick="returnToSearch()">
			</td>
		</tr>
	</table>
</body>
<script>
var shoppingCart = "<?php echo $_GET["shoppingcart"]; ?>";
var username = "<?php echo $_GET['username'] ?>";

function returnToSearch(){
	alert("In order to proceed with the payment, you\n need to register first.");
	window.location.href="screen2.php?shoppingcart=" + shoppingCart+ "&username=" + username;
}

</script>
</HTML>