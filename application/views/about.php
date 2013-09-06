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
					<li class="active"><a href="#">About</a></li>
					<li><a href="/worksheets/all_topics">Worksheets</a></li>
					<?php if (isset($this->session->userdata('user')->id))
					 echo '<li><a href="/worksheets/view_saved/'. $this->session->userdata('user')->id.'">Saved Worksheets</a></li>';?>
		    	</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><?php if (isset($this->session->userdata('user')->id))
					 echo '<a href="/user/logoff">Log Off</a></li>';
					 else 
					 echo '<a href="/user/login">Log In</a></li>'; ?>
				</ul>
			</div>
		</nav>


		<div class="jumbotron">
			<div class="container">
				<h1>Your Therapy Homework</h1>
				<p>This is a project to help people work on therapeutic goals independently. The writer is a Licensed Graduate Social Worker in DC, but is only trying to create a tool to supplement therapy. If you are in serious need of help, please contact the proper authorities, or look at the resources we have provided. </p>
			</div>
		</div>





	</div><!--closes wrapper-->
</body>
</html>