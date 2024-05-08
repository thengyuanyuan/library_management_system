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
		// connect the MySQL server
		if(!($connection = mysqli_connect("localhost", "root", "")))	
			die( "Could not connect to database </body></html>" );

		// access the database
		 if ( !mysqli_select_db($connection, "library") )
			die( "Could not open library database </body></html>" );

		extract($_POST);	

		// build the query to insert data into member table
		$query = "INSERT INTO record (book_id, member_id, issue_date, return_date, returned) 
                    VALUES('$book_id','$login_id', CURRENT_DATE(), DATE_ADD(now(),interval 5 day), 'false');";

        
		// execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);
		?>

    <script>
        alert("Book Issued Successfully!");
        window.location ='book.php?book_id=<?php echo $book_id?>';
    </script>
	</body>
</html>