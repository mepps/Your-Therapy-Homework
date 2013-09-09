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
			$(".user_function").addClass("active");
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

		<?php include_once('include/nav_bar.php');?>

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