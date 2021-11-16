
<!DOCTYPE HTML>
<head>
	<title>Shopping Cart</title>
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

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$book_quantity = [];
$book1 = $params['shoppingCart'];
$book_arr = (explode(",",$book1));


for ($x = 0; $x < count($book_arr); $x+=4) {
	$que = "SELECT Qty FROM book WHERE book.ISBN = $book_arr[$x]";
	if(strcmp($que, "") != 0){
		$res = mysqli_query($db, $que);
		if ($res != null and $res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				array_push($book_quantity, $row['Qty']);
		}
  	}
	}
}


?>

	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
				<input type="submit" onclick="toCheckout()" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
			</td>
			<td align="center">
				<input type="submit" onClick='newSearch()' name="search" id="search" value="New Search">							
			</td>
			<td align="center">
				<form id="exit" action="index.php" method="post">
					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
				</form>					
			</td>
		</tr>

		<tr>
			

			<td  colspan='3'>
			<div id='bookdetails' style='overflow:scroll;height:180px;width:400px;border:1px solid black;'>
			<table align='center' BORDER='2' CELLPADDING='2' CELLSPACING='2' WIDTH='100%'>
			<?php
			if(count($book_arr) > 1){
				for ($x = 0; $x < count($book_arr); $x+=4) {
					echo "<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>";
					echo "<tr>";
					echo "<td><button name='delete' id='delete' onClick='del($book_arr[$x]);'>Delete Item</button></td>";
					echo "<td>" . $book_arr[$x+1] . "</br><b>By</b> " . $book_arr[$x+2] . "</br></td>";
					echo "</br>";
					echo "<td>";
					echo "<input class='quantity' name='quantityBook' placeholder='1' value='1' size='1' />";
					echo "</td>";
					echo "<td class='price'>" . $book_arr[$x+3] .  "</td>";
					echo "<td></td>";
					echo "</tr>";
					}
			}
								?>
				</table>
				</div>
				</td>

		</tr>

		<tr>


			<td align="center">			
					<input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment" onclick="calculateSubtotal()">
				
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center" id="total"></td>
		</tr>
	</table>
</body>
<script>
var shoppingCart = "<?php echo $_GET["shoppingCart"]; ?>";
var quantityDB = <?php echo json_encode($book_quantity); ?>;

function toCheckout(){
	window.location.href="confirm_order.php?shoppingcart=" + shoppingCart;
}

function newSearch(){
	window.location.href="screen2.php?shoppingcart=" + shoppingCart;
}

function calculateSubtotal(){
	var passedArray = <?php echo json_encode($book_arr); ?>;
	var total = 0;
	var quantityWeb = document.getElementsByClassName('quantity');
	var books = document.getElementsByClassName("price");
	for(var i = 0; i < books.length; i++){
		if (parseInt(quantityDB[i]) < parseInt(quantityWeb[i].value)){
			alert("Too many copies of " + passedArray[i+1] + ".  Please select a new quantity.");
		} else {
			total += parseFloat(books[i].innerHTML) * parseFloat(quantityWeb[i].value);
		}
	}
	document.getElementById("total").innerHTML = "Subtotal: " + Math.round(100*total)/100;

}
calculateSubtotal();

function del(isbn){
		var passedArray = <?php echo json_encode($book_arr); ?>;
		var urlArray = "";
		var quantityWebCollection = document.getElementsByClassName('quantity');
		var quantityWeb = [];
		//Convert HTML collection to Array
		for(var x = 0; x < quantityWebCollection.length; x++){
			quantityWeb.push(quantityWebCollection[x].value);
		}
		console.log(passedArray.length);
		//Remove Deleted item from shopping cart and it's associated qty 
		for(var i = 0; i < passedArray.length; i++){
			if (passedArray[i]==isbn){
				passedArray.splice(i, 4);
				quantityWeb.splice(i/4, 1);
			}
		}

		console.log(passedArray);
		console.log(quantityWeb);
		//Set up shopping cart to put in url
		for(var j = 0; j < passedArray.length; j++){
			if (j < passedArray.length - 1){
				urlArray+=passedArray[j]+",";
			}
    		else {
				urlArray+=passedArray[j];
			}
		}

		//Set up quantity to put in url
		var urlQuantity = quantityWeb.toString();

		window.location.href="shopping_cart.php?shoppingCart="+urlArray + "&quantity=" + urlQuantity;
	}


</script>
