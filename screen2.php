
<!-- Figure 2: Search Screen by Alexander -->
<html>
<head>
	<title>SEARCH - 3-B.com</title>
</head>
<body>
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
				<td><input type="button" name="manage" value="Manage Shopping Cart" onclick="manage()"/></td>
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

var shoppingCart = "<?php echo $_GET['shoppingcart']; ?>";

function toResults(){
	var searchfor = document.getElementById("searchfor").value;
	var category = document.getElementById("category").value;
	var searchon = document.getElementById("searchon").value;
	
	window.location.href="screen3.php?searchfor=" + searchfor + "&category=" + category 
		+ "&searchon=" + searchon + "&shoppingcart=" + shoppingCart;
}

function manage(){
		window.location.href="shopping_cart.php?shoppingCart="+shoppingCart;
	}

</script>
</html>
