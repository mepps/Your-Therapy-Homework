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
			$("#worksheet").hide();
			$("#result").hide()
			$("#save_worksheet").hide()			
			$("#ready").click(function(){
				$("#questions").hide();
				$("#worksheet").show();
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
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			  	<ul class="nav navbar-nav">
					<li><img src="/assets/images/lucy_doctor.jpeg" width="50px" /></li>
					<li ><a href="/">Home</a></li>
					<li><a href="/main/about">About</a></li>
					<li class="active"><a href="">Worksheets</a></li>
					<?php if (isset($this->session->userdata('user')->id))
					 echo '<li><a href="/worksheets/view_saved/'. $this->session->userdata('user')->id.'">Saved Worksheets</a></li>';?>
		    	</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><?php if (isset($this->session->userdata('user')->id))
					 echo '<a href="/user/logoff">Log Off</a>';
					 else 
					 echo '<a href="/user/login">Log In</a>'; ?></li>
				</ul>
			</div>
		</nav>

			<h2><?=$topic_selected->name?></h2>
			<div id="questions">
				<h3>What does this mean?</h3>
				<p><?=$topic_selected->definition?></p>
				<h3>When is it an emergency?</h3>
				<p class="explanation"><?=$topic_selected->emergency?></p>
				<h3>Where do I go for more help?</h3>
				<p class="explanation"><?=$topic_selected->resources?></p>

				<button class="btn btn-success" id="ready">I'm ready to start my homework</button>
			</div>
			<form id="worksheet" role="form" action="/worksheets/process_worksheet" method="post">
		<?php		$section_divider = 10;
					foreach($questions as $question)
					if ($question->order<$section_divider)
		{?>
				<label><?=$question->question?></label>
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
				<input type="hidden" name="keyword_<?=$question->id?>" value="<?=$question->keyword?>" />
				<input type="text" class="form-control question" name=<?=$question->id?> />
	<?	}?>
				<input type="submit" id="new" class="btn btn-success" value="See all my answers." />
					
				</form>
			</div>
			<?php if (isset($this->session->userdata('user')->id))
			{?>
			<form id="save_worksheet" action="/worksheets/save_worksheet" method="post">
				<input type="hidden" name="action" value="save" />
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

