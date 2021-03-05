<!doctype html>											
<html>											
<head>											
<meta charset="utf-8">											
</head>											
<body>											
<?php											
$query = 'SELECT * FROM atn';
$id = $_GET['product_ID'];	
$sql = "delete from test where id= $id";
$result = pg_query($query, $sql);
									
header('Location: index.php ');											
?>											
</body>
</btml>		
