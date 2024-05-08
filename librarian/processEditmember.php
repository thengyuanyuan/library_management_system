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
		$stmt = $conn->prepare("UPDATE member SET name = ?, email = ?, phone = ? WHERE id=?;");
		$stmt->bind_param("ssss",  $member_name, $email, $phone, $member_id);

		$stmt->execute();
		$result = $stmt->get_result();

		$stmt->close();
		$conn->close();

		?>

    <script>
        alert("Member Edited Successfully!");
        window.location ='member.php?member_id=<?php echo "$member_id"?>';
    </script>
	</body>
</html>