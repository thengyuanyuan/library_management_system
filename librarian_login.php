<?php
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Librarian Login for Library Management system</title>		
	</head>
	
	<body>
	<div class="background-image">
	
	<br><br>
	<div class="box librarianloginbox">
	Librarian Login<br><br>
	
	<form method=post action="librarian_login_process.php" enctype="multipart/form-data">	
    <table>
    <tr><td class="field">&nbsp;&nbsp;ID/Email:&nbsp;</td><td><input id=textboxid type=text name=email_id required></td></tr>
      <tr><td class="field">&nbsp;&nbsp;Password:&nbsp;</td><td><input id=textboxid type=password name=pass required></td></tr>
	</table>
	 <br><input id=button type=submit name=login value="LOGIN">
   </form>   
	
	</div>
	</body>
	
</html>