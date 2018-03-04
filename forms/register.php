<html>
<head>
<meta name="viewport" content="width="device-width, initial-scale=1.0" />
<title> Register </title>
<link rel="stylesheet" href="/css/register_form.css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2/1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>
<div style="text-align: center"><h2>Create an account</h2></div>
<hr />
<div class="form_container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<fieldset>
<legend>Personal Information</legend>
<div class="form-group">
<label for="accntType">Type of account </label>
<select>
<option value="select">select</option>
<option value="supervisor">Supervisor</option>
<option value="student">Student</option>
</select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="fname">First Name</label>
<input type="text" class="pers_ipt" placeholder="First Name" required />
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="lname">Last Name</label>
<input type="text" class="pers_ipt" placeholder="Last Name" required />
<span class="text-danger"></span>
</div>

<div class="form-group">
<label>Birthday </label>
<select class="date_of_birth">
<?php
$months = array("Month","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
for($lcv = 0; $lcv < 13; $lcv++){
echo "<option value=\"" . $months[$lcv] . "\">" . $months[$lcv] . "</option>";
}
?>
</select>

<select class="date_of_birth">
<?php
echo "<option>Day</option>";
for($lcv=1; $lcv < 32; $lcv++){
echo "<option value=\"" . $lcv ."\">" . $lcv . "</option>";
}
?>
</select>

<select class="date_of_birth">
<?php
echo "<option>Year</option>";
$currDate = date("Y");
$cdate = (int)$currDate;
for($lcv= $cdate - 100; $lcv < $cdate; $lcv++){
echo "<option value=\"" . $lcv . "\">" . $lcv . "</option>";
}
?>
</select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="lname">Gender</label>
<select>
<option value="select">Gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
</select>
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="sAdr">Street Address</label>
<input type="text" class="pers_ipt" placeholder="Street Address" />
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="sAdr">Address (line 2)</label>
<input type="text" class="pers_ipt" placeholder="Address" />
<span class="text-danger"></span>
</div>

<div class="form-group">
<table>
<tr>
<td>
<label for="city">City</label>
</td>
<td>
<label for="state">State</label>
</td>
<td>
<label for="city">Zip Code</label>
</td>
</tr>
<tr>
<td>
<input type="text"  placeholder="city" />
</td>
<td>
<select>
<?php
$states = array("State","Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","District Of Columbia","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming");
$sttes = array("select","AL","AK","AZ");
for ($lcv = 0; $lcv < 53; $lcv++){
echo "<option value=\"" . $states[$lcv] . "\">" .  $states[$lcv] . "</option>";
}
?>
</select>
</td>
<td>
<input type="number" maxlength="5" />
</td>
</tr>
<tr>
<td>
<span class="text-danger"></span>
</td>
<td>
<span class="text-danger"></span>
</td>
<td>
<span class="text-danger"></span>
</td>
</tr>
</table>
</div>


</fieldset>
<fieldset>
<legend>Account Information</legend>

<div class="form-group">
<label for="email">Email</label>
<input type="text" class="accnt_ipt" placeholder="Email (someone@example.com)" />
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="password" class="accnt_ipt" placeholder="Password" />
<span class="text-danger"></span>
</div>

<div class="form-group">
<label for="password">Password</label>
<input type="password" class="accnt_ipt" placeholder="re-enter password" />
<span class="text-danger"></span>
</div>
</fieldset>
<div class="text-center">
<input type="submit" value="register" class="btn btn-md" style="color:lightseagreen;border:1px solid lightseagreen; border-radius:3px; background-color:black;padding:10px;width:100px;" />
<a href="/index.html" class="btn btn-md" style="text-decoration:none;color:lightseagreen;border:1px solid lightseagreen;border-radius:3px;background-color:black;padding:10px;width:100px;">cancel</a>
</div>
</form>
</div>
</body>
</html>