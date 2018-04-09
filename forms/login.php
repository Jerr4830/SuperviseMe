<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Log in</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php
$email = $password = "";
$emailErr = $pssdErr = "";
$cnt = 0;
$servername = "localhost";
$username = "root";
$pass = "rasp87";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (empty($_POST["email"])){
		$emailErr = "* Email is incorrect";
		if ($cnt > 0){
			$cnt -= 1;
		}
	} else {
		$email = test_field($_POST["email"]);
		$emailErr = "";
		$cnt += 1;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$emailErr = "* Invalid email format";
			if ($cnt > 0){
				$cnt -= 1;
			}
		}
	}

	if (empty($_POST["password"])){
		$pssdErr = "* field is requred";
		if ($cnt > 0){
			$cnt -= 1;
		}
	} else {
		$password = test_field($_POST["password"]);
		$cnt +=1;
	}
	if ($cnt ==2){
		$conn = mysql_connect($servername,$username,$pass) or die ("Could not connect");
		$sql = "SELECT username FROM customers_info WHERE  username ='$email'";
		mysql_select_db('Customers');
		$result = mysql_query($sql, $conn) or die ("Could not execute query");
		$num = mysql_num_rows($result);
		if ($num > 0){
			$sql = "SELECT username FROM customers_info
				WHERE username='$email' AND password=md5('$password')";
			$result2 = mysql_query($sql,$conn) or die ("Could not execute query");
			$num2 =mysql_num_rows($result2);
			if ($num2 > 0){
				$sql = "SELECT first_name, last_name FROM customers_info WHERE username='$email'";
				$res = mysql_query($sql,$conn) or die("Could not get data");
				$row = mysql_fetch_array($res,MYSQL_ASSOC);  
				$_SESSION['fname '] = $row['first_name'];
				$_SESSION['lname '] = $row['last_name'];
				$_SESSION['username '] = $email;
				mysql_close($conn);
				header("Location:/users/index.php ");
				
			} else {
				$pssdErr = "Incorrect password! Please try again";
			}
		} else if ($num == 0){
			$emailErr = "The email you entered does not exist";
		}
	}
}

function test_field($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>

<br>
<br>
<div class="container" style="padding:10px;width:400px;height:400px;margin-top:15px;border:1px solid black;border-radius:10px;box-shadow:5px 5px gray;background-color:black;color:lightseagreen">
<div style="text-align: center; padding:10px;"><h2>Log in</h2></div>
<br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="form-group">
<div class="input-group">
<span class="input-group-addon" style="color:lightseagreen;background-color:black;"><i class="glyphicon glyphicon-user"></i></span>
<input type="email" class="form-control" name="email" placeholder="Email" />
</div>
<span class="text-danger"><?php echo $emailErr; ?></span>
</div>
<br>
<div class="form-group">
<div class="input-group">
<span class="input-group-addon" style="color:lightseagreen;background-color:black;"><i class="glyphicon glyphicon-lock"></i></span>
<input name="password" class="form-control" placeholder="Password">
</div>
<span class="text-danger"><?php echo $pssdErr; ?></span>
</div>
<br>
<div class="text-center">
<input type="submit" value="log in" class="btn btn-default" style="width:250px; background-color:black;color:lightseagreen;border:1px solid lightseagreen" />
</div>
</form>
<br>
<div class="text-center"><a style="color:lightseagreen" href="/forms/forgot.php">Forgot password?</a></div>
</div>
</body>
</html>