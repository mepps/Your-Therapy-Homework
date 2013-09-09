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
		<h1>Saved Worksheets</h1>
		<table class="table">
			<thead>
				<tr>
					<th>Date</th>
					<th>Topic</th>
					<th>Mood</th>
					<th>View</th>
<!-- 					<th>Delete</th>
 -->				</tr>
			<thead>
			<tbody>
<?php 	foreach ($worksheets as $worksheet)
{?>
				<tr>
					<td><?=$worksheet->created_at?></td>
					<td><?=$worksheet->topic_name?></td>
					<td><?=$worksheet->mood?></td>
					<td>
						<a href="/worksheets/view_saved/<?=$worksheet->id?>">View</a>
					</td>
<!-- 					<td>
						<form class="delete" action="worksheets/delete_worksheet" method="post">
							<input type="submit" value="Delete?" />
						<form>
					</td> -->
				</tr>
<?
}?>
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