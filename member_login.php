<?php
    session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Member Login for Library Management system</title>		
	</head>
	
	<body>
	<div class="background-image">
	
	<br><br>
	<div class="box memberloginbox">
	Member Login<br><br>
	
	<form method=post action=m_login_process.php enctype="multipart/form-data">	
    <table>
    <tr><td class="field">&nbsp;&nbsp;ID/Email:&nbsp;</td><td><input id=textboxid type=text name=id_email required></td></tr>
      <tr><td class="field">&nbsp;&nbsp;Password:&nbsp;</td><td><input id=textboxid type=password name=pass required></td></tr>
	</table>
	 <br><input id=button type=submit name=login value="LOGIN">
   </form>
   
   <br>
   <p class="tips">Don't have an account?</p>
   <a href="member_signup.php">
   <button id=button>SIGN UP</button>
   </a>
	
	</div>
	</body>
	
</html>