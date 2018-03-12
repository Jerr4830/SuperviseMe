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

$fnameErr = $lnameErr = $bdayErr = $genderErr = $adrErr = $cityErr = $stateErr = $zipcodeErr = "";
$emailErr = $pssdErr = ""; 
// info to access database
$servername = "localhost";
$username = "root";
$password = "rasp87";
$dbname = "Customers";

$email = $_SESSION['username '];

$conn = mysql_connect($servername,$username,$pass) or die ("Could not connect");
$sql = "SELECT * FROM customers_info where username='$email'";

$result = myql_query($sql,$conn);
$rows = mysql_fetch_assoc($result);
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
<a class="dropdown-item">Upload Videos</a>
<a class="dropdown-item">View Videos</a>
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
<div style="text-align: center"><h2>Create an account</h2></div>
<hr />
<div class="form_container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<fieldset>
<legend>Personal Information</legend>
<div class="form-group">
<label for="accntType">Type of account </label>
<select name="accnt" disabled>
<?php
if ($accnt == "supervisor"){
	echo "<option>select</option><option selected>Supervisor</option><option>Student</option>";
} else {
	echo "<option>select</option><option>Supervisor</option><option selected>Student</option>";
}
?>
</select>
<span class="text-danger"><?php echo $accntErr; ?></span>
</div>

<div class="form-group">
<label for="fname">First Name</label>
<input type="text" name="fname" class="pers_ipt" placeholder="<?php echo $fname; ?>" required />
<span class="text-danger"><?php echo $fnameErr; ?></span>
</div>

<div class="form-group">
<label for="lname">Last Name</label>
<input type="text" name="lname" class="pers_ipt" placeholder="<?php echo $lname; ?>" required />
<span class="text-danger"><?php echo $lnameErr; ?></span>
</div>

<div class="form-group">
<table>
<tr>
<td><label>Birthday </label></td>
<td>
<select name="bd_month" class="date_of_birth">
<?php
$months = array("Month","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
for($lcv = 0; $lcv < 13; $lcv++){
echo "<option value=\"$months[$lcv]\">$months[$lcv]</option>";
}
?>
</select>
</td>
<td>
<select name="bd_day" class="date_of_birth">
<?php
echo "<option>Day</option>";
for($lcv=1; $lcv < 32; $lcv++){
echo "<option value=\"$lcv\">$lcv</option>";
}
?>
</select>
</td>
<td>
<select name="bd_year" class="date_of_birth">
<?php
echo "<option>Year</option>";
$currDate = date("Y");
$cdate = (int)$currDate;
for($lcv= $cdate - 100; $lcv < $cdate; $lcv++){
echo "<option value=\"$lcv\">$lcv</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td></td>
<td><span class="text-danger"></span></td>
<td><span class="text-danger"></span></td>
<td><span class="text-danger"></span></td>
</tr>
</table>
</div>

<div class="form-group">
<label for="gender">Gender</label>
<select name="gender" disabled>
<?php
if ($gender == "male"){
	echo "<option>Gender</option><option selected>Male</option><option>Female</option>";
} else {
	echo "<option>Gender</option><option selected>Male</option><option selected>Female</option>";
}
?>
</div>

<div class="form-group">
<label for="adr">Address</label>
<input type="text" name="adr" class="pers_ipt" placeholder="<?php echo $adr; ?>" />
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="addr">Address (line 2)</label>
<input type="text" name="addr" class="pers_ipt" placeholder="<?php echo $addr; ?>" />
<span class="text-danger"></span>
</div>

<div class="form-group">
<table style="width:90%;">
<tr>
<td>
<label for="city">City</label>
<td>
</td>
<label for="state">State</label>
</td>
<td>
<label for="city">Zip Code</label>
</td>
</tr>
<tr>
<td>
<input type="text" name="city" placeholder="<?php echo $city; ?>" />
</td>
<td>
<select name="state">
<?php
$states = array("State","Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","District Of Columbia","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming");
$sttes = array("select","AL","AK","AZ","AR","CA","CO","CT","DE","DC","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WV","WI","WY");
for ($lcv = 0; $lcv < 53; $lcv++){
	$tmp = "" . $lcv;
	if ($tmp == $state){
		echo "<option value=\"$sttes[$lcv]\" selected>$states[$lcv]</option>";
	} else {
		echo "<option value=\"$sttes[$lcv]\"> $states[$lcv]</option>";
	}
}
?>
</select>
</td>
<td>
<input name="zipcode" type="number" maxlength="5" placeholder="<?php echo $zipcode; ?>" />
</td>
</tr>
<tr>
<td>
<span class="text-danger"><?php echo $cityErr; ?></span>
</td>
<td>
<span class="text-danger"><?php echo $stateErr; ?></span>
</td>
<td>
<span class="text-danger"><?php echo $zipcodeErr; ?></span>
</td>
</tr>
</table>
</div>


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
<a href="/users/index.php" class="btn btn-md" style="text-decoration:none;color:lightseagreen;border:1px solid lightseagreen;border-radius:3px;background-color:black;padding:10px;width:100px;">cancel</a>
</div>
</form>
</div>
</body>
</html>
</body>
</html>
