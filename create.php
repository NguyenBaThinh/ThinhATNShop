<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
      
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
          
</head>
<body>
  
    <!-- container -->
    <div class="container">
   
        <div class="page-header">
            <h1>Create Product</h1>
        </div>
    <?php
		if(isset($_POST['add'])){
			$sql = "INSERT INTO atn set product_ID=:id, product_name=:name, product_stock=:stock, product_price=:price";
			$result = pg_query($pg_heroku, $sql);
			$id=htmlspecialchars(strip_tags($_POST['id']));
			$name=htmlspecialchars(strip_tags($_POST['name']));
       			$stock=htmlspecialchars(strip_tags($_POST['stock']));
        		$price=htmlspecialchars(strip_tags($_POST['price']));
			$result->bindParam(':id', $id);
			$result->bindParam(':name', $name);
       			$result->bindParam(':description', $stock);
       			$result->bindParam(':price', $price);
			if($result->execute())
			{
			  header('Location: index.php')
			} 
			echo "error"; #pg_last_error($pg_heroku)
		}
		?>
      
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Back to read products</a>
            </td>
        </tr>
    </table>
</form>
          
    </div> <!-- end .container -->
      
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</body>
</html>
