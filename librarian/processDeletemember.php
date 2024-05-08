<!DOCTYPE html>
<html>
	<body>
		<?php
		session_start();
		$login_id = $_SESSION["id"];
		$member_id=$_SESSION['member_id'];
		if($login_id == NULL){
		  header("Location: /library/"); /* Redirect browser */
		  exit();
		}
		// connect the MySQL server
		if(!($connection = mysqli_connect("localhost", "root", "")))	
			die( "Could not connect to database </body></html>" );

		// access the database
		 if ( !mysqli_select_db($connection, "library") )
			die( "Could not open library database </body></html>" );

		extract($_POST);	
		// build the query to delete data into member table
		$query = "DELETE FROM member WHERE id='$member_id';";
        
		// execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);
		?>

    <script>
        alert("Member Deleted Successfully!");
        window.location ='memberlist.php';
    </script>
	</body>
</html>