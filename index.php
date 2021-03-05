  
<?php
	$host_heroku = "ec2-35-171-57-132.compute-1.amazonaws.com";
	$db_heroku = "d8847oi5c0tnc2";
	$user_heroku = "jvkzuhcsezvfte";
	$pw_heroku = "b7c215aa5cb23f04f16204e65d25bb5258955ca280199c68aff540d9fbba4b71";
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
			if ($_POST['username'] == 'bos')
			{
				header('Location: Director.php');
			}
			else
			{
				header('Location: StoreStaff.php');
			}
		}
		else
		{
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

	<form method="POST" action="login.php">
	<fieldset>
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
	</fieldset>
</body>
</html>
