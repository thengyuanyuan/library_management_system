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
	<body>
		<?php
		//connection
		$conn = new mysqli("localhost","root","","library");

		//check connection
		if ($conn->connect_error){
		  die("Connection failed: ".$conn->connect_error);
		}

		extract($_POST);	

		//prepare and bind
		$stmt = $conn->prepare("INSERT INTO book (name, author, quantity) 
								VALUES(?,?,?);");
		$stmt->bind_param("ssi",  $name, $author, $quantity);

		$stmt->execute();
		$result = $stmt->get_result();

		$stmt->close();
		$conn->close();
		?>

    <script>
        alert("Book Added Successfully!");
        window.location ='booklist.php';
    </script>
	</body>
</html>