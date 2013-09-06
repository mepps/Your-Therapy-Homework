<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Therapy Homework</title>
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
	<script src="/assets/js/jquery.min.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){
			$('.delete').submit(function(){
				confirm('Are you sure?');
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
					<li class="active"><a href="">Saved Worksheets</a></li>
		    	</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="login.php">Log Off</a></li>
				</ul>
			</div>
		</nav>

		<h1>Saved Worksheets</h1>
		<table class="table">
			<thead>
				<tr>
					<th>Date</th>
					<th>Topic</th>
					<th>Mood</th>
					<th>Delete</th>
				</tr>
			<thead>
			<tbody>
				<tr>
					<td>Ex</td>
					<td>Ex</td>
					<td>Ex</td>
					<td>
						<form class="delete" action="process.php" method="post">
							<input type="submit" value="Delete?" />
						<form>
					</td>
				</tr>
				<tr>
					<td>July 22, 2013</td>
					<td>Addiction</td>
					<td>Grouchy</td>
					<td>
						<form class="delete" action="process.php" method="post">
							<input type="submit" value="Delete?" />
						<form>
					</td>
				</tr>
			</tbody> 
		</table>

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