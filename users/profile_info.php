<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$accnt = $fname = $lname = $dob_day = $dob_month = $dob_year = "";
$gender = $sadr = $adr = $addr = $city = $state = $zipcode = "";
$email = $pssd = "";

$ufname = $ulname = $udob_day = $udob_month = $udob_year = "";
u$gender = $uadr = $uaddr = $ucity = $ustate = $uzipcode = "";
$uemail = $upssd = "";

$fnameErr = $lnameErr = $bdayErr = $genderErr = $adrErr = $cityErr = $stateErr = $zipcodeErr = "";
$emailErr = $pssdErr = ""; 
// info to access database
$servername = "localhost";
$username = "root";
$password = "rasp87";
$dbname = "Customers";

$email = $_SESSION['username '];

$conn = mysql_connect($servername,$username,$pass) or die ("Could not connect");
mysql_select_db($dbname);
$sql = "SELECT * FROM customers_info where username='$email'";

$result = mysql_query($sql,$conn);
$rows = mysql_fetch_assoc($result);
$user_id = $rows["ID"];
$accnt = $rows["account"];
$fname = $rows["first_name"];
$lname = $rows["last_name"];
$dob_day = $rows["dob_day"];
$dob_month = $rows["dob_year"];
$dob_year = $rows["dob_year"];
$gender = $rows["gender"];
$adr = $rows["Address"];
$addr = $rows["scndAddress"];
$city = $rows["City"];
$state = $rows["State"];
$zipcode = $rows["Zipcode"];

// close the connection if user pressed cancel button
if (isset($_POST["cancel"])){
	mysql_close($conn);
	header("Location: /users/index.php");
}

//if (isset($_POST["save"])){
//	mysql_select_db($dbname);
	

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
<a href="/users/index.html" id="user_name" class="navbar-brand" style="color:lightseagreen"><?php echo $_SESSION["fname "] . " " . $_SESSION["lname "]; ?></a>
</div>
<div class="navbar-collapse collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li><a href="/users/index.html" style="color:lightseagreen">Home</a></li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" data-toggle="dropdown" style="color:lightseagreen">Videos</a>
<div class="dropdown-menu">
<a href="/users/upload_video.php" class="dropdown-item" style="color:lightseagreen">Upload Videos</a>
<a class="dropdown-item" style="color:lightseagreen">View Videos</a>
</div>
</li>
<li><a style="color:lightseagreen">Contact</a></li>
<li><a href="/users/profile_info.php" style="color:lightseagreen">Profile</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="user_logout.php" style="color:lightseagreen"> <span class="glyphicon glyphicon-log-out"></span> log out</a></li>
</ul>
</div>
</div>
</nav>

<div class="form_container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<fieldset>
<legend>Personal Information</legend>

</fieldset>
<fieldset>
<legend>Account Information</legend>

<div class="form-group">
<label for="email">Email</label>
<input type="text" name="email" class="accnt_ipt" placeholder="<?php echo $email; ?>" />
<span class="text-danger"><?php echo $emailErr; ?></span>
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="password" name="pssd" class="accnt_ipt" placeholder="**********" />
<span class="text-danger"><?php echo $pssdErr; ?></span>
</div>

</fieldset>
<div class="text-center">
<input type="submit" value="save" class="btn btn-md" style="color:lightseagreen;border:1px solid lightseagreen; border-radius:3px; background-color:black;padding:10px;width:100px;" />
<a href="/users/close.php" class="btn btn-md" style="text-decoration:none;color:lightseagreen;border:1px solid lightseagreen;border-radius:3px;background-color:black;padding:10px;width:100px;">cancel</a>
</div>
</form>
</div>
</body>
</html>
</body>
</html>
