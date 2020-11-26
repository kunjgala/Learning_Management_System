<?php
session_start();
?>
<html>
<head>
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../Dashboard_file/WebDashboardEmployee/Dashboard.css">
</head>
<body>

    <P>Application is successfully sent</p>
    <p>You have successfully applied for training program offered by <?php echo $_SESSION["institution_name"] ?></p>
    <p>With a duration of <?php echo $_SESSION["duration"] ?>hours</p>
    <p>and fund requirement of Rs. <?php echo $_SESSION["funds"] ?></p>
    <?php

        
        $institution_name = $_SESSION["institution_name"];
        $address = $_SESSION["address"];
        $duration = $_SESSION["duration"];
        $funds = $_SESSION["funds"];
        $start_date = $_SESSION["start"];
        $end_date = $_SESSION["end"];
        $priority = $_SESSION["priority"];
        $email = $_SESSION["email"];
        $sub_empFileName = $_SESSION["sub_emp"];
        $train_proofFileName = $_SESSION["train_proof"];
        $app_letterFileName = $_SESSION["app_letter"];
        /*echo $institution_name;
        echo "<br>";
        echo $address;
        echo "<br>";
        echo $duration;
        echo "<br>";
        echo $start_date;
        echo "<br>";
        echo $end_date;
        echo "<br>";
        echo $funds;
        echo "<br>";
        echo $priority;
        echo "<br>";
        echo $email;*/
        $db = mysqli_connect('localhost','root','','traicord') or 
        die('Error connecting to MySQL server.');
        $order = "INSERT INTO applications
                (institution_name, address, duration, start_date, end_date, funds, priority,email,trainproof,applicationletter,workadjustment)
                VALUES
                ('$institution_name','$address', '$duration', '$start_date', '$end_date', '$funds', '$priority','$email','$train_proofFileName','$app_letterFileName','$sub_empFileName')";


        $result = mysqli_query($db,$order); //order executes

        
        if($result){
            echo("<br>Input data is succeed");
        } else{
            echo("<br>Input data is fail");
        }

        
    ?>
            <?php if($_SESSION["employee_type"]=="HOD"){?>
                <a class="nav-link" href="http://localhost/Dashboard_file/WebDashboardHod/Hod_Dashboard.php" id="backwhite">Home <span class="sr-only">(current)</span></a>
            <?php } else if($_SESSION["employee_type"]=="Admin"){?>
                <a class="nav-link" href="http://localhost/Dashboard_file/WebDashboardAdmin/Admin_Dashboard.php" id="backwhite">Home <span class="sr-only">(current)</span></a>
            <?php } else{ ?>
                
                 <a class="nav-link" href="http://localhost/Dashboard_file/WebDashboardEmployee/Employee_Dashboard.php" id="backwhite">Home <span class="sr-only">(current)</span></a> 
           <?php } ?>

    
</body>
<html>