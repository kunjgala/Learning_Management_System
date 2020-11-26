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
// define variables to empty values  
$nameErr = $emailErr = $mobilenoErr = $genderErr = $websiteErr = $agreeErr = $passerr = "";  
$name = $email = $mobileno = $gender = $website = $agree =  "";  
  
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
            <li class="nav-item cta"><a href="#" class="nav-link"><span>SIGN UP</span></a></li>
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
        <p><span>Enter your Email-ID to reset password</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
      <input type="text" name="email" placeholder="Email">
      <input type="password" name="new_password" placeholder="Enter New Password">
      <input type="password" name="re_new_password" placeholder="Confirm New Password">
            <?php  
              if(isset($_POST['submit'])) {  
                if($emailErr == "Email is required") {  
                  echo "<h5>$emailErr</h5>";
                } else {  
                  echo "<h5>$emailErr</h5>";  
                }
                

              }  
            ?>
            <input type="submit" name="submit" value="Submit" class="loginbutton">  
      
        </form>
        <?php
  $new_password_Err = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $new_password=$_POST["new_password"];
  $email=$_POST["email"];
  $re_new_password=$_POST["re_new_password"];
  
    if(!empty($_POST["new_password"]) && !empty($_POST["re_new_password"])){
      if ($_POST["new_password"]!=$_POST["re_new_password"]) {
        $new_password_Err=  "Passwords does not match!"."<br>";
      }
      else{
        $db = mysqli_connect('localhost','root','','traicord') or 
        die('Error connecting to MySQL server.');

        $order = "UPDATE users SET password = '$new_password' WHERE email='$email';";


        $result = mysqli_query($db,$order); //order executes
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
    }
  }
  
?>
        
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