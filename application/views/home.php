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
			$("#home").addClass("active");
			$('.dropdown-toggle').dropdown()		
		});
	</script>
</head>
<body>
		<?php include_once('include/nav_bar.php');?>


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