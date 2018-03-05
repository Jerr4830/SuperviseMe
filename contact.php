<!DOCTYPE html>
<html>
<head>
<title>Contact Us</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php
$email = $emailErr = $message = $messageErr = "";
$emailChck = false;
$mesgChck = false;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if (empty($_POST["email"])){
		$emailErr = "field is required";
		$emailChck = false;
	} else {
		$email = test_input($_POST["email"]);
		$emailChck = true;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$emailErr = "* Invalid email format";
			$emailChck = false;
		}
	}
	
	if (empty($_POST["message"])){
		$messageErr = "* field is required";
		$mesgChck = false;
	} else {
		$message = test_input($_POST["message"]);
		$mesgChck = true;
	}
	
	if (($emailChck == true) && ($mesgChck == true)){
		sendMessage($email,$message);
	}
}

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function sendMessage($mail, $mesg){
	$to = "jaspeedx785@gmail.com";
	$subject = "SuperviseMe website";	
	$headers = "From: " . $mail ."\r\n";
	
	mail($to,$subject,$mesg,$headers);
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
<li><a href="#" style="color:lightseagreen">Home</a></li>
<li><a href="#" style="color:lightseagreen">About</a></li>
<li><a href="#" style="color:lightseagreen">Contact</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="#" style="color:lightseagreen">Sign up</a></li>
<li><a href="#" style="color:lightseagreen">Log in</a></li>
</ul>
</div>
</div>
</nav>
<div>
<div style="text-align: center">
<h2>Contact Us</h2>
</div>
<div class="container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div class="form-group">
<label for="email">Email</label>
<input type="email" class="form-control" id="email" placeholder="Email" name="email" />
<span class="text-danger"><?php echo $emailErr;?></span>
</div>
<div class="form-group">
<label for="message">Message</label>
<textarea name="message" rows="8" wrap="hard" placeholder="Message..." class="form-control"></textarea>
<span class="text-danger"><?php echo $messageErr;?></span>
</div>
<div class="col-xs-2" style="margin:0 auto;text-align: center">
<button type="submit" class="btn btn-default" style="color:lightseagreen;background-color:black;border:1px solid lightseagreen;padding:10px;width:100%">Send</button>
</div>
</form>
</div>
</div>
</body>
</html>