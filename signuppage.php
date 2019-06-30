	<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
<div class="header">
	<h2>Register</h2>
</div>
<form method="post" action="signup.php">
	

	<div class="input-group">
		<label>User Name</label>
		<input type="text" name="username" placeholder="username" ="">
	</div>
	

	<div class="input-group">
		<label>Registration Number</label>
		<input type="text" name="regNo" placeholder="Regno" value="">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" placeholder="Email" value="">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password" placeholder="enter your password">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="confpass" placeholder="Re enter the password">
	</div>
	<div class="input-group">
		<input type="submit" class="btn" name="register_btn" value="Register">
	</div>
	<p>
		Already a member? <a href="loginpage.php">Sign in</a>
	</p>
</form>
</body>
</html>