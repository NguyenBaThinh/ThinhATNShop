  
<?php
	$host_heroku = "ec2-18-206-84-251.compute-1.amazonaws.com";
	$db_heroku = "di2ellqdbmej3";
	$user_heroku = "wcluvkjuqpcoyh";
	$pw_heroku = "ba7a9a28b0a05adf03800783a7d4b5c3017d130f4f7baf3fb9eddbe47f8d66d5";
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
		if (!isset($_SESSION['username'])) 
		{
			 header('Location: login.php');
		}
		
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

	<form method="POST" >
	
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
