<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Employee Dashboard</title>
	<link rel="stylesheet" type="text/css" href="change_password.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<?php
function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
}  
?>   
	<nav class="navbar-expand-lg navbar navbar-dark bg-primary">
	  <a class="navbar-brand" href="#">TRAICORD</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item">
	      	<?php if($_SESSION["employee_type"]=="HOD"){?>
	        	<a class="nav-link" href="http://localhost/Dashboard_file/WebDashboardHod/Hod_Dashboard.php" id="backwhite">Home <span class="sr-only">(current)</span></a>
	    	<?php } else if($_SESSION["employee_type"]=="Admin"){?>
	    		<a class="nav-link" href="http://localhost/Dashboard_file/WebDashboardAdmin/Admin_Dashboard.php" id="backwhite">Home <span class="sr-only">(current)</span></a>
	    	<?php } else{ ?>
	    		<a class="nav-link" href="http://localhost/Dashboard_file/WebDashboardEmployee/Employee_Dashboard.php" id="backwhite">Home <span class="sr-only">(current)</span></a>
	    	<?php } ?>
	      </li>
	    </ul>
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item">
	      	<a class="nav-link" id="logout" href="http://localhost/Login_file/login_authentication.php">LOGOUT</a>
	      </li>
	    </ul>
	   
	  </div>
    </nav>

<br><br>
<form><center>
	<?php
	$db = mysqli_connect('localhost','root','','traicord') or 
	die('Error connecting to MySQL server.');
	$email_loggedin = $_SESSION["email"];
	$query = "SELECT * from users where email = '$email_loggedin';";
	$result = mysqli_query($db,$query);
	while($row=mysqli_fetch_assoc($result))
    {
        echo 'Email:<br> <input type="text" value='.$row['email'].'><br>';
        mysqli_close($db);
		
	}
	
	?>

</form></center>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<center><br>Password<br><input type="password" name="new_password" placeholder="Enter New Password"><br><br>
Confirm Password<br><input type="password" name="re_new_password" placeholder="Confirm New Password"><br>

<input type="submit" name="submit" value="Submit" class="loginbutton"></center></form>

<?php
$new_password_Err="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$new_password=$_POST["new_password"];
/*echo $_POST["new_password"];
echo $new_password;*/
$email=$_SESSION["email"];
/*echo $email;*/
$re_new_password=$_POST["re_new_password"];
	
	if(!empty($_POST["new_password"]) && !empty($_POST["re_new_password"])){
		if ($_POST["new_password"]!=$_POST["re_new_password"]) {
			$new_password_Err=  "Passwords does not match!"."<br>";
		}
		else{
			$db = mysqli_connect('localhost','root','','traicord') or 
			die('Error connecting to MySQL server.');

            $query = "UPDATE users SET `password_set` = '$new_password' WHERE `email`='$email'";
            /*echo $query;*/


            $result = mysqli_query($db,$query);	//order executes
            /*echo $result;*/
			if($result){
				echo("<br><p>Password change successful!<br></p>");
				mysqli_close($db);
			} else{
				echo("<br><p>Try Again!<br></p>");
			}

				

		}
	}
	else{
        $new_password_Err = "Please fill the required fields!";
        echo "$new_password_Err";
		}
	}
	
?>	
      





	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
  





</body>
</html>