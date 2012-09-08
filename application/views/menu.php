<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container-fluid">
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="<?php echo base_url() ?>"><img style="width: 22px; height: 22px;" src="<?php echo base_url().'/assets/img/database.png'?>" class="img-rounded"></a>
	  <div class="nav-collapse">
		<ul class="nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Project View<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><?php echo anchor('projects/viewall','View All') ?></li>
					<li><a href="#">My Projects</a></li>
					<li><a href="#">Advanced Project Search</a></li>
				</ul>
			</li>
			<li><?php echo anchor('projects/NewProject','New Project') ?></li>
		</ul>
		<ul class="nav pull-right">
			<li>
				<form class="navbar-search">
				<input type="text" class="search-query" placeholder="Quick Search">
				</form>
			</li>
			<li><a href="#"><?php echo "$realname ( $username )" ?></a></li>
		</ul>
	  </div><!--/.nav-collapse -->
	</div>
  </div>
</div>
