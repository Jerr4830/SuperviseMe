<?php
session_start();
?>
<html>
<body>
<?php
//remove all session variables
session_unset();

//destroy the session
session_destroy();

// return to the home page
header("Location:/index.html ");
?>
</body>
</html>