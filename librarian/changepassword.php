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
  <a href="home.php">Home</a>
  <a href="profile.php">Profile</a>
  <a href="booklist.php">Books</a>
  <a href="addbook.php">Add Book</a>
  <a href="recordlist.php">Records</a>
  <a href="memberlist.php">Members</a>
  <a href="librarianlist.php">Librarians</a>
  <a href="addlibrarian.php">Add Librarian</a>
  <a class="active" href="changepassword.php">Password</a>
  <a onclick="confirmlogout()">Log out</a>
</div>

<div class="background-image">

<div class="content">
  <br>
  <h1>Change Your Password</h1>
  <br>
  
  <div class="box changepasswordbox">
  <br>
    <form action="processChangepassword.php" method="post">
        <table>
            <tr>
            <td class="field">&nbsp;&nbsp;Enter Current Password:&nbsp;</td>
            <td> <input type="password" id="textboxid" name="oldpass1" required> </td>
            </tr>
            <tr>
            <td class="field">&nbsp;&nbsp;Re-enter Current Password:&nbsp;</td>
            <td> <input type="password" id="textboxid" name="oldpass2" required> </td>
            </tr>
            <tr>
            <td class="field">&nbsp;&nbsp;Enter New Password:&nbsp;</td>
            <td> <input type="password" id="textboxid" name="newpass" required> </td>
        </table>
        <br><input id=button type=submit value="CHANGE PASSWORD">
         <input id=button type=reset value=CLEAR>
  </div>

</div>

</div>
</body>
</html>