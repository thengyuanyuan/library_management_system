<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/"); /* Redirect browser */
  exit();
}
$librarian_id=$_REQUEST['librarian_id'];
$_SESSION['librarian_id'] = $librarian_id;
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
    <a href="booklist.php">Books</a>
    <a href="addbook.php">Add Book</a>
    <a href="recordlist.php">Records</a>
    <a href="memberlist.php">Members</a>
    <a class="active" href="librarianlist.php">Librarians</a>
    <a href="addlibrarian.php">Add Librarian</a>
	<a href="changepassword.php">Password</a>
    <a onclick="confirmlogout()">Log out</a>
  </div>

<div class="background-image">

<div class="content">
  <br>
  <h1>Librarian's Details</h1>
  <br>
  
  <div class="box bookdetailsbox">
  <br>

  <?php 
    // connect the MySQL server
		if(!($connection = mysqli_connect("localhost", "root", "")))	
    die( "Could not connect to database </body></html>" );

    // access the database
    if ( !mysqli_select_db($connection, "library") )
    die( "Could not open library database </body></html>" );

    $query = "SELECT id, name, email, phone FROM librarian WHERE id='$librarian_id';";

    // execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);

        while ( $row = mysqli_fetch_row( $result ) )
        {
          $librarian_id=$row[0];
          $librarian_name=$row[1];
          $email=$row[2];
          $phone=$row[3];
        } 
      ?>
		  <table>
		  <tr><td class="field">&nbsp;&nbsp;Librarian ID:&nbsp;</td>
		  <td id=info><?php echo $librarian_id ?></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Librarian Name:&nbsp;</td>
		  <td id=info><?php echo $librarian_name ?></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Email:&nbsp;</td>
		  <td id=info><?php echo $email ?></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Phone:&nbsp;</td>
		  <td id=info><?php echo $phone ?></td></tr>
		  </table>
          <br>
</div>

  </div>

</div>
</body>
</html>
