<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/"); /* Redirect browser */
  exit();
}
$member_id=$_REQUEST['member_id'];
$_SESSION['member_id'] = $member_id;
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
    <a class="active" href="memberlist.php">Members</a>
    <a href="librarianlist.php">Librarians</a>
    <a href="addlibrarian.php">Add Librarian</a>
	<a href="changepassword.php">Password</a>
    <a onclick="confirmlogout()">Log out</a>
  </div>

<div class="background-image">

<div class="content">
  <br>
  <h1>Member's Details</h1>
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

    $query = "SELECT id, name, email, phone FROM member WHERE id='$member_id';";

    // execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);

        while ( $row = mysqli_fetch_row( $result ) )
        {
          $member_id=$row[0];
          $member_name=$row[1];
          $email=$row[2];
          $phone=$row[3];
        } 
      ?>
        <form method=post action=processEditmember.php onsubmit="return confirm('Do you confirm to edit this member?')">
          <table>
		  <tr><td class="field">&nbsp;&nbsp;Member ID:&nbsp;</td>
		  <td><input type="text" id="member_id" name="member_id" value="<?php echo $member_id ?>" readonly></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Member Name:&nbsp;</td>
		  <td><input type="text" id="member_name" name="member_name" value="<?php echo $member_name ?>" readonly required></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Email:&nbsp;</td>
		  <td><input type="text" id="email" name="email" value="<?php echo $email ?>" readonly required></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Phone:&nbsp;</td>
		  <td><input type="text" id="phone" name="phone" value="<?php echo $phone ?>" readonly required></td></tr>
		  </table>
		  <br>
          <button type="button" id="btn_edit" onclick="edit()">Edit</button>
          <button type="submit" id="btn_save" style="display: none;" value="Submit">Save</button>
          <button type="reset" id="btn_cancel" style="display: none;" onclick="cancel()" value="Reset">Cancel</button>
          <button type="button" id="btn_delete" style="display: none;" onclick="deleteMember()">Delete</button>
        </form>
		
</div>

</div>
    <script>
      function edit(){
        document.getElementById("member_name").readOnly = false;
        document.getElementById("email").readOnly = false;
        document.getElementById("phone").readOnly = false;
        document.getElementById("btn_edit").style.display = "none";
        document.getElementById("btn_save").style.display = "inline";
        document.getElementById("btn_cancel").style.display = "inline";
        document.getElementById("btn_delete").style.display = "inline";
      }
      function cancel(){
        document.getElementById("member_name").readOnly = true;
        document.getElementById("email").readOnly = true;
        document.getElementById("phone").readOnly = true;
        document.getElementById("btn_edit").style.display = "block";
        document.getElementById("btn_save").style.display = "none";
        document.getElementById("btn_cancel").style.display = "none";
        document.getElementById("btn_delete").style.display = "none";
      }
      function deleteMember(){
        if (confirm("Are you sure to delete this member?")==true){
          window.location ='processDeletemember.php';
        }
      }
    </script>

</div>
</body>
</html>
