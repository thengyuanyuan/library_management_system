<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/");
  exit();
}
$author=$_REQUEST['author'];
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
    <a href="home.php">Home</a>
    <a href="profile.php">Profile</a>
    <a class="active" href="booklist.php">Books</a>
    <a href="recordlist.php">Records</a>
	<a href="changepassword.php">Password</a>
    <a onclick="confirmlogout()">Log out</a>
  </div>

<div class="background-image">

<div class="content">
  <br>
  <h1><?php echo $author?>'s Book</h1>
  <br>

<div class="box authorbox">

  <?php 
    // connect the MySQL server
		if(!($connection = mysqli_connect("localhost", "root", "")))	
    die( "Could not connect to database </body></html>" );

    // access the database
    if ( !mysqli_select_db($connection, "library") )
    die( "Could not open library database </body></html>" );

    $query = "SELECT * FROM book WHERE author='$author' ORDER BY id;";

    // execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);

    echo "<table class = 'booklist'>";
    echo "<tr>
      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Book ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Book Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
      </tr>";

    while ( $row = mysqli_fetch_row( $result ) )
    {
      echo "
      <tr>
      <td><a href='book.php?book_id=$row[0]'>$row[0]</a></td>
      <td>$row[1]</td>
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
