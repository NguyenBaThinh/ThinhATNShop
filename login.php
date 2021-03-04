  
<?php
	$host_heroku = "ec2-18-206-84-251.compute-1.amazonaws.com";
	$db_heroku = "d8k42dnhtd0o9i";
	$user_heroku = "crmjpgdtqgprga";
	$pw_heroku = "0d86d0fb5f24be75ffb6728bb2ffaa6762b75489e8923fda3cdf71c519a99d67";
	# Create connection to Heroku Postgres
	$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
	$pg_heroku = pg_connect($conn_string);

	if (!$pg_heroku)
	{
		Exit('Error: Could not connect: ' . pg_last_error());
	}


	if (isset($_POST['btn_submit'])) 
	{
		$sql ="select * from login where username = '$_POST[username]' and password = '$_POST[password]'";
		$data = pg_query($pg_heroku,$sql);
		$login_check = pg_num_rows($data);
		if($login_check > 0)
		{
			echo"login success";
		}
		else{
			echo "Invalid Details";
		}
	}
		
		
?>



<html>
<head>
	<title>Trang đăng nhập</title>
	<meta charset="utf-8">
</head>
<body>

	<form method="POST">
	
	    <legend>Đăng nhập</legend>
	    	<table>
	    		<tr>
	    			<td>Username</td>
	    			<td><input type="text" name="username" size="30" required></td>
	    		</tr>
	    		<tr>
	    			<td>Password</td>
	    			<td><input type="password" name="password" size="30" required></td>
	    		</tr>
	    		<tr>
	    			<td colspan="2" align="center"> <input type="submit" name="btn_submit" value="Đăng nhập"></td>
	    		</tr>
	    	</table>
  	
 	 </form>
</body>
</html>
