<!DOCTYPE html>
<html>
	<body>
		<?php
		session_start();
		$login_id = $_SESSION["id"];
		if($login_id == NULL){
		  header("Location: /library/"); /* Redirect browser */
		  exit();
		}
		//connection
		$conn = new mysqli("localhost","root","","library");

		//check connection
		if ($conn->connect_error){
		  die("Connection failed: ".$conn->connect_error);
		}

		extract($_POST);	

		//prepare and bind
		$stmt = $conn->prepare("UPDATE book SET name = ?, author = ?, quantity = ? WHERE id=?;");
		$stmt->bind_param("ssis",  $book_name, $author, $quantity, $book_id);

		$stmt->execute();
		$result = $stmt->get_result();

		$stmt->close();
		$conn->close();
		?>
    <script>
        alert("Book Edited Successfully!");
        window.location ='book.php?book_id=<?php echo "$book_id"?>';
    </script>
	</body>
</html>