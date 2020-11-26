<?php
$id=$_GET["id"];
$db = mysqli_connect('localhost','root','','traicord') or die('Error connecting to MySQL server.');
$query = "UPDATE applications SET application_status_admin='A' WHERE application_no=$id";
$result = mysqli_query($db,$query); 
if ($result){
    header("location:http://localhost/Dashboard_file/WebDashboardAdmin/Admin_Dashboard.php");
}
?>