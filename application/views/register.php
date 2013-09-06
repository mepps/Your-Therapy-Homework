<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Therapy Homework</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
	<script src="/assets/js/jquery.min.js"></script>	
	<script src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#register').submit(function(){
				$.post(
					$(this).attr('action'), $(this).serialize(), function(data){
						$('#errors').html("<strong>" + data.errors + "</strong>");
					}, 'json'
					);
				return false;
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			  	<ul class="nav navbar-nav">
					<li><img src="/assets/images/lucy_doctor.jpeg" width="50px" /></li>
					<li><a href="/">Home</a></li>
					<li><a href="/main/about">About</a></li>
					<li><a href="/worksheets/all_topics">Worksheets</a></li>
					<?php if (isset($this->session->userdata('user')->id))
					 echo '<li><a href="/user/worksheets/view_saved/'. $this->session->userdata('user')->id.'">Saved Worksheets</a></li>';?>
		    	</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="/user/register">Log In</a></li>
				</ul>
				</ul>
			</div>
		</nav>
		<h1>Registration</h1>

		<form id="register" role="form" action="process_registration" method="post">
			<label for="first_name">First Name:</label>
			<input type="text" class="form-control" name="first_name" id="first_name" />
			<label for="last_name">Last Name:</label>
			<input type="text" class="form-control" name="last_name" id="last_name" />
			<label for="email">Email:</label>
			<input type="text" class="form-control" name="email" id="email" />
			<label for="date_of_birth">Date of Birth:</label>
			<input type="date" class="form-control" name="date_of_birth" id="date_of_birth" />
			<label for="password">Password:</label>
			<input type="password" class="form-control" name="password" id="password" />
			<label for="confirm_password">Confirm Password:</label>
			<input type="password" class="form-control" name="confirm_password" id="confirm_password" />
			<input type="submit" class="btn btn-default" value="Register" />
		</form>
		<p>Already have an account? <a href="/user/login">Log in.</a></p>
		<div id="errors"></div>





	</div><!--closes wrapper-->
</body>
</html>



