
<!-- screen 4: Book Reviews by Prithviraj Narahari, php coding: Alexander Martens-->
<!DOCTYPE html>
<html>
<head>
<title>Book Reviews - 3-B.com</title>
<style>
.field_set
{
	border-style: inset;
	border-width:4px;
}
</style>
</head>
<body>

	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="center">
				<h5> Reviews For:</h5>
			</td>
			<td align="left">
				<h5> </h5>
			</td>
		</tr>
			
		<tr>
			<td colspan="2">
			<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
				<table>
				<?php
				$user = 'root';
				$pass = '';
				$db = 'bookstore471';

				$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

				if (mysqli_connect_errno()) {
				echo "not connected! ".$db->error;
				echo $db->error;
				}


				$que = "SELECT * FROM review WHERE ISBN = '" . $_GET["isbn"] . "'";

				$res = mysqli_query($db, $que);
				if ($res==null) echo "<p>nothing returned</p>";//error checking
				$out = mysqli_num_rows($res);
				if ($out==0) echo "no rows";//error checking

				if ($res->num_rows > 0) {
					// output data of each row
					while($row = $res->fetch_assoc()) {
					echo "<tr> ".$row["Content"]. "</tr><br>";
					}
				} else {
					echo "0 results";
				}
				?>
				</table>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="Done" onclick="returnToSearchResults()">
			</td>
		</tr>
	</table>

</body>
<script>
	
	var searchfor = "<?php echo $_GET['searchfor']; ?>"; 
	var category = "<?php echo $_GET['category']; ?>";
	var searchon = "<?php echo $_GET['searchon']; ?>";
	function returnToSearchResults(){
		window.location.href="screen3.php?searchfor=" + searchfor + "&category=" + category + "&searchon=" + searchon;
	}
</script>
</html>
