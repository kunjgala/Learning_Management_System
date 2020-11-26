<!DOCTYPE html>  
<html>  
<head>  
<title>Mini Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css"> 
</head>  
<body>    
  
<?php  
session_start();
$_SESSION = array();
session_unset();
session_destroy();

// define variables to empty values  
$emailErr =  $passerr = $wrong = "";  
$email = "";  



  
//Input fields validation  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
      

   
    //Email Validation   
    if (empty($_POST["email"])) {  
            $emailErr = "Email is required";  
    } else {  
            $email = input_data($_POST["email"]);  
            // check that the e-mail address is well-formed  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                $emailErr = "Invalid email format";  
            }  
     }
     
     if(!empty($_POST["password"]) && $_POST["password"] != "" ){

      if (strlen($_POST["password"]) <= '8') {
          $passerr = "Your Password Must Contain At Least 8 Digits !";
      }
      elseif(!preg_match("#[0-9]+#",$_POST["password"])) {
          $passerr = "Your Password Must Contain At Least 1 Number !";
      }
      elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
          $passerr = "Your Password Must Contain At Least 1 Capital Letter !";
      }
      elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
          $passerr = "Your Password Must Contain At Least 1 Lowercase Letter !";
      }
      elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
          $passerr = "Your Password Must Contain At Least 1 Special Character !";
      }
  }else{
      $passerr = "";
  }  
   
/////////////////////////////////////////
$db = mysqli_connect('localhost','root','','traicord') or 
die('Error connecting to MySQL server.');
                    
$row = "SELECT * FROM users WHERE email= '$email'";
$result = mysqli_query($db,$row); //order executes
                  
if (mysqli_num_rows($result) == 0){
  $passerr = "No such user found!";
  mysqli_close($db); 
} 
else{
  $row1 = mysqli_fetch_array($result);
  if($row1['password_set'] == $_POST["password"]){
    //header("location:http://localhost/success.html");
    session_start();
    $_SESSION["first_name"] = $row1["first_name"];
    $_SESSION["last_name"] = $row1["last_name"];
    $_SESSION["email"] = $row1["email"];
    $_SESSION["department"] = $row1["department"];
    $_SESSION["employee_type"] = $row1["employee_type"];

    if($_SESSION["employee_type"] == "Admin"){
      header("location:http://localhost/Dashboard_file/WebDashboardAdmin/Admin_Dashboard.php");
    } else if($_SESSION["employee_type"] == "HOD"){
      header("location:http://localhost/Dashboard_file/WebDashboardHod/Hod_Dashboard.php");
    } else{
      header("location:http://localhost/Dashboard_file/WebDashboardEmployee/Employee_Dashboard.php");
    }
    mysqli_close($db);                
                        
    //if(isset($_POST["remember"]))
    //{
        //session_start();
        //$_SESSION["email"] = $_POST["email"];
        //header("location:http://localhost/WP2/mini/homepage/homepagefinal.php");
    //}
  }
  else{
    $passerr = "Username or Password incorrect!";
    mysqli_close($db);
    //header("location:http://localhost/no_success.html");

    //echo '<span style="color:red;">Invalid Password! Try Again</span><br><br>';
  }
}
///////////////////////////////////////// 
}
function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
}  

?>  
  
  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.html">SOMAIYA TRAINING PORTAL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item cta"><a href="http://localhost/Signup_file/MP_SIGNUP.php" class="nav-link"><span>SIGN UP</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->

    <div class="hero-wrap js-fullheight">
      <div class="overlay"></div>
      <div class="container-fluid px-0">
        <div class="row d-md-flex no-gutters slider-text align-items-center js-fullheight justify-content-start">
          <img class="one-third js-fullheight align-self-end order-md-first img-fluid" src="images/undraw_co-working_825n.svg" alt="">
          <div class="one-forth d-flex align-items-center ftco-animate js-fullheight">
            <div class="text mt-5">
              <span class="subheading">Train Coordinate Improve</span>
              <h1 class="mb-3"><span>TRAICORD</span></h1>
        <p><span>Already have an account?</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <span style="color:#00ff00;"><?php echo $passerr; ?></span>
            <?php  
              if(isset($_POST['submit'])) {
                 
                if($emailErr == "Email is required") {  
                  echo "<h5>$emailErr</h5>";
                } else {  
                  echo "<h5>$emailErr</h5>";  
                }
                if($passerr == "Your Password Must Contain At Least 8 Digits !") {
                  echo "<h5>Your Password Must Contain At Least 8 Digits !</h5>";
                }
                else if($passerr == "Your Password Must Contain At Least 1 Number !") {
                  echo "<h5>Your Password Must Contain At Least 1 Number !</h5>";
                } 
                else if($passerr == "Your Password Must Contain At Least 1 Capital Letter !") {
                  echo "<h5>Your Password Must Contain At Least 1 Capital Letter !</h5>";
                } 
                else if($passerr == "Your Password Must Contain At Least 1 Lowercase Letter !") {
                  echo "<h5>Your Password Must Contain At Least 1 Lowercase Letter !</h5>";
                } 
                else if($passerr == "Your Password Must Contain At Least 1 Special Character !") {
                  echo "<h5>Your Password Must Contain At Least 1 Special Character !</h5>";
                } 
                else{
                  echo " ";
                  if($emailErr == "" && $passerr == ""){
                    $email=$_POST["email"];
                    $pass=$_POST["password"];
                    $db = mysqli_connect('localhost','root','','credential') or 
                    die('Error connecting to MySQL server.');
                    
                    $row = "SELECT * FROM login WHERE email= '$email'";
                    $result = mysqli_query($db,$row); //order executes
                    if (mysqli_num_rows($result) == 0) {
                      echo "<p>No such user found!</p>";
                      mysqli_close($db);
                      header("location:http://localhost/wp_mini_proj/signup_form/MP_SIGNUP.php?message=failure"); //signup page ridirection
                      } else{
                        $row1 = mysqli_fetch_array($result);
                        if($row1['password'] == $pass){
                        mysqli_close($db);
                        header("location:http://localhost/Application_form/MP_application.php?message=success");
                       }
                       else{
                          mysqli_close($db);
                          echo "<p>Invalid Password! Try Again</p>";
                        }
                            
                 }
                  }
                  }
                  }
                    
            ?>
            <a href="http://localhost/Login_file/forgot_password.php"><p>Forgot Password?</p></a>
            <input type="submit" name="submit" value="Submit" class="loginbutton">  
      
        </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  
</body>  
</html>
