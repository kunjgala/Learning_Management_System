<!DOCTYPE html>
<html>
<head>
  <title>Application_Form</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="MP_application.css">
</head>
<body>

<?php
session_start();
?>    


<?php
if(isset($_POST['email']) ) {

$cookie_value1=$_POST['email'];
setcookie('email',$cookie_value1, time() + 3600, '/');


}
?>




<!--php validation-->
<?php
$institution_nameErr = $durationErr = $start_dateErr = $end_dateErr = $fundsErr = $TP_filesizeErr = $AL_filesizeErr = $Sub_filesizeErr = $addressErr = $priorityErr = $statusMsg ="";

$address = $train_proof = $sub_emp = $app_letter = $institution_name = $duration = $start_date = $end_date = $funds = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

//instituion name validation
  if (empty($_POST["institution_name"])) {
    $institution_nameErr = "Institution Name is required";
  } else {
  $institution_name = test_input($_POST["institution_name"]);
  $institution_name = trim($institution_name," ");
    if (!preg_match("/^[a-zA-Z-' ]*$/",$institution_name)) {
      $institution_nameErr = "Enter a valid Institution Name";
      $institution_name = "";
    }
  }


 //address validation
  if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
  $address = test_input($_POST["address"]);
  $address = trim($address," ");
  }


 //funds validation
  if (empty($_POST["funds"])) {
    $fundsErr = "Numerical amount required";
  } else {
  $funds = test_input($_POST["funds"]);
  $funds = trim($funds," ");
    if (preg_match("/^[a-zA-Z-' ]*$/",$funds)) {
      $fundsErr = "Enter numericals only";
      $funds = "";
    }
  }

 //duration validation
  if (empty($_POST["duration"])) {
    $durationErr = "Duration required";
  } else {
  $duration = test_input($_POST["duration"]);
  $duration = trim($duration," ");
    if (preg_match("/^[a-zA-Z-' ]*$/",$duration)) {
      $durationErr = "Enter numericals only";
      $duration = "";
    }
  }

 //start-date validation
  if (empty($_POST["start_date"])) {
    $start_dateErr = "Start date is required";
  } else {
    $start_date = test_input($_POST["start_date"]);
    $date = date("d-m-yy");
    $start_date_arr  = explode('/', $start_date);
  if (!checkdate($start_date_arr[1], $start_date_arr[0], $start_date_arr[2])) {
      $start_dateErr = "Enter Valid start date ";
  }
    $start_date_t = strtotime($start_date_arr[0].'-'.$start_date_arr[1].'-'.$start_date_arr[2]);
    $date_t = strtotime($date);
    if($start_date_t <= $date_t)
    {
      $start_dateErr = "Enter a valid date";
      echo $start_date_t;
      echo strtotime(date("d-m-yy"));
    }
    }


  //end-date validation
  if (empty($_POST["end_date"])) {
    $end_dateErr = "End date is required";
  } else {
    $end_date = test_input($_POST["end_date"]);
    $end_date_arr  = explode('/', $end_date);
  if (!checkdate($end_date_arr[1], $end_date_arr[0], $end_date_arr[2])) {
      $end_dateErr = "Enter Valid End Date";
  }
    $end_date_t = strtotime($end_date);
    $start_date_t = strtotime($start_date);
    if($end_date_t < $start_date_t)
    {
        $end_dateErr = "End date cannot be before start date";
    }
    }
  //priority validation
    
  if (empty($_POST["priority"])) {
    $priorityErr = "Priority selection is required";
  } else {
  $priority = $_POST["priority"];
  }


  //file size validation
  if (empty($_FILES["sub_emp"]["name"])){
    $Sub_filesizeErr = "File is required";
  } elseif ($_FILES["sub_emp"]["size"] > (5*1024*1024)) {
    $Sub_filesizeErr = "File size is exceeding the maximum size limit.Please upload a smaller file";
    }
  if (empty($_FILES["train_proof"]["name"])){
    $TP_filesizeErr = "File is required";
  } elseif ($_FILES["train_proof"]["size"] > (5*1024*1024)) {
    $TP_filesizeErr = "File size is exceeding the maximum size limit.Please upload a smaller file";
    }
  if (empty($_FILES["app_letter"]["name"])){
    $AL_filesizeErr = "File is required";
  } elseif ($_FILES["app_letter"]["size"] > (5*1024*1024)) {
    $AL_filesizeErr = "File size is exceeding the maximum size limit.Please upload a smaller file";
    }


  if($institution_nameErr == "" && $durationErr == "" &&  $start_dateErr == "" &&  $end_dateErr == "" &&  $fundsErr == "" &&  $TP_filesizeErr == "" &&  $AL_filesizeErr == "" &&  $Sub_filesizeErr == "" &&  $addressErr == "" &&  $priorityErr == "" ){


    $target_dir = "uploads/";
    $sub_empFileName = $target_dir . md5(time() . rand()) . '.' . strtolower(pathinfo(basename($_FILES["sub_emp"]["name"]),PATHINFO_EXTENSION));
    $train_proofFileName = $target_dir . md5(time() . rand()) . '.' . strtolower(pathinfo(basename($_FILES["train_proof"]["name"]),PATHINFO_EXTENSION));
    $app_letterFileName = $target_dir . md5(time() . rand()) . '.' . strtolower(pathinfo(basename($_FILES["app_letter"]["name"]),PATHINFO_EXTENSION));

    if (!move_uploaded_file($_FILES["sub_emp"]["tmp_name"], $sub_empFileName)) {
        //Show File Upload Error
        die('Error occured while uploading sub_emp');
    }

    if (!move_uploaded_file($_FILES["train_proof"]["tmp_name"], $train_proofFileName)) {
        //Show File Upload Error
        die('Error occured while uploading train_prrof');
    }

    if (!move_uploaded_file($_FILES["app_letter"]["tmp_name"], $app_letterFileName)) {
        //Show File Upload Error
        die('Error occured while uploading app_letter');
    }
    $email = $_SESSION["email"];
    $_SESSION["institution_name"] = $institution_name;
    $_SESSION["address"]= $address;
    $_SESSION["duration"] = $duration;
    $_SESSION["funds"]= $funds;
    $_SESSION["start"]= $start_date;
    $_SESSION["end"]=$end_date;
    $_SESSION["priority"]=$priority;
    $_SESSION["sub_emp"] = $sub_empFileName;
    $_SESSION["train_proof"] = $train_proofFileName;
    $_SESSION["app_letter"] = $app_letterFileName;
    //header("location: session_set.php");
    $db = mysqli_connect('localhost','root','','traicord') or 
        die('Error connecting to MySQL server.');
        $order = "INSERT INTO applications
                (institution_name, address, duration, start_date, end_date, funds, priority,email,trainproof,applicationletter,workadjustment)
                VALUES
                ('$institution_name','$address', '$duration', '$start_date', '$end_date', '$funds', '$priority','$email','$train_proofFileName','$app_letterFileName','$sub_empFileName')";


        $result = mysqli_query($db,$order); //order executes

    if($_SESSION["employee_type"]=="HOD"){
      echo "<script>window.top.location='http://localhost/Dashboard_file/WebDashboardHod/Hod_Dashboard.php'</script>";
    } else if($_SESSION["employee_type"]=="Admin"){
      echo "<script>window.top.location='http://localhost/Dashboard_file/WebDashboardAdmin/Admin_Dashboard.php'</script>";
    } else{
      //header("http://localhost/Dashboard_file/WebDashboardEmployee/Employee_Dashboard.php");
      echo "<script>window.top.location='http://localhost/Dashboard_file/WebDashboardEmployee/Employee_Dashboard.php'</script>";
    }  
    mysqli_close($db);
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

<div class="apllication">
    <div class="row">
      <div class="col-sm-3 left_fill_background">
      <img id="application_image" src="application.png">  
      </div>
      <div class="col-sm-9 sign_up_background">
        <h1>Application form: </h1>
        <br>
          <div class="row row1">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <div class="col-sm-3 sign_up_labels" required>Institution Name:</div>
                <div class="col-sm-9 sign_up_inputs"><input type="text" name="institution_name" id="name" placeholder="Enter Institution Name">
                <span class="error">* <?php echo $institution_nameErr;?></span>
                </div>

            <br><br><br>
            <div class="col-sm-3 sign_up_labels">Duration (in hours):</div>
        <div class="col-sm-9 sign_up_inputs"><input type="text" name="duration" id="duration" placeholder="Enter duration ">
        <span class="error">* <?php echo $durationErr;?></span>
        </div>
    
            <br><br><br>
            <div class="col-sm-3 sign_up_labels">Start Date:</div>
        <div class="col-sm-9 sign_up_inputs"><input type="text" name="start_date" id="start_date" placeholder="dd/mm/yyyy">
        <span class="error">* <?php echo $start_dateErr;?></span>
        </div>
        
            <br><br><br>
            <div class="col-sm-3 sign_up_labels" required>End Date:</div>
        <div class="col-sm-9 sign_up_inputs"><input type="text" name="end_date" id="end_date" placeholder="dd/mm/yyyy">
        <span class="error">* <?php echo $end_dateErr;?></span>
        </div>
      
            <br><br><br>
            <div class="col-sm-3 sign_up_labels" required>Address:</div>
        <div class="col-sm-9 sign_up_inputs"><textarea id="address" name="address" rows="4" cols="50" placeholder="Enter Address"></textarea>
        <span class="error">* <?php echo $addressErr;?></span>
        </div>
      
        <br><br><br><br><br>
            <div class="col-sm-3 sign_up_labels">Funds Required:</div>
        <div class="col-sm-9 sign_up_inputs"><input type="text" name="funds" id="money" placeholder="Enter 00 if not required">
        <span class="error">* <?php echo $fundsErr;?></span>
        </div>

        <br><br><br><br><br>
            <div class="col-sm-3 sign_up_labels">Priority (High indicates : urgent) </div>
        <div class="col-sm-9 sign_up_inputs"><input type="radio" name="priority" id="priority" value="High">High
          <input type="radio" name="priority" id="priority" value="Medium">Medium
          <input type="radio" name="priority" id="priority" value="Low">Low
        <span class="error">* <?php echo $priorityErr;?></span>
        </div>

        <br><br><br>
            <div class="col-sm-3 sign_up_labels">Training Proof:</div>
        <div class="col-sm-9 sign_up_inputs"><input type="file" id="train_proof" name="train_proof">
        <span class="error">* <?php echo $TP_filesizeErr;?></span>
        </div>

        <br><br><br>
            <div class="col-sm-3 sign_up_labels">Application Letter:</div>
        <div class="col-sm-9 sign_up_inputs"><input type="file" id="app_letter" name="app_letter">
        <span class="error">* <?php echo $AL_filesizeErr;?></span>
        </div>

        <br><br><br>
            <div class="col-sm-3 sign_up_labels">Work Adjustment:</div>
        <div class="col-sm-9 sign_up_inputs">
            <input type="file" id="sub_emp" name = "sub_emp">
        <span class="error">* <?php echo $Sub_filesizeErr;?></span>
        </div>
        
        

        <br><br><br>
            <div class="col-sm-3 sign_up_labels" required>Other Details:</div>
        <div class="col-sm-9 sign_up_inputs"><textarea id="details" name="details" rows="4" cols="50" placeholder="Optional" ></textarea></div>

            
         
        <br><br><br><br><br><br>
        <div class="col-sm-3">
        <input class="btn"  style="background-color:#4CBB17;color:white;" type="submit" name="" >
                </div>
        
        
        
            </form>
          </div>
    </div>
    </div>
</div>




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>