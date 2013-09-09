<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Therapy Homework</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
	<script src="/assets/js/jquery.min.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#saved_worksheets").addClass("active");

			$('.delete').submit(function(){
				confirm('Are you sure?');
				return false;
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<?php include_once('include/nav_bar.php');?>



		<h2><?=$this->session->userdata('user')->first_name?>, you answered:</h2>

		<?php foreach ($worksheet_answers as $answer)
		{?>

			<h3><?=$answer->question?> </h3>
			<p><?=$answer->content?></p>


	<?	}?>

	</div><!--closes wrapper-->
</body>
</html>