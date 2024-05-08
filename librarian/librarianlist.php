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
  <a class="active" href="librarianlist.php">Librarians</a>
  <a href="addlibrarian.php">Add Librarian</a>
  <a href="changepassword.php">Password</a>
  <a onclick="confirmlogout()">Log out</a>
</div>

<div class="background-image">

<div class="content">
  <br>
  <h1>Librarian List</h1>
  <br>

  <form class="search" method="post">
    <select name="search_option">
      <option value="name">Librarian Name</option>
      <option value="id">Librarian ID</option>
      <option value="email">Email</option>
      <option value="phone">Phone</option>
    </select>
    <input type="text" name="search_text" placeholder="Search..">
    <input type="submit" name="submit" value="Search">
    <br><br>
  </form>

<div class="box librarianlistbox">

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
      
        if($search_option=="name"){
            $stmt = $conn->prepare("SELECT id, name, email, phone FROM librarian 
                WHERE (name LIKE ? 
                OR name LIKE ? 
                OR name LIKE ?);");
        }else if ($search_option=="id"){
            $stmt = $conn->prepare("SELECT id, name, email, phone FROM librarian 
                WHERE (id LIKE ? 
                OR id LIKE ? 
                OR id LIKE ?);");
        }else if ($search_option=="email"){
            $stmt = $conn->prepare("SELECT id, name, email, phone FROM librarian 
                WHERE (email LIKE ? 
                OR email LIKE ? 
                OR email LIKE ?);");
        }else if ($search_option=="phone"){
            $stmt = $conn->prepare("SELECT id, name, email, phone FROM librarian 
                WHERE (phone LIKE ? 
                OR phone LIKE ? 
                OR phone LIKE ?);");
        } 
        $stmt->bind_param("sss",  $search_text1, $search_text2, $search_text3);
      
    }else{
      $stmt = $conn->prepare("SELECT id, name, email, phone FROM librarian ORDER BY ID;");
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    $conn->close();
    
    if (mysqli_num_rows($result)==0) {
      echo "Sorry, no librarian found.";
    }else{
      echo "<table class = 'list'>";
      echo "<tr>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;Librarian ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;Librarian Name&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        </tr>";

      while ( $row = $result->fetch_array(MYSQLI_NUM) )
      {
        echo "
        <tr>
        <td><a href='librarian.php?librarian_id=$row[0]'>$row[0]</a></td>
        <td>$row[1]</td>
        <td><a href='mailto:$row[2]'>$row[2]</a></td>
        <td><a href='tel:$row[3]'>$row[3]</td>
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
