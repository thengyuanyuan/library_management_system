<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/"); /* Redirect browser */
  exit();
}
$book_id=$_REQUEST['book_id'];
$_SESSION['book_id'] = $book_id;
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
  <h1>Book's Details</h1>
  <br>
  
  <div class="box bookdetailsbox">
  <br>
  
  <?php 
    //connection
    $conn = new mysqli("localhost","root","","library");

    //check connection
    if ($conn->connect_error){
      die("Connection failed: ".$conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM book WHERE id=?;");
    $stmt->bind_param("s",  $book_id);

    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    $conn->close();

        while ( $row = $result->fetch_array(MYSQLI_NUM) )
        {
          $book_id=$row[0];
          $book_name=$row[1];
          $author=$row[2];
          $quantity=$row[3];
        } 
      ?>
        <form method=post action=processEditbook.php onsubmit="return confirm('Do you confirm to edit this book?')">
          <table>
		  <tr><td class="field">&nbsp;&nbsp;Book ID:&nbsp;</td>
		  <td><input type="text" id="book_id" name="book_id" value="<?php echo $book_id ?>" readonly></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Book Name:&nbsp;</td>
		  <td><input type="text" id="book_name" name="book_name" value="<?php echo $book_name ?>" readonly required></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Author:&nbsp;</td>
		  <td><input type="text" id="author" name="author" value="<?php echo $author ?>" readonly required></td></tr>
		  <tr><td class="field">&nbsp;&nbsp;Quantity:&nbsp;</td>
		  <td><input type="text" id="quantity" name="quantity" value="<?php echo $quantity ?>" readonly required></td></tr>
		  </table>
		  <br>
          <button type="button" id="btn_edit" onclick="edit()">Edit</button>
          <button type="submit" id="btn_save" style="display: none;" value="Submit">Save</button>
          <button type="reset" id="btn_cancel" style="display: none;" onclick="cancel()" value="Reset">Cancel</button>
          <button type="button" id="btn_delete" style="display: none;" onclick="deleteBook()">Delete</button>
        </form>
		
  </div>
		
</div>
    <script>
      function edit(){
        document.getElementById("book_name").readOnly = false;
        document.getElementById("author").readOnly = false;
        document.getElementById("quantity").readOnly = false;
        document.getElementById("btn_edit").style.display = "none";
        document.getElementById("btn_save").style.display = "inline";
        document.getElementById("btn_cancel").style.display = "inline";
        document.getElementById("btn_delete").style.display = "inline";
      }
      function cancel(){
        document.getElementById("book_name").readOnly = true;
        document.getElementById("author").readOnly = true;
        document.getElementById("quantity").readOnly = true;
        document.getElementById("btn_edit").style.display = "block";
        document.getElementById("btn_save").style.display = "none";
        document.getElementById("btn_cancel").style.display = "none";
        document.getElementById("btn_delete").style.display = "none";
      }
      function deleteBook(){
        if (confirm("Are you sure to delete this book?")==true){
          window.location ='processDeletebook.php';
        }
      }
    </script>

</div>
</body>
</html>
