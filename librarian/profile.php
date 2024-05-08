<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/"); /* Redirect browser */
  exit();
}
?>

<!--session_start()
//On page 1
$_SESSION['login_id'] = $login_id;

//On page 2
$login_id = $_SESSION['login_id'];
-->

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
  <a class="active" href="profile.php">Profile</a>
  <a href="booklist.php">Books</a>
  <a href="addbook.php">Add Book</a>
  <a href="recordlist.php">Records</a>
  <a href="memberlist.php">Members</a>
  <a href="librarianlist.php">Librarians</a>
  <a href="addlibrarian.php">Add Librarian</a>
  <a href="changepassword.php">Password</a>
  <a onclick="confirmlogout()">Log out</a>
</div>

<div class="background-image">

<div class="content">
  <br>
  <h1>Your Profile</h1>
  <br>
  
  <div class="box profilebox">
  <br>
  <?php 
    // connect the MySQL server
		if(!($connection = mysqli_connect("localhost", "root", "")))	
    die( "Could not connect to database </body></html>" );

    // access the database
    if ( !mysqli_select_db($connection, "library") )
    die( "Could not open library database </body></html>" );

    $query = "SELECT * FROM librarian WHERE id = '$login_id';";

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
      $password=$row[1];
      $name=$row[2];
      $email=$row[3];
      $phone=$row[4];
    } 
  ?>
    <form method=post action=processProfile.php class="profile" onsubmit="return confirm('Do you really want to change profile information?')">
      <table>
	  <tr><td class="field">&nbsp;&nbsp;Librarian ID:&nbsp;</td>
	  <td><input type="text" id="librarian_id" name="librarian_id" value="<?php echo $librarian_id ?>" readonly></td></tr>
	  <tr><td class="field">&nbsp;&nbsp;Name:&nbsp;</td>
	  <td><input type="text" id="name" name="name" value="<?php echo $name ?>" readonly required>
	  <tr><td class="field">&nbsp;&nbsp;Email:&nbsp;</td>
	  <td><input type="text" id="email" name="email" value="<?php echo $email ?>" readonly required>
	  <tr><td class="field">&nbsp;&nbsp;Phone Nmber:&nbsp;</td>
	  <td><input type="text" id="phone" name="phone" value="<?php echo $phone ?>" readonly required>
	  </table>
	  <br>
      <button type="button" id="btn_editprofile" onclick="editProfile()">Edit</button>
      <button type="submit" id="btn_saveprofile" style="display: none;" value="Submit">Save</button>
      <button type="reset" id="btn_cancelprofile" style="display: none;" onclick="cancelProfile()" value="Reset">Cancel</button>
  </form>

</div>

</div>

</div>
    <script>
      function editProfile(){
        document.getElementById("name").readOnly = false;
        document.getElementById("email").readOnly = false;
        document.getElementById("phone").readOnly = false;
        document.getElementById("btn_editprofile").style.display = "none";
        document.getElementById("btn_saveprofile").style.display = "inline";
        document.getElementById("btn_cancelprofile").style.display = "inline";
      }
      function cancelProfile(){
        document.getElementById("name").readOnly = true;
        document.getElementById("email").readOnly = true;
        document.getElementById("phone").readOnly = true;
        document.getElementById("btn_editprofile").style.display = "block";
        document.getElementById("btn_saveprofile").style.display = "none";
        document.getElementById("btn_cancelprofile").style.display = "none";
      }
    </script>

</body>
</html>
