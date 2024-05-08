<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
	</head>
	
	<body>
	
	<div class="background-image">
	
		<?php		
		// connect the MySQL server
		if(!($connection = mysqli_connect("localhost", "root", "")))	
			die( "Could not connect to database </body></html>" );

		// access the database
		 if ( !mysqli_select_db($connection, "library") )
			die( "Could not open library database </body></html>" );
		
		extract($_POST);
		
		$sql=mysqli_query($connection, "SELECT * FROM member where email='$email'");
		if(mysqli_num_rows($sql)>0)
		{
			echo '<script type="text/javascript">
			alert("Email Already Exists, please use another email address or LOGIN your account.");
			location.href = "/library/member_signup.php";
			</script>';
		}
		else
		{
			$query="INSERT INTO member (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$pass')";
			
			// execute the query
			if ( !( $result = mysqli_query($connection, $query) ) ) {
				echo "<p>Error</p>" ;
				die(mysqli_error($connection) . "</body></html>" );
			}
		}	
		?>
		
		<br><br><h3>Sign Up Successful!</h3><br><br>
		<a href="member_login.php">
		<button id=button>Login Here</button>
		</a>
		</div>
		
	</body>
</html>