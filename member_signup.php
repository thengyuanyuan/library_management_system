<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Member Sign Up for Library Management system</title>		
	</head>
	
	<body>
	<div class="background-image">
	
	<br>
	<div class="box membersignupbox">
	Member Sign Up<br><br>
	
	<form method=post action=m_signup_process.php>	
    <table>
    <tr><td class="field">&nbsp;&nbsp;Name:&nbsp;</td><td><input id=textboxid type=text name=name required></td></tr>
      <tr><td class="field">&nbsp;&nbsp;Email:&nbsp;</td><td><input id=textboxid type=text name=email required></td></tr>
      <tr><td class="field">&nbsp;&nbsp;Phone:&nbsp;</td><td><input id=textboxid type=text name=phone required></td></tr>
      <tr><td class="field">&nbsp;&nbsp;Password:&nbsp;</td><td><input id=textboxid type=password name=pass required></td></tr>
	</table>
	 <br><input id=button type=submit value="SIGN UP">
     <input id=button type=reset value=CLEAR>
   </form>
  
   <br>
   <p class="tips">Already have an account?</p>
   <a href="member_login.php">
   <button id=button>LOGIN</button>
   </a>
   </div>
	
	</div>
	</body>
	
</html>