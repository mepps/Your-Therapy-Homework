<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Therapy Homework</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
	<script src="/assets/js/jquery.min.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#worksheets").addClass("active");
		});
	</script>
</head>
<body>
		<?php include_once('include/nav_bar.php');?>

		<h2>Why did you come here?</h2>

		<p>See below for a list of topics.</p>
		<ul class="nav nav-tabs navbar-fixed-bottom">
<?php
foreach ($topics as $topic)
{?>
			<li><a href="/worksheets/worksheet/<?=$topic->id?>"><?=$topic->name?></a></li>
<?php
}?>
		</ul>

	</div><!--closes wrapper-->
</body>
</html>