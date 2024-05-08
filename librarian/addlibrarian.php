<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/");
  exit();
}
?>

<!DOCTYPE HTML>
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
  <a href="librarianlist.php">Librarians</a>
  <a class="active" href="addlibrarian.php">Add Librarian</a>
  <a href="changepassword.php">Password</a>
  <a onclick="confirmlogout()">Log out</a>
</div>

<div class="background-image">

<div class="content">
	<br>
    <h1>Add Librarian</h1>
	<br>
	
	<div class="box addlibrarianbox">
	<br>
    <form action="processAddlibrarian.php" method="post">
        <table>
            <tr>
            <td class="field">&nbsp;&nbsp;Enter Librarian Name:&nbsp;</td>
            <td> <input type="text" id="textboxid" name="name" required> </td>
            </tr>
            <tr>
            <td class="field">&nbsp;&nbsp;Enter Email:&nbsp;</td>
            <td> <input type="text" id="textboxid" name="email" required> </td>
            </tr>
            <tr>
            <td class="field">&nbsp;&nbsp;Enter Phone number:&nbsp;</td>
            <td> <input type="number" id="textboxid" name="phone" required> </td>
        </table>
        <br><input id=button type=submit value="ADD">
         <input id=button type=reset value=CLEAR>
    </form>
	
	</div>
	
</div>

</div>
</body>
</html>