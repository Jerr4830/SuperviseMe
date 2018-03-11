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
				$sql = "SELECT first_name, last_name FROM customers WHERE username='$email'";
				$res = myql_query($sql,$conn);
				$row = mysql_fetch_assoc($res);  
				$_SESSION['name '] = $row["first_name"] . " " . $row["last_name"];
				header("Location:/users/index.html");
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
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar" style="background-color:lightseagreen"></span>
<span class="icon-bar" style="background-color:lightseagreen"></span>
<span class="icon-bar" style="background-color:lightseagreen"></span>
</button>
<a href="/index.html" class="navbar-brand" style="color:lightseagreen">SuperviseMe</a>
</div>
<div class="navbar-collapse collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li><a href="/index.html" style="color:lightseagreen">Home</a></li>
<li><a href="about.html" style="color:lightseagreen">About</a></li>
<li><a href="contact.html" style="color:lightseagreen">Contact</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="/forms/register.php" style="color:lightseagreen">Sign up</a></li>
<li><a href="/forms/login.php" style="color:lightseagreen">Log in</a></li>
</ul>
</div>
</div>
</nav>
<br>
<br>
<div class="container" style="background-color: gray; padding:10px;">
<div style="text-align: center"><h2>Log in</h2></div>
<hr />
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="form-group"
<label for="email" style="color:lightseagreen">Email</label>
<input type="email" class="form-control" name="email" placeholder="someone@example.com" />
<span class="text-danger"><?php echo $emailErr; ?></span>
</div>
<div class="form-group">
<label for="password" style="color:lightseagreen">Password</label>
<input type="password" class="form-control" placeholder="Enter password ( ****)" />
<span class="text-danger"><?php echo $pssdErr; ?></span>
</div>
<div class="text-center">
<input type="submit" value="log in" class="btn btn-default" style="width:250px; background-color:black;color:lightseagreen;border:1px solid lightseagreen" />
</div>
</body>
</html>