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
			$('#add_topic').addClass('active');
			$('#new_question').hide();
			$('#another_section').hide();
			$('#new_topic').submit(function(){
				$.post(
					$(this).attr('action'), $(this).serialize(), function(data){
						console.log(data.id);
						$('#topic_errors').html("<strong>" + data.errors + "</strong>");
						if (data.added)
						{
							$("#topic_id").attr("value", data.id);
							$('#new_topic').hide();
							$('#new_question').show();
							$('#another_section').show();
						}
					}, 'json'
					);
				return false;
			});
			$("#new_question").submit(function(){
				var order = $("#order").val();
				order = parseInt(order);
				order += 1;
				$("#order").val(order);
				$.post(
					$(this).attr('action'), $(this).serialize(), function(data){

					}, 'json'
					);	
					$("#question").val("");					
					$("#keyword").val("");					

				return false;	
			});
			$('#another_section').submit(function(){
					$(this).hide();
					var order = $("#order").val();
					order = parseInt(order);
					order += 10;
					$("#order").val(order);
				return false;		

			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
	<?php include_once('include/nav_bar.php');?>
		<h1>Add Topic</h1>

		<form id="new_topic" role="form" action="/admin/process_add_topic" method="post">
			<label for="Topic Name">Topic Name:</label>
			<input type="text" class="form-control" name="topic_name" id="topic_name" />
			<label for="definition">Definition:</label>
			<input type="text" class="form-control" name="definition" id="definition" />
			<label for="emergency">Emergency:</label>
			<input type="text" class="form-control" name="emergency" id="emergency" />
			<label for="resources">Resources:</label>
			<input type="text" class="form-control" name="resources" id="resources" />
			<p>(Please include full URL and name of site.)</p>
			<input type="submit" class="btn btn-primary" value="Add Topic" />
		</form>
		<div id="topic_errors"></div>

		<form id="new_question" role="form" action="/admin/process_add_question" method="post">
			<label for="question">Question:</label>
			<input type="text" class="form-control" name="question" id="question" />
			<label for="keyword">Key word:</label>
			<input type="text" class="form-control" name="keyword" id="keyword" />
			<input type="hidden" id="order" name="order" value=1 />
			<input type="hidden" id="topic_id" name="topic_id" />
			<input type="submit" class="btn btn-default" value="Add Question" />
		</form>

		<form id="another_section" role="form" action="/admin/process_add_question" method="post">
			<p>These questions will go in the initial section.</p>
			<label>Done with this section?</label><br />
			<input type="submit" class="btn btn-default" value="Next Section" />
		</form>




	</div><!--closes wrapper-->
</body>
</html>



