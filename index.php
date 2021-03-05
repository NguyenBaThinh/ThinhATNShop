<?php 
session_start();
			echo '<p>THINH ATN SHOP </p>'; 
			# Heroku credential 
			$host_heroku = "ec2-35-171-57-132.compute-1.amazonaws.com";
			$db_heroku = "d8847oi5c0tnc2";
			$user_heroku = "jvkzuhcsezvfte";
			$pw_heroku = "b7c215aa5cb23f04f16204e65d25bb5258955ca280199c68aff540d9fbba4b71";
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
<!DOCTYPE HTML>
<html>
	<head>
		<title>PHP Test</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	</head>
	<body>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<form method="get" action="" >
			product_id: <input type='number' name='id' class='form-control' /></td>
			product_name:<input type='text' name='name' class='form-control' /></td>
			product_stock:<input type='number' name='stock' class='form-control' /></td>
			product_price:<input type='number' name='price' class='form-control' /></td>
				<input type="submit" name = "add" value="Add" class='btn btn-primary'/>
				<a href='index.php' class='btn btn-danger'>Cancel Go back</a>
            	
		</form>
		<?php
		if(isset($_GET['add'])){
			$sql = "insert into atn(product_ID, product_name, product_stock, product_price) values($_GET[id],'$_GET[product_name]',$_GET[product_stock],$_GET[product_price])";
			$result = pg_query($pg_heroku, $sql);
			if($result)
			{
			  header('Location: index.php');
			} 
			header('Location: index.php');
		}
?>
		
	</body>
</html>
