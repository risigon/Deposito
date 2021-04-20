<!DOCTYPE html>
<html>
<head>
	<title>Acesso Depósito</title>

</head>
<body>


<?php 
	
session_start();
		
// remove all session variables
session_unset();

// destroy the session
session_destroy();

$acesso = "login.php";

echo "<meta http-equiv='refresh' content='0; url=$acesso'>";

?>


</body>
</html>