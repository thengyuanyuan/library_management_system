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

		// build the query to select data into librarian table
		$query = "SELECT password FROM librarian WHERE id='$login_id'";
        
		// execute the query
		if ( !( $result = mysqli_query($connection, $query) ) ) {
			echo "<p>Could not execute query!</p>" ;
			die(mysqli_error($connection) . "</body></html>" );
		} 
		// disconnect from the server
		mysqli_close( $connection);

        while ( $row = mysqli_fetch_row( $result ) )
        {
            $curpass = $row[0];
        } 

        if($oldpass1!=$oldpass2){
            echo '<script>
                alert("You have entered different password.");
                window.location ="changepassword.php";
            </script>';
        }else if($oldpass1!=$curpass){
            echo '<script>
                alert("You have entered wrong password.");
                window.location ="changepassword.php";
            </script>';
        }else if($curpass==$newpass){
            echo '<script>
                alert("The new password and current password cannot be the same.");
                window.location ="changepassword.php";
            </script>';
        }else if($oldpass1==$curpass){

            // connect the MySQL server
            if(!($connection = mysqli_connect("localhost", "root", "")))	
                die( "Could not connect to database </body></html>" );

            // access the database
            if ( !mysqli_select_db($connection, "library") )
                die( "Could not open library database </body></html>" );

            extract($_POST);	

            // build the query to select data into librarian table
            $query = "UPDATE librarian SET password = '$newpass' WHERE id='$login_id'";
            
            // execute the query
            if ( !( $result = mysqli_query($connection, $query) ) ) {
                echo "<p>Could not execute query!</p>" ;
                die(mysqli_error($connection) . "</body></html>" );
            } 
            // disconnect from the server
            mysqli_close( $connection);

            echo '<script>
                alert("Password changed successfully.");
                window.location ="changepassword.php";
            </script>';
        }
		?>
	</body>
</html>