
<!-- Figure 2: Search Screen by Alexander -->
<html>
<head>
	<title>SEARCH - 3-B.com</title>
</head>
<body>
	<?php
	if(!array_key_exists("username",$_GET) & array_key_exists("username",$_REQUEST)){
		$username = $_REQUEST['username'];
		$pin = $_REQUEST['pin'];
		$user = 'root';
		$pass = '';
		$db = 'bookstore471';
		$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

		if (mysqli_connect_errno()) {
			echo "not connected! ".$db->error;
			echo $db->error;
		}

		$query = "SELECT * FROM customer WHERE Username='$username' AND PIN = '$pin'";
		$result = mysqli_query($db, $query);
		$num_rows = mysqli_num_rows($result);
		if (mysqli_num_rows($result)==0){
			echo "No current user. Please sign up or enter correct sign-in information.";
		}
		else {
			for ($i = 0; $i < $num_rows; $i++) {
				$row = mysqli_fetch_assoc($result);
				echo "Successfully logged in as " . $row["Username"];
			}
		}
	} else {
		$username = "none";
	}
	?>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td>Search for: </td>
				<td><input id="searchfor" name="searchfor" /></td>
				<td><input type="submit" name="search" value="Search" onclick="toResults()"/></td>
		</tr>
		<tr>
			<td>Search In: </td>
				<td>
					<select id="searchon" name="searchon" multiple>
						<option value="anywhere" selected='selected'>Keyword anywhere</option>
						<option value="title">Title</option>
						<option value="author">Author</option>
						<option value="publisher">Publisher</option>
						<option value="isbn">ISBN</option>				
					</select>
				</td>
				<td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>
		</tr>
		<tr>
			<td>Category: </td>
				<td><select id="category" name="category">
						<option value='all' selected='selected'>All Categories</option>
						<option value='1'>Fantasy</option><option value='2'>Adventure</option><option value='3'>Fiction</option><option value='4'>Horror</option>				</select></td>
				
	<form action="index.php" method="post">	
				<td><input type="submit" name="exit" value="EXIT 3-B.com" /></td>
			</form>
		</tr>
	</table>
</body>
<script>

var shoppingCart = "<?php if(array_key_exists('shoppingcart', $_GET))
							{
								echo $_GET['shoppingcart'];
							} else {
								echo "empty";
							}
					?>";

function toResults(){
	var searchfor = document.getElementById("searchfor").value;
	var category = document.getElementById("category").value;
	var searchon = document.getElementById("searchon").value;
	var username = "<?php echo $username ?>";
	
	window.location.href="screen3.php?searchfor=" + searchfor + "&category=" + category 
		+ "&searchon=" + searchon + "&shoppingcart=" + shoppingCart + "&username=" + username;
}

</script>
</html>
