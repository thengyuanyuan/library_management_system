<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
	</head>
	
	<body>
	
	<div class="background-image">
	
		<?php		
		session_start();
				
		if(isset($_POST['login']))
		{
			// connect the MySQL server
			if(!($connection = mysqli_connect("localhost", "root", "")))	
				die( "Could not connect to database </body></html>" );

			// access the database
			 if ( !mysqli_select_db($connection, "library") )
				die( "Could not open library database </body></html>" );
			
			extract($_POST);
			
			$sql=mysqli_query($connection, "SELECT * FROM member where (email='$id_email' or id='$id_email') and password='$pass'");
			$row=mysqli_fetch_array($sql);
			if(is_array($row))
			{
				$_SESSION["id"] = $row['id'];
				$_SESSION["name"]=$row['name'];
				$_SESSION["email"]=$row['email'];
				$_SESSION["phone"]=$row['phone']; 
				$_SESSION["pass"]=$row['pass'];
				header("Location: member/"); 
				exit;
			}
			else
			{
				echo '<script type="text/javascript">
				alert("Invalid Member ID/Email/Password");
				location.href = "/library/librarian";
				</script>';
			}
		}
		?>	
	</body>
</html>