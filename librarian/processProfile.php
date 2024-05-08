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
		$stmt = $conn->prepare("UPDATE librarian SET name = ?, email = ?, phone = ? WHERE id=?;");
		$stmt->bind_param("ssss",  $name, $email, $phone, $librarian_id);

		$stmt->execute();
		$result = $stmt->get_result();

		$stmt->close();
		$conn->close();
		?>

    <script>
        alert("Profile Updated Successfully!");
        window.location ='profile.php';
    </script>
	</body>
</html>