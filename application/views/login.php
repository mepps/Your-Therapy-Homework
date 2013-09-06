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
			$('#login').submit(function(){
				$.post(
					$(this).attr('action'), $(this).serialize(), function(data){
						$('#errors').html("<strong>" + data.errors + "</strong>");
						if (data.logged_in == true)
						{
							window.location.replace("/"); 
						}
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
					<li class="active"><a href="/user/login">Log In</a></li>
				</ul>
			</div>
		</nav>
		<h1>Log In</h1>

		<form id="login" action="/user/process_login" method="post" role="form">
				<label for="email">Email:</label>
				<input type="text" class="form-control" name="email" id="email" />
				<label for="password">Password:</label>
				<input type="password" class="form-control" name="password" id="password" />
				<input type="submit" class="btn btn-default" class="form-control" value="Log In" />
		</form>

		<p>Don't have an account yet? <a href="/user/register">Register.</a></p>
		<div id="errors"></div>


		



	</div><!--closes wrapper-->
</body>
</html>