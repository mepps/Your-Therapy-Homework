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
			$("#worksheets").addClass("active");
			$("#worksheet").hide();
			$("#result").hide()
			$("#save_worksheet").hide()			
			$("#start").submit(function(){
				$("#questions").hide();
				$("#worksheet").show();
				$.post(
					$(this).attr('action'), $(this).serialize(), function(data){
						$(".worksheet_id").val(data.id);

					}, 'json');
				return false;
			});
			$("#worksheet").submit(function(){
				$("#worksheet").hide();
				$("#result").show();
				$.post(
					$(this).attr('action'), $(this).serialize(), function(data){
						
						for (var x in data.answers)
						{
							$("#answers").append("<p>" + data.answers[x] + "</p>");
						}
					}, 'json');
				return false;
			});
			$("#additional_worksheet").submit(function(){
				$("#additional_worksheet").hide();
				$("#save_worksheet").show();			
				$.post(
					$(this).attr('action'), $(this).serialize(), function(data){
						for (var x in data.answers)
						{
							$("#answers").append("<p>" + data.answers[x] + "</p>");
						}
					}, 'json');
				return false;
			});
			$("#save_worksheet").submit(function(){
				$.post(
					$(this).attr('action'), $(this).serialize(), function(data){

					}, 'json');
				$(this).replaceWith("<h3>Saved!</h3>");
				return false;
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<?php include_once('include/nav_bar.php');?>

			<h2><?=$topic_selected->name?></h2>
			<div id="questions">
				<h3>What does this mean?</h3>
				<p><?=$topic_selected->definition?></p>
				<h3>When is it an emergency?</h3>
				<p class="explanation"><?=$topic_selected->emergency?></p>
				<h3>Where do I go for more help?</h3>
				<p class="explanation"><?=$topic_selected->resources?></p>

				<form id="start" action="/worksheets/new_worksheet" method="post">
					<label>My mood:</label>
					<input type="text" id="mood" name="mood" />
					<input type="hidden" name="topic_id" value=<?=$topic_selected->id?> />
					<input type="submit" class="btn btn-success" id="ready" value="I'm ready" />
				</form>
			</div>
			<form id="worksheet" role="form" action="/worksheets/process_worksheet" method="post">
		<?php		$section_divider = 10;
					foreach($questions as $question)
					if ($question->order<$section_divider)
		{?>
				<label><?=$question->question?></label>
				<input type="hidden" name="worksheet_id" class="worksheet_id" />
				<input type="hidden" name="keyword_<?=$question->id?>" value="<?=$question->keyword?>" />
				<input type="text" class="form-control question" name=<?=$question->id?> />
	<?	}?>
				<input type="submit" id="change" class="btn btn-success" value="How can I change?" />
			</form>

			<div id="result">
				<div id="answers"></div>
				<form id="additional_worksheet" role="form" action="/worksheets/process_worksheet" method="post">
		<?php	foreach($questions as $question)
					if ($question->order>$section_divider)
		{?>
				<label><?=$question->question?></label>
				<input type="hidden" name="worksheet_id" class="worksheet_id" />
				<input type="hidden" name="keyword_<?=$question->id?>" value="<?=$question->keyword?>" />
				<input type="text" class="form-control question" name=<?=$question->id?> />
	<?	}?>
				<input type="submit" id="new" class="btn btn-success" value="See all my answers." />
					
				</form>
			</div>
			<?php if (isset($this->session->userdata('user')->id))
			{?>
			<form id="save_worksheet" action="/worksheets/user_save_worksheet" method="post">
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="worksheet_id" class="worksheet_id" />
				<input type="submit" class="btn btn-primary" value="Save Worksheet" />
			</form>
		<?	}
			else
				{echo "<a href='/user/login'><button id='save_worksheet' class='btn btn-primary'>Log In to Save Worksheets</button></a>";}?>



		<ul class="nav nav-tabs navbar-fixed-bottom">
<?php
foreach ($topics as $topic)
{
		if ($topic->id==$topic_selected->id)
		{?>
			<li class="active"><a href="/worksheets/worksheet/<?=$topic->id?>"><?=$topic->name?></a></li>
	<?	}
	else
		{
		?>	<li><a href="/worksheets/worksheet/<?=$topic->id?>"><?=$topic->name?></a></li>
<?php
		}
}?>
		</ul>





	</div><!--closes wrapper-->
</body>
</html>			

