<!DOCTYPE html>
<html>
<head>
	<title>Employee Dashboard</title>
	<link rel="stylesheet" type="text/css" href="Dashboard.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<?php 
		session_start();
		if(isset($_SESSION["email"])){

		
		$email_loggedin = $_SESSION["email"];
		$db = mysqli_connect('localhost','root','','traicord') or die('Error connecting to MySQL server.');
		$query = "SELECT * FROM applications WHERE email = '$email_loggedin';";
		$result = mysqli_query($db,$query); 
		$row = "";
		if ($result){
		$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
	        <a class="nav-link" href="#" id="backwhite">Home <span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item">
	        <a class="nav-link" id="backwhite" href="http://localhost/Application_file/application.php">Application Form<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	      	<a class="nav-link" id="logout" href="http://localhost/Login_file/login_authentication.php">LOGOUT</a>
	      </li>
	    </ul>
	   	<ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" id="profile" href="http://localhost/Profile_file/Edit_Profile.php">PROFILE<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	  </div>
	</nav>
    <br>
    
    <table class="table">
    	<thead>
		    <tr>
		      <th scope="col">No.</th>
		      <th scope="col">Institution Name</th>
		      <th scope="col">Start Date</th>
		      <th scope="col">End Date</th>
		      <th scope="col">Priority</th>
		      <th scope="col">Approval from HOD</th>
		      <th scope="col">Approval from Admin</th>
		    </tr>
		</thead>
		<tbody>
		  		<?php  
		  		if($row){
		  		for($i=0;$i<count($row);$i++){
		  			?>
		  			<tr>
		  			<td><?php echo ($i+1);?></td>
		  			<td><?php echo $row[$i]["institution_name"];?></td>
		  			<td><?php echo $row[$i]["start_date"];?></td>
		  			<td><?php echo $row[$i]["end_date"];?></td>
		  			<td><?php echo $row[$i]["priority"];?></td>
		  			<td><?php echo $row[$i]["application_status_hod"];?></td>
		  			<td><?php echo $row[$i]["application_status_admin"];?></td>
		  			</tr>
		  		<?php 
		  			}
		  		?>
		  		
		</tbody>
    </table>
    <?php 
		}
    	mysqli_close($db);}
    ?>
	<!-- <div class="container"> 
        <div class="card bg-light text-dark">
        <div class="card-body">
		<h4 class="card-title">Training Program Name</h4>
		<p><strong>Institution Name:</strong></p>
		<p><strong>Start Date:</strong></p>
		<p><strong>End Date:</strong></p>
		<p><strong>Status: </strong><span class="badge badge-primary">Primary</span></p>
		
		</div>
    </div>
    </div> -->

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>