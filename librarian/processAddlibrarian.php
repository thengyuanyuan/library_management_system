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
		$stmt = $conn->prepare("INSERT INTO librarian (name, email, phone, password) 
		VALUES(?,?,?,?);");
		$stmt->bind_param("ssss",  $name, $email, $phone, $phone);

		$stmt->execute();
		$result = $stmt->get_result();

		$stmt->close();
		$conn->close();
		?>

    <script>
        alert("LIbrarian Added Successfully! \nNote: The default password is set to the phone number.");
        window.location ='librarianlist.php';
    </script>
	</body>
</html>