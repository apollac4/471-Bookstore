
<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->
<html>
<head>
	<title> Search Result - 3-B.com </title>
	<script>
	//redirect to reviews page
	function review(isbn, title){
		window.location.href="screen4.php?isbn="+ isbn + "&title=" + title;
	}
	//add to cart
	function cart(isbn, searchfor, searchon, category){
		window.location.href="screen3.php?cartisbn="+ isbn + "&searchfor=" + searchfor + "&searchon=" + searchon + "&category=" + category;

		// onClick='cart(\"" . $row["ISBN"] . "\", \"" . $_GET["searchfor"] . "\", \"" . $_GET["searchon"][0] . "\", \"" . $_GET["category"] . "\")'>
	} 

	function manage(title, author, price){
		var shoppingCart = [title, author, price];
		window.location.href="shopping_cart.php?shoppingCart="+shoppingCart;
	}
	//write another function that when click addToCart, add values to the array.
	</script>
</head>
<body>
<?php
$user = 'root';
$pass = '';
$db = 'bookstore471';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

if (mysqli_connect_errno()) {
  echo "not connected! ".$db->error;
  echo $db->error;
}

$que = "";
//Search on title
if(strcmp($_GET['searchon'][0], 'title') == 0){
	$que = "SELECT * FROM book JOIN writtenby ON book.ISBN = writtenby.ISBN JOIN author ON writtenby.AuthorID = author.ID JOIN workswith ON author.ID = workswith.AuthorID JOIN publisher on workswith.PublisherID = publisher.ID
	WHERE book.TITLE = " . "'" . $_GET['searchfor'] . "'";
}
//Search on author
if(strcmp($_GET['searchon'][0], 'author') == 0){
	$author = explode(" " , $_GET['searchfor']);
	$que = "SELECT * FROM book JOIN writtenby ON book.ISBN = writtenby.ISBN JOIN author ON writtenby.AuthorID = author.ID JOIN workswith ON author.ID = workswith.AuthorID JOIN publisher on workswith.PublisherID = publisher.ID
	WHERE author.Fname = '" .  $author[0] . "' AND "  . "author.Lname = '" . $author[1] . "'";
}
//Search on publisher
if(strcmp($_GET['searchon'][0], 'publisher') == 0){
	$que = "SELECT * FROM book JOIN writtenby ON book.ISBN = writtenby.ISBN JOIN author ON writtenby.AuthorID = author.ID JOIN workswith ON author.ID = workswith.AuthorID JOIN publisher on workswith.PublisherID = publisher.ID
	WHERE publisher.Name = " . "'" . $_GET['searchfor'] . "'";
}
//Search on ISBN
if(strcmp($_GET['searchon'][0], 'keyword') == 0){
	$que = "SELECT * FROM book JOIN writtenby ON book.ISBN = writtenby.ISBN JOIN author ON writtenby.AuthorID = author.ID JOIN workswith ON author.ID = workswith.AuthorID JOIN publisher on workswith.PublisherID = publisher.ID
	WHERE book.ISBN = " . "'" . $_GET['searchfor'] . "'";
}
//Search on Keyword
if(strcmp($_GET['searchon'][0], 'anywhere') == 0){
	$que = "SELECT * FROM book JOIN writtenby ON book.ISBN = writtenby.ISBN JOIN author ON writtenby.AuthorID = author.ID JOIN workswith ON author.ID = workswith.AuthorID JOIN publisher on workswith.PublisherID = publisher.ID
	WHERE book.ISBN LIKE '%" . $_GET['searchfor'] . "%' OR book.title LIKE '%" . $_GET['searchfor'] . "%' OR author.Fname LIKE '%" . $_GET['searchfor'] . "%' OR author.Lname LIKE '%" . $_GET['searchfor'] . "%' OR publisher.Name LIKE '%" . $_GET['searchfor'] . "%'";
}

//Add category to query string
//Nothing will be added if all is selected
if($_GET['category'] == 1){
	$que .= " AND book.genre = 'Fantasy'";
}
if($_GET['category'] == 2){
	$que .= " AND book.genre = 'Adventure'";
}
if($_GET['category'] == 3){
	$que .= " AND book.genre = 'Fiction'";
}
if($_GET['category'] == 4){
	$que .= " AND book.genre = 'Horror'";
}
echo $que;
?>


<table align="center" style="border:1px solid blue;">
<tr>
	<td align="left">
		<h6> <fieldset>Your Shopping Cart has 0 items</fieldset> </h6>
	</td>
	<td>
		&nbsp
	</td>
	<td align="right">
		<form action="shopping_cart.php" method="post">
			<input type="submit" value="Manage Shopping Cart">
		</form>
	</td>
</tr>	
<tr>
<td style="width: 350px" colspan="3" align="center">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">
	<table>
	
<?php
if(strcmp($que, "") != 0){
	$res = mysqli_query($db, $que);
	if ($res==null) echo "<p>nothing returned</p>";//error checking
	if ($res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			echo "<tr><td align='left'><button name='btnCart' id='btnCart' 
			onClick='manage(\"" . $row["Title"] . "\", \"" . $row["Fname"] . " " . $row["Lname"] . "\", \"" . $row["Price"] . "\")'> 
			Add to Cart </button></td><td rowspan='2' align='left'>" . $row["Title"] . "</br>By " . $row["Fname"] . $row["Lname"] . "</br><b>Publisher:</b> " . $row["Name"] . " </br><b>ISBN:</b> " . $row["ISBN"] . "</t> <b>Price:</b> " . $row["Price"] . "</td></tr><tr><td align='left'><button name='review' id='review' onClick='review(\"" . $row["ISBN"] . "\", \"" . $row["Title"] . "\")'>Reviews</button></td></tr>";
		}
	} else {
		echo "<tr><td>0 results</td><tr>";
	}
}
  ?>
			</div>
			
			</td>
		</tr>
		<tr>
			<td align= "center">
				<form action="confirm_order.php" method="get">
					<input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
				</form>
			</td>
			<td align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="New Search">
				</form>
			</td>
			<td align="center">
				<form action="index.php" method="post">
					<input type="submit" name="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>