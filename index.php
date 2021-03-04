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
		<form name = "input" action="" method="get">
			product_id: <input type="number" name="id" value="" /><br />
			product_name: <input type="text" name="name" value="" /><br />
			product_stock: <input type="number" name="stock" value="" /><br />
			product_price: <input type="number" name="price" value="" /><br />
			<input type="submit" name="add" value="Add" />
			<input type="submit" name="update" value="Update" />
		</form>	
		<?php
		#Add
		if(isset($_GET['add'])){
			$sql = "insert into atn(id, product_name, product_stock, product_price) values(1, 'ex_toy', 1, '10000')";
			$result = pg_query($pg_heroku, $sql);
			if($result){
			  echo "Record Saved";
			  header('Location: index.php')
			} 
			
		}
		?>
		
		
			
			
	</body>
</html>
