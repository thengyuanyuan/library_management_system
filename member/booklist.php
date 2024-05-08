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
  <a class="active" href="booklist.php">Books</a>
  <a href="recordlist.php">Records</a>
  <a href="changepassword.php">Password</a>
  <a onclick="confirmlogout()">Log out</a>
</div>

<div class="background-image">

<div class="content">
  <br>
  <h1>List of Books Available</h1>
  <br>
  <form class="search" method="post">
    <select name="search_option">
      <option value="name">Book Name</option>
      <option value="id">Book ID</option>
      <option value="author">Author</option>
      <option value="quantity">Quantity</option>
    </select>
    <input type="text" name="search_text" placeholder="Search..">
    <input type="submit" name="submit" value="Search">
    <br><br>
  </form>
  
<div class="box booklistbox">

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
      

      if ($search_option=="quantity"){
        $stmt = $conn->prepare("SELECT * FROM book 
            WHERE quantity>=1 
            AND (quantity = ?);");
        $stmt->bind_param("i",  $search_text);
      }else{
        if($search_option=="name"){
          $stmt = $conn->prepare("SELECT * FROM book 
              WHERE quantity>=1 
              AND (name LIKE ? 
              OR name LIKE ? 
              OR name LIKE ?);");
        }else if ($search_option=="id"){
          $stmt = $conn->prepare("SELECT * FROM book 
              WHERE quantity>=1 
              AND (id LIKE ? 
              OR id LIKE ? 
              OR id LIKE ?);");
        }else if ($search_option=="author"){
          $stmt = $conn->prepare("SELECT * FROM book 
              WHERE quantity>=1 
              AND (author LIKE ? 
              OR author LIKE ? 
              OR author LIKE ?);");
        } 
        $stmt->bind_param("sss",  $search_text1, $search_text2, $search_text3);
      }
      
    }else{
      $stmt = $conn->prepare("SELECT * FROM book WHERE quantity>=1 ORDER BY ID;");
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    $conn->close();
    
    if (mysqli_num_rows($result)==0) {
      echo "Sorry, no book found.";
    }else{
      echo "<table class = 'booklist'>";
      echo "<tr>
        <th>&nbsp;&nbsp;Book ID&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;Book Name&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;Author&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;Quantity&nbsp;&nbsp;</th>
        </tr>";

      while ( $row = $result->fetch_array(MYSQLI_NUM) )
      {
        echo "
        <tr>
        <td><a href='book.php?book_id=$row[0]'>$row[0]</a></td>
        <td>$row[1]</td>
        <td><a href='author.php?author=$row[2]'>$row[2]</a></td>
        <td>$row[3]</td>
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
