<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
	<div class="container-fluid">
	  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </a>
	  <a class="brand" href="<?php echo base_url() ?>"><img style="width: 22px; height: 22px;" src="<?php echo base_url('/assets/img/csh_icon.png') ?>" class="img-rounded"></a>
	  <div class="nav-collapse">
		<ul class="nav">
			<li><?php echo anchor('projects/viewall','List All') ?></li>
			<li><?php echo anchor('projects/search/'.$username,'My Projects') ?></li>
			<li><?php echo anchor('projects/NewProject','New Project') ?></li>
		</ul>
		<ul class="nav pull-right">
			<li>
				<form class="navbar-search">
				<input type="text" placeholder="Quick Search">
				</form>
			</li>
			<li><?php echo anchor('projects/search/'.$username,"$realname ($username)") ?>
		</ul>
	  </div><!--/.nav-collapse -->
	</div>
  </div>
</div>
