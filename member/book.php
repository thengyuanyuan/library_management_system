<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/"); /* Redirect browser */
  exit();
}
$book_id=$_REQUEST['book_id'];
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
  <h1>Book's Details</h1>
  <br>

<div class="box bookdetailsbox">

  <?php 
    // connect the MySQL server
		if(!($connection = mysqli_connect("localhost", "root", "")))	
    die( "Could not connect to database </body></html>" );

    // access the database
    if ( !mysqli_select_db($connection, "library") )
    die( "Could not open library database </body></html>" );

    $query = "SELECT * FROM book WHERE id='$book_id';";

    // execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);

        while ( $row = mysqli_fetch_row( $result ) )
        {
          $book_id=$row[0];
          $book_name=$row[1];
          $author=$row[2];
          $quantity=$row[3];
        } 
      ?>
        <form method=post action=processIssue.php onsubmit="return confirm('Do you confirm to issue this book?')">
          <table>
		  <tr><td class="field">&nbsp;&nbsp;Book ID:&nbsp;</td>
		  <td><input type="text" id="book_name" name="book_id" value="<?php echo $book_id ?>" readonly></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Book Name:&nbsp;</td>
		  <td><input type="text" id="book_name" name="book_name" value="<?php echo $book_name ?>" readonly></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Author:&nbsp;</td>
		  <td><input type="text" id="author" name="author" value="<?php echo $author ?>" readonly></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Quantity:&nbsp;</td>
		  <td><input type="text" id="quantity" name="quantity" value="<?php echo $quantity ?>" readonly></td></tr>
		  </table>
		  <br>
          <?php
            if($quantity>0){
              echo '<button type="submit" id="btn_issueBook">Issue this book</button>';
            }else{
              echo '<p>Sorry, this book is not available for now.</p>';
            }
          ?>
      </form>

</div>

</div>

</div>
</body>
</html>
