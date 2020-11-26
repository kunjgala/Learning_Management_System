<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
session_start();
echo $_SESSION["first_name"];
echo $_SESSION["last_name"];
echo $_SESSION["email"];
echo $_SESSION["department"];
echo $_SESSION["employee_type"];
?>
</body>
</html>