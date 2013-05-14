<html>
<head>
	<title>setup</title>
</head>
<body>
	<p>Looks like you haven't setup a database yet. Set one up now?</p>
	<form action="setup.php" method="post">
		<div class="setup"><label for="server">Server: </label> <input type="text" value="" name="server" /></div>
		<div class="setup"><label for="username">Username: </label> <input type="text" value="" name="username" /></div>
		<div class="setup"><label for="password">Password: </label> <input type="text" value="" name="password" /></div>
		<div class="setup"><label for="database">Database: </label> <input type="text" value="" name="database" /></div>
		<div class="setup"><input type='submit' value="setup" /></div>
	</form>
</body>
</html>