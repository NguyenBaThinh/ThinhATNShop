
<html>
	<head>
		<title>PHP Test</title>
	</head>
	<body>
		<?php 
			echo '<p>TEST HEROKU POSTGRESQL DATABASE </p>'; 
			# Heroku credential 
			$host_heroku = "ec2-52-71-231-37.compute-1.amazonaws.com";
			$db_heroku = "di2ellqdbmej3";
			$user_heroku = "wcluvkjuqpcoyh";
			$pw_heroku = "ba7a9a28b0a05adf03800783a7d4b5c3017d130f4f7baf3fb9eddbe47f8d66d5";
			# Create connection to Heroku Postgres
			$conn_string = "host=$host_heroku port=5432 dbname=$db_heroku user=$user_heroku password=$pw_heroku";
			$pg_heroku = pg_connect($conn_string);
			
			if (!$pg_heroku)
			{
				die('Error: Could not connect: ' . pg_last_error());
			}
			# Get data by query
			$query = 'select * from atn';
			$result = pg_query($pg_heroku, $query);
			# Display data column by column
			$i = 0;
			echo '<html><body><table><tr>';
			while ($i < pg_num_fields($result))
			{
				$fieldName = pg_field_name($result, $i);
				echo '<td>' . $fieldName . '</td>';
				$i = $i + 1;
			}
			echo '</tr>';
			# Display data row by row
			$i = 0;
			while ($row = pg_fetch_row($result)) 
			{
				echo '<tr>';
				$count = count($row);
				$y = 0;
				while ($y < $count)
				{
					$c_row = current($row);
					echo '<td>' . $c_row . '</td>';
					next($row);
					$y = $y + 1;
				}
				echo '</tr>';
				$i = $i + 1;
			}
			pg_free_result($result);

			echo '</table></body></html>';
		?> 
		<form name = "input" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
			<table class='table table-hover table-responsive table-bordered'>
			<tr>
			<td>product_id</td> 
			<td><input type='number' name='id' class='form-control' /></td>
			</tr>
			<tr>
			<td>product_name</td> 
			<td><input type='number' name='name' class='form-control' /></td>
			</tr>
			<tr>
			<td>product_stock</td> 
			<td><input type='number' name='stock' class='form-control' /></td>
			</tr>
			<tr>
			<td>product_price</td> 
			<td><input type='number' name='price' class='form-control' /></td>
			</tr>
			<tr>
			<td></td>
			<td>
				<input type="submit" value="Add" class='btn btn-primary'/>
				<a href='index.php' class='btn btn-danger'>Cancel Go back</a>
            		</td>
       			 </tr>
			</table>
		</form>	
		
		
		
			
			
	</body>
</html>
