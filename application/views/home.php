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
			$('.dropdown-toggle').dropdown()		
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			  	<ul class="nav navbar-nav">
					<li><img src="/assets/images/lucy_doctor.jpeg" width="50px" /></li>
					<li class="active"><a href="#">Home</a></li>
					<li><a href="/main/about">About</a></li>
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
				<img class="pull-left" src="/assets/images/lucy_doctor.jpeg" width="150px">
				<h1 class="pull-right">Your Therapy Homework</h1>
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">I need help with... <span class="caret"></span></button>
				  	<ul class="dropdown-menu" role="menu">
<?php
foreach ($topics as $topic)
{?>
						<li><a href="/worksheets/worksheet/<?=$topic->id?>"><?=$topic->name?></a></li>
<?php
}?>
				  	</ul>

			</div>
		</div>





	</div><!--closes wrapper-->
</body>
</html>