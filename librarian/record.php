<?php
session_start();
$login_id = $_SESSION["id"];
if($login_id == NULL){
  header("Location: /library/"); /* Redirect browser */
  exit();
}
$record_id=$_REQUEST['record_id'];
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
  <a class="active" href="recordlist.php">Records</a>
  <a href="memberlist.php">Members</a>
  <a href="librarianlist.php">Librarians</a>
  <a href="addlibrarian.php">Add Librarian</a>
  <a href="changepassword.php">Password</a>
  <a onclick="confirmlogout()">Log out</a>
</div>

<div class="background-image">

<div class="content">
  <br>
  <h1>Record's Details</h1>
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

    $query = "SELECT record.id, record.book_id, book.name, record.member_id, record.issue_date, record.return_date, record.returned
              FROM record
              INNER JOIN book ON record.book_id=book.id
              WHERE record.id='$record_id';";

    // execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);

        while ( $row = mysqli_fetch_row( $result ) )
        {
          $record_id=$row[0];
          $book_id=$row[1];
          $book_name=$row[2];
          $member_id=$row[3];
          $issue_date=$row[4];
          $return_date=$row[5];
          $returned=$row[6];
        } 
      ?>
        <form method=post action=processReturn.php onload="checkReturned()" onsubmit="return confirm('Do you confirm to return this book?')">
        <table>
    <tr><td class="field">&nbsp;&nbsp;Record ID:&nbsp;</td>
		<td><input type="text" id="record_id" name="record_id" value="<?php echo $record_id ?>" readonly>
		<tr><td class="field">&nbsp;&nbsp;Book ID:&nbsp;</td>
		<td><input type="text" id="book_id" name="book_id" value="<?php echo $book_id ?>" readonly>
		<tr><td class="field">&nbsp;&nbsp;Book Name:&nbsp;</td>
		<td><input type="text" id="book_name" name="book_name" value="<?php echo $book_name ?>" readonly>
    <tr><td class="field">&nbsp;&nbsp;Member ID:&nbsp;</td>
		<td><input type="text" id="member_id" name="member_id" value="<?php echo $member_id ?>" readonly>
		<tr><td class="field">&nbsp;&nbsp;Issue Date:&nbsp;</td>
		<td><input type="text" id="issue_date" name="issue_date" value="<?php echo $issue_date ?>" readonly>
		<tr><td class="field">&nbsp;&nbsp;Return Date:&nbsp;</td>
		<td><input type="text" id="return_date" name="return_date" value="<?php echo $return_date ?>" readonly>
		<tr><td class="field">&nbsp;&nbsp;Returned:&nbsp;</td>
		<td><input type="text" id="returned" name="returned" value="<?php if($returned==1){ echo "Yes";} else{ echo "No";} ?>" readonly>
		</table>
		<br>
          <?php
            if($returned==0){
                echo '<button type="submit" id="btn_returnBook">Member returned this book</button>';
            }
          ?>
          
      </form>
	  
  </div>
	  
</div>

</div>
</body>
</html>
