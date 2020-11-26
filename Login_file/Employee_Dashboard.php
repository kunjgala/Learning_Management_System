<!DOCTYPE html>
<html>
<head>
	<title>Employee Dashboard</title>
	<link rel="stylesheet" type="text/css" href="Dashboard.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
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
	        <a class="nav-link" id="backwhite" href="#">Application Form<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	      	<a class="nav-link" id="logout" href="http://localhost/Login_file/login_authentication.php">LOGOUT</a>
	      </li>
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <input class="form-control mr-sm-2" type="search" placeholder="Search Application" aria-label="Search">
	      <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
	    </form>
	   	<ul class="navbar-nav">
	      <li class="nav-item">
	        <a class="nav-link" id="profile" href="#">PROFILE<span class="sr-only">(current)</span></a>
	      </li>
	    </ul>
	  </div>
	</nav>
    <br>
	<div class="container"> 
        <div class="card bg-light text-dark">
		
        <div class="card-body">
		<h4 class="card-title">Training Program Name</h4>
		<p><strong>Institution Name:</strong></p>
		<p><strong>Start Date:</strong></p>
		<p><strong>End Date:</strong></p>
		<p><strong>Status: </strong><span class="badge badge-primary">Primary</span></p>
		
		</div>
    </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>