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
    <a class="active" href="recordlist.php">Records</a>
	<a href="changepassword.php">Password</a>
    <a onclick="confirmlogout()">Log out</a>
  </div>
  
<div class="background-image">

<div class="content">
  <br>
  <h1>Your Issue Records</h1>
  <br>

  <form class="search" method="post">
    <select id="searchop" name="search_option" onchange="setPlaceholder()">
      <option value="book_name">Book Name</option>
      <option value="record_id">Record ID</option>
      <option value="book_id">Book ID</option>
      <option value="issue_date">Issue Date</option>
      <option value="return_date">Return Date</option>
    </select>
    <input type="text" id="searchbar" name="search_text" placeholder="Search..">
    <input type="submit" name="submit" value="Search">
    <br><br>
</form>

  <div class="box issuerecordbox">

  <?php 
     //connection
     $conn = new mysqli("localhost","root","","library");

     //check connection
     if ($conn->connect_error){
       die("Connection failed: ".$conn->connect_error);
     }

         //prepare and bind
    if(isset($_POST["submit"])){
      $search_option = $_POST["search_option"];
      $search_text = $_POST["search_text"];
      $search_text1 = $search_text.'%';
      $search_text2 = '%'.$search_text.'%';
      $search_text3 = '%'.$search_text;
      
      if ($search_option=="issue_date"||$search_option=="return_date"){
        if ($search_option=="issue_date"){
          $stmt = $conn->prepare("SELECT record.id, record.book_id, book.name, record.issue_date, record.return_date, record.returned
              FROM record
              INNER JOIN book ON record.book_id=book.id
              WHERE member_id = '$login_id'
              AND issue_date = ?;");
        }else{
          $stmt = $conn->prepare("SELECT record.id, record.book_id, book.name, record.issue_date, record.return_date, record.returned
              FROM record
              INNER JOIN book ON record.book_id=book.id
              WHERE member_id = '$login_id'
              AND return_date = ?;");
        }
        $stmt->bind_param("s",  $search_text);
      }else{
        if($search_option=="book_name"){
          $stmt = $conn->prepare("SELECT record.id, record.book_id, book.name, record.issue_date, record.return_date, record.returned
              FROM record
              INNER JOIN book ON record.book_id=book.id
              WHERE member_id = '$login_id'
              AND (book.name LIKE ?
              OR book.name LIKE ?
              OR book.name LIKE ?);");
        }else if ($search_option=="record_id"){
          $stmt = $conn->prepare("SELECT record.id, record.book_id, book.name, record.issue_date, record.return_date, record.returned
              FROM record
              INNER JOIN book ON record.book_id=book.id
              WHERE member_id = '$login_id'
              AND (record.id LIKE ?
              OR record.id LIKE ?
              OR record.id LIKE ?);");
        }else if ($search_option=="book_id"){
          $stmt = $conn->prepare("SELECT record.id, record.book_id, book.name, record.issue_date, record.return_date, record.returned
              FROM record
              INNER JOIN book ON record.book_id=book.id
              WHERE member_id = '$login_id'
              AND (book.id LIKE ?
              OR book.id LIKE ?
              OR book.id LIKE ?);");
        } 
        $stmt->bind_param("sss",  $search_text1, $search_text2, $search_text3);
      }
      
    }else{
      $stmt = $conn->prepare("SELECT record.id, record.book_id, book.name, record.issue_date, record.return_date, record.returned
          FROM record
          INNER JOIN book ON record.book_id=book.id
          WHERE member_id = '$login_id'
          ORDER BY ID DESC;");
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    $conn->close();

    if (mysqli_num_rows($result)==0) {
      echo "Sorry, no record found.";
    }else{
      echo "<table class = 'recordlist'>";
      echo "<tr>
        <th>&nbsp;&nbsp;&nbsp;Record ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;Book ID&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;Book Name&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;Issue date&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;Return date&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;Returned</th>
        <th></th>
        </tr>";
      while ( $row = $result->fetch_array(MYSQLI_NUM) )
      {
        echo "
        <tr>
        <td><a href='record.php?record_id=$row[0]'>$row[0]</a></td>
        <td><a href='book.php?book_id=$row[1]'>$row[1]</a></td>
        <td>$row[2]</td>
        <td>$row[3]</td>
        <td>$row[4]</td>
        <td>";
        if($row[5]==1){
          echo "Yes";
        }else{
          echo "No";
        }
        echo "</td>
        </tr>
        ";
      } 

      echo "</table>";
    }
    

  ?>
  
  </div>
  
</div>

</div>
</body>
</html>
