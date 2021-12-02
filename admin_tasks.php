
<!DOCTYPE HTML>
<head>
	<title>ADMIN TASKS</title>
</head>
<body>
	<?php 

		if(!array_key_exists("adminname",$_GET) and array_key_exists("adminname",$_REQUEST)){
			$admin_name = $_REQUEST['adminname'];

			$pin = $_REQUEST['pin'];
			$user = 'root';
			$pass = '';
			$db = 'bookstore471';
			$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

			if (mysqli_connect_errno()) {
				echo "not connected! ".$db->error;
				echo $db->error;
			}

			$query = "SELECT * FROM administrator WHERE Username='$admin_name' AND PIN = '$pin'";
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
				$countOfUsers = 0;
				$query = "SELECT * FROM customer";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				if (mysqli_num_rows($result)==0){
					echo "No existing users.";
				} else {
					for ($i = 0; $i < $num_rows; $i++) {
						$row = mysqli_fetch_assoc($result);
						$countOfUsers+=1;
					}
					echo "<br><br><h1>There are currently " . $countOfUsers . " users registered.</h1>";
				}
				$query = "SELECT Genre, COUNT(*) FROM book GROUP BY Genre ORDER BY Genre";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				if (mysqli_num_rows($result)==0){
					echo "No existing books in database.";
				} else {
					echo "<br><br>";
					for ($i = 0; $i < $num_rows; $i++) {
						$row = mysqli_fetch_assoc($result);
						echo "<h1>There are currently " . $row['COUNT(*)'] . " books in " . $row['Genre'] . "</h1>";
					}
				}

				// DATES

				echo "<br><br>";
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '01%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in January on books is $" . $row['average']  . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '02%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in February on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '03%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in March on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '04%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in April on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '05%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in May on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '06%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in June on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '07%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in July on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '08%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in August on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '09%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in September on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '10%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in October on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '11%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in November on books is $" . $row['average'] . "</h1>";
				}
				$query = "SELECT AVG(Total) AS 'average' FROM purchase WHERE Date LIKE '12%'";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<h1>The average money spent this year in December on books is $" . $row['average'] . "</h1>";
				}


				$query = "SELECT book.Title, COUNT(review.ISBN)
				FROM book JOIN review ON book.ISBN = review.ISBN
				GROUP BY book.Title";
				$result = mysqli_query($db, $query);
				$num_rows = mysqli_num_rows($result);
				for ($i = 0; $i < $num_rows; $i++) {
					$row = mysqli_fetch_assoc($result);
					echo "<br><br><h1>There are currently " . $row['COUNT(review.ISBN)'] . " review(s) for " . $row['Title'] . "</h1>";
				}
				}
				
	 } else if(array_key_exists("adminname",$_GET)){
			$admin_name = $_GET['adminname']; 
		} else {
			$admin_name = 'none';
		}



	?>

	<table align="center" style="border:2px solid blue;">
		<!-- <tr>
			<form action="manage_bookstorecatalog.php" method="post" id="catalog">
			<td align="center">
				<input type="submit" name="bookstore_catalog" id="bookstore_catalog" value="Manage Bookstore Catalog" style="width:200px;">
			</td>
			</form>
		</tr>
		<tr>
			<form action=" " method="post" id="orders">
			<td align="center">
				<input type="submit" name="place_orders" id="place_orders" value="Place Orders" style="width:200px;">
			</td>
			</form>
		</tr>
		<tr>
			<form action="reports.php" method="post" id="reports">
			<td align="center">
				<input type="submit" name="gen_reports" id="gen_reports" value="Generate Reports" style="width:200px;">
			</td>
			</form>
		</tr>
		<tr>
			<form action="update_adminprofile.php" method="post" id="update">
			<td align="center">
				<input type="submit" name="update_profile" id="update_profile" value="Update Admin Profile" style="width:200px;">
			</td>
			</form>
		</tr>
		<tr>
		<td>&nbsp</td>
		</tr> -->
		<tr>
			<form action="index.php" method="post" id="exit">
			<td align="center">
				<input type="submit" name="cancel" id="cancel" value="EXIT 3-B.com[Admin]" style="width:200px;">
			</td>
			</form>
		</tr>
	</table>
</body>


</html>