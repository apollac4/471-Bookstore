<?php
$user = 'root';
$pass = '';
$db = 'testdb2';

$db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");

if (mysqli_connect_errno()) echo "not connected! ".$db->error;

$que = "SELECT * FROM student";
$que1 = "SELECT * FROM books";

$res = mysqli_query($db, $que);
$res1 = mysqli_query($db, $que1);
if ($res==null || $res1==null) echo "<p>nothing returned</p>";//error checking
$out = mysqli_num_rows($res);
$out1 = mysqli_num_rows($res1);
if ($out==0 || $out1==0) echo "no rows";//error checking

if ($res->num_rows > 0) {
    // output data of each row
    echo "<h1>From the Student Table: </h1>";
    while($row = $res->fetch_assoc()) {
      echo "<p>id: " . $row["ID"]. " - Name: " . $row["Name"]. " " . "</p><br>";
    }
  } else {
    echo "0 results";
  }

  if ($res1->num_rows > 0) {
    // output data of each row
    echo "<h1>From the Book Table: </h1>";
    while($row = $res1->fetch_assoc()) {
      echo "<p>ISBM of Book: " . $row["ISBN"]. " - Title of Book: " . $row["Title"]. " " . "</p><br>";
    }
  } else {
    echo "0 results";
  }
?>