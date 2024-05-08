<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/"); /* Redirect browser */
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../homestyle.css">
<script src="../script.js"></script>

</head>
<body>
<div class="topbar">
  <a href="home.php">Library Management System</a>
</div>

<div class="sidebar">
  <a class="active" href="home.php">Home</a>
  <a href="profile.php">Profile</a>
  <a href="booklist.php">Books</a>
  <a href="recordlist.php">Records</a>
  <a href="changepassword.php">Password</a>
  <a onclick="confirmlogout()">Log out</a>
</div>

<div class="background-image">

<div class="content">
  <h3>Dear Member, take a look on</h3>
  <br>
  <h1>Our New Arrived Books</h1>
  <br>

<div class="box newarrivedbookbox">
  
  <?php 
    // connect the MySQL server
	if(!($connection = mysqli_connect("localhost", "root", "")))	
    die( "Could not connect to database </body></html>" );

    // access the database
    if ( !mysqli_select_db($connection, "library") )
    die( "Could not open library database </body></html>" );

    $query = "SELECT * FROM book WHERE quantity>=1 ORDER BY ID DESC LIMIT 5;";

    // execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);

    echo "<table class = 'booklist'>";
    echo "<tr>
      <th>&nbsp;&nbsp;&nbsp;Book ID&nbsp;&nbsp;&nbsp;</th>
      <th>&nbsp;&nbsp;&nbsp;Book Name&nbsp;&nbsp;&nbsp;</th>
      <th>&nbsp;&nbsp;&nbsp;Author&nbsp;&nbsp;&nbsp;</th>
      <th>&nbsp;&nbsp;&nbsp;Quantity&nbsp;&nbsp;&nbsp;</th>
      </tr>";

    while ( $row = mysqli_fetch_row( $result ) )
    {
      echo "
      <tr>
      <td><a href='book.php?book_id=$row[0]'>$row[0]</a></td>
      <td>$row[1]</td>
      <td><a href='author.php?author=$row[2]'>$row[2]</a></td>
      <td>$row[3]</td>
      </tr>
      ";
    } 

    echo "</table>"

  ?>

</div>

</div>

</div>
</body>
</html>

<!--
  https://www.codexworld.com/store-retrieve-image-from-database-mysql-php/
  -->