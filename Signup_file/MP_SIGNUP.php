<?php
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>User_Registration</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="MP_SIGNUP.css">
</head>
<body>

<!--php validation-->
<?php
if(!empty($_GET['message'])) {?>
	<div class="container-fluid">
    <div class="alert alert-info">
        <strong>Not a registered user!</strong> Please register!
</div>
<?php }

$first_nameErr = $last_nameErr = $DOBErr = $email_idErr = $contact_number = $gender = $password = $confirm_password = $department = "";
$first_name = $last_name = $DOB = $email_id = $contact_numberErr = $genderErr = $passwordErr = $confirm_passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

//first name validation
  if (empty($_POST["first_name"])) {
    $first_nameErr = "First Name is required";
  } else {
	$first_name = test_input($_POST["first_name"]);
	$first_name = trim($first_name," ");
	$first_name = ucwords($first_name);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$first_name) || str_word_count($first_name)>1) {
      $first_nameErr = "Enter a valid First Name";
      $first_name = "";
    }
  }

  //last name validation
  if (empty($_POST["last_name"])) {
    $last_nameErr = "Last Name is required";
  } else {
	$last_name = test_input($_POST["last_name"]);
	$last_name = trim($last_name," ");
    $last_name = ucwords($last_name);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$last_name) || str_word_count($last_name)>1) {
      $last_nameErr = "Enter a valid Last Name";
      $last_name = "";
    }
  }
  
  //date of birth validation
  if (empty($_POST["DOB"])) {
    $DOBErr = "Date of Birth is required";
  } else {
	$DOB = test_input($_POST["DOB"]);
	$date = date("d/m/yy");
    $DOB_arr  = explode('/', $DOB);
  if (!checkdate($DOB_arr[1], $DOB_arr[0], $DOB_arr[2])) {
	  $DOBErr = "Enter Valid Date of Birth 1 ";
  }
    //$DOB_t = strtotime($DOB);
	//$date_t = strtotime($date);
	//if($DOB_t >= $date_t)
    //{
		//$DOBErr = "Enter Valid Date of Birth 2";
    //}
    }
  
  
    $department = $_POST["department"];


  //email validation

  if (empty($_POST["email_id"])) {
    $email_idErr = "Email is required";
  } else {
    $email_id = test_input($_POST["email_id"]);
    if (!filter_var($email_id, FILTER_VALIDATE_EMAIL)) {
      $email_idErr = "Invalid email format";
      $email_id = "";
    }
  }
  
  //Contact number validation

  if (preg_match("/^[1-9]{1}[0-9]{9}/", $_POST["contact_number"])) {
    $contact_number = test_input($_POST["contact_number"]);
  } elseif (empty($_POST["contact_number"])) {
    $contact_numberErr = "Contact information required";
  } else {
    $contact_numberErr = "Enter a valid phone number";
  } 
    
  //Gender validation

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
	
// password validation

if(!empty($_POST["password"])){
	if ($_POST["password"]!=$_POST["confirm_password"]) {
		$confirm_passwordErr .=  "Passowrd and Confirm Password does not match!"."<br>";
	}
	if (strlen($_POST["password"]) < '8') {
		$passwordErr .= "Your Password Must Contain At Least 8 Characters!"."<br>";
	}
	elseif(!preg_match("#[0-9]+#",$_POST["password"])) {
		$passwordErr .= "Your Password Must Contain At Least 1 Number!"."<br>";
	}
	elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
		$passwordErr .= "Your Password Must Contain At Least 1 Uppercase Letter!"."<br>";
	}
	elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
		$passwordErr .= "Your Password Must Contain At Least 1 Lowercase Letter!"."<br>";
	}
	elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
		$passwordErr .= "Your Password Must Contain At Least 1 Special Character!"."<br>";
	}
}else{
	$passwordErr .= "Please Enter your password"."<br>";
}
    

//$cookie_value = $email_id;
//setcookie('user', $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
//header("location:http://localhost/wp_mini_proj/signup_form/cookie_set.php");

if ($first_nameErr=="" && $last_nameErr=="" && $DOBErr =="" && $email_idErr =="" && $contact_numberErr =="" && $genderErr =="" && $passwordErr =="" && $confirm_passwordErr =="")
{
//$cookie_value = $email_id;
//setcookie('email', $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
//$_SESSION["firstname"] = $first_name;
//$_SESSION["lastname"] = $last_name;
//$_SESSION["emailid"] = $email_id;
//$_SESSION["department"] = $department;
//header("location:http://localhost/wp_mini_proj/signup_form/session_set.php");
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$dob = $_POST['DOB'];
$email = $_POST['email_id'];
$contact = $_POST['contact_number'];
$gender = $_POST['gender'];
$department = $_POST['department'];
$employee_type = $_POST['employee_type'];
$password = $_POST['password'];
echo $first_name;
echo $last_name;
echo $dob;
echo $email;
echo $contact;
echo $gender;
echo $department;
echo $employee_type;
echo $password;
$db = mysqli_connect('localhost','root','','traicord');
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
	$sql = "INSERT INTO users VALUES ('$first_name','$last_name', '$dob', '$email','$contact','$gender','$department','$employee_type','$password')";
    if (mysqli_query($db, $sql)) {
		mysqli_close($db);
	    header("location:http://localhost/login_file/login_authentication.php");
}
else { mysqli_close($db);?>
	<div class="container-fluid">
        <div class="alert alert-danger">
            <strong>Authentication Failed!</strong> 
    </div>
	<?php
}


}
}
}



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!--php validation-->

<div class="">
  	<div class="row">
    	<div class="col-sm-3 left_fill_background" style="height:940px">
		    <img src="signup.png" style="height:950px;width:350px;">
    		<!--<img class="pencil" src="images.png">
    		<img class="pencil1" src="images1.png">-->
    	</div>
    	<div class="col-sm-9 sign_up_background" style="padding-left: 50px;
    height: 940px;
	background-color: #ECECEC;
	border-right: 150px solid #1034A6;">
    		<h1>Please fill in the form below to register yourself:</h1>
    		<br>
      		<div class="row">
			    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      			<div class="col-sm-2 sign_up_labels" required>First Name:</div>
                  <div class="col-sm-10 sign_up_inputs"><input type="text" name="first_name" id="first_name" placeholder="First name"> 
                  <span class="error">* <?php echo $first_nameErr;?></span></div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels">Last Name:</div>
				  <div class="col-sm-10 sign_up_inputs"><input type="text" name="last_name" id="last_name" placeholder="Last name ">
				  <span class="error">* <?php echo $last_nameErr;?></span></div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels">Date of Birth:</div>
				  <div class="col-sm-10 sign_up_inputs"><input type="text" name="DOB" id="DOB" placeholder="dd/mm/yyyy">
				  <span class="error">* <?php echo $DOBErr;?></span></div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels" required>Email-id:</div>
				  <div class="col-sm-10 sign_up_inputs"><input type="text" name="email_id" id="email_id" placeholder="Email id">
			      <span class="error">* <?php echo $email_idErr;?></span></div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels" required>Contact Number(mobile):</div>
				  <div class="col-sm-10 sign_up_inputs"><input type="text" name="contact_number" id="contact_number" placeholder="Contact number">
				  <span class="error">*<?php echo $contact_numberErr;?></span></div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels">Gender:</div>
      			<div class="col-sm-10 sign_up_inputs">
      				<input type="radio" name="gender" id="gender" value="male">Male
      				<input type="radio" name="gender" id="gender" value="female">Female
					<input type="radio" name="gender" id="gender" value="other">Other
					<span class="error">* <?php echo $genderErr;?></span>
      			</div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels">Department:</div>
      			<div class="col-sm-10 sign_up_inputs"><select class="form-control" name="department" id="department">
      													<option>CS</option>
      													<option>IT</option>
      													<option>ETRX</option>
      													<option>EXTC</option>
      													<option>MECH</option>
   													  </select></div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels">Select Employee type:</div>
      			<div class="col-sm-10 sign_up_inputs"><select class="form-control" name="employee_type" id="employee_type">
      													<option>Admin</option>
      													<option>HOD</option>
      													<option>Employee</option>
   													  </select></div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels">Set Password:</div>
				  <div class="col-sm-10 sign_up_inputs"><input type="password" name="password" id="password" placeholder="Password">
				  <span class="error">* <?php echo $passwordErr;?></span></div>
      			<br><br><br><br>
      			<div class="col-sm-2 sign_up_labels">Confirm Password:</div>
				  <div class="col-sm-10 sign_up_inputs"><input type="password" name="confirm_password" id="confirm_password" placeholder=" Enter password again">
				  <span class="error">* <?php echo $confirm_passwordErr;?></span></div>
      			<br><br><br><br>
				  <!--<input class="btn btn-primary" type="submit" name="">-->
				  <input type="submit"  class="btn btn-primary" id="mybutton" value="Submit" style="margin-left: 170px;width: 100px">

      			</form>
      		</div>
    	</div>
  	</div>
</div>





<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>