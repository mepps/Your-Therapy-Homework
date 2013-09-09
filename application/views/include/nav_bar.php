		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			  	<ul class="nav navbar-nav">
					<li><img src="/assets/images/lucy_doctor.jpeg" width="50px" /></li>
					<li id="home"><a href="/">Home</a></li>
					<li id="about"><a href="/main/about">About</a></li>
					<li id="worksheets"><a href="/worksheets/all_topics">Worksheets</a></li>
					<?php 
					if (isset($this->session->userdata('user')->id))
					{
						echo '<li id="saved_worksheets"><a href="/worksheets/view_all_saved/'. $this->session->userdata('user')->id.'">Saved Worksheets</a></li>';
						if ($this->session->userdata('user')->admin_level==9)
						{
							echo '<li id="add_topic"><a href="/admin/add_topic">Add Topic</a></li>';
						}
					}
					?>
		    	</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="user_function"><?php if (isset($this->session->userdata('user')->id))
					 echo '<a href="/user/logoff">Log Off</a>';
					 else 
					 echo '<a href="/user/login">Log In</a>'; ?></li>
				</ul>
			</div>
		</nav>