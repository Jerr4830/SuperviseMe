<?php
session_start();
?>
<html>
<head>
<title>Upload Video</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
$target_dir = "videos/";
$target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$upError = "";

// check if file already exists
if (file_exists($target_file)){
	$upError = "File already exists";
	$uploadOk = 0;
}

// Allow certain file formats
if ($fileType != "mp4" && $fileType != "ogg" && $fileType != "webm"){
	$upError =  "Sorry, only mp4, ogg and webm files allowed.";
	$uploadOk = 0;
}

// check if it is ok to upload file
if ($uploadOk != 0){
	if (move_uploaded_file($_FILES["fileupload"]["tmp_name"],$target_file)){
		$xmlDoc = new DOMDocument();
		$xmlDoc->load("db/library.xml");
		
		$video = $xmlDoc->createElement( "video" );
		
		
		// username of customer that uploaded the file
		$name = $xmlDoc->createElement( "name" );
		$name->appendChild( $xmlDoc->createTextNode($_SESSION['username ']));
		$video->appendChild($name);
		
		// path to file uploaded
		$path = $xmlDoc->createElement( "file" );
		$path->appendChild( $xmlDoc->createTextNode($target_file));
		$video->appendChild($path);
		
		// date the file was uploaded
		$fDate = $xmlDoc->createElement( "uploadDate" );
		// day
		$fDay = $xmlDoc->createElement( "day" );
		$fDay->appendChild( $xmlDoc->createTextNode(date("d"));
		$fDate->appendChild($fDay);
		// month
		$fMonth = $xmlDoc->createElement( "month" );
		$fMonth->appendChild( $xmlDoc->createTextNode(date("m"));
		$fDate->appendChild($fMonth);
		// year
		$fYear = $xmlDoc->createElement( "year" );
		$fYear->appendChild( $xmlDoc->createTextNode(date("Y"));
		$fDate->appendChild($fYear);
		$video.appendChild($fDate);
		
		// add new node to document
		$videos = $xmlDoc->getElementsByTagName( "videos" );
		$videos->appendChild($video);
		
		$xmlDoc->saveXML();
		$xmlDoc->save("db/library.xml");
		
		
		$upError = "Uploaded";
		
		header("Location:/users/index.php ");
	}
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
<a href="/users/index.html" id="user_name" class="navbar-brand" style="color:lightseagreen"><?php echo $_SESSION["fname "] . " " . $_SESSION["lname "]; ?></a>
</div>
<div class="navbar-collapse collapse" id="myNavbar">
<ul class="nav navbar-nav">
<li><a href="/users/index.html" style="color:lightseagreen">Home</a></li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" data-toggle="dropdown" style="color:lightseagreen">Videos</a>
<div class="dropdown-menu">
<li><a href="/users/upload_video.php" class="dropdown-item" style="lightseagreen">Upload Videos</a></li>
<li><a class="dropdown-item" style="color:lightseagreen">View Videos</a></li>
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
<form action="upload.php" method="post" enctype="multipart/form-data">
Select video to upload:
<input type="file" name="fileupload" id="fileupload">
<input type="submit" value="Upload video" name="submit">
<span><?php echo $upError; ?></span>
</form>
</body>
</html>