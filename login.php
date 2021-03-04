  
<?php
session_start();
	$host_heroku = "ec2-18-206-84-251.compute-1.amazonaws.com";
	$db_heroku = "d8k42dnhtd0o9i";
	$user_heroku = "crmjpgdtqgprga";
	$pw_heroku = "0d86d0fb5f24be75ffb6728bb2ffaa6762b75489e8923fda3cdf71c519a99d67";
	# Create connection to Heroku Postgres
	$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
	$pg_heroku = pg_connect($conn_string);

	if (!$pg_heroku)
	{
		die('Error: Could not connect: ' . pg_last_error());
	}
?>
<html>
<head>
	<title>Trang đăng nhập</title>
	<meta charset="utf-8">
</head>
<body>
	
	if (isset($_POST["btn_submit"])) 
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
	
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
	
	
		if ($username == "" || $password =="") 
		{
			echo "username hoặc password bạn không được để trống!";
		}
		else
		{
			$sql = "select * from users where username = '$username' and password = '$password' ";
			$query = mysqli_query($conn,$sql);
			$num_rows = mysqli_num_rows($query);
			if ($num_rows==0) 
			{
				echo "tên đăng nhập hoặc mật khẩu không đúng !";
			}
			else
			{
				$_SESSION['username'] = $username;
				 header('Location: index.php');
			}
	}
	
	<form method="POST" action="login.php">
	<fieldset>
	    <legend>Đăng nhập</legend>
	    	<table>
	    		<tr>
	    			<td>Username</td>
	    			<td><input type="text" name="username" size="30"></td>
	    		</tr>
	    		<tr>
	    			<td>Password</td>
	    			<td><input type="password" name="password" size="30"></td>
	    		</tr>
	    		<tr>
	    			<td colspan="2" align="center"> <input type="submit" name="btn_submit" value="Đăng nhập"></td>
	    		</tr>
	    	</table>
  </fieldset>
  </form>
</body>
</html>
