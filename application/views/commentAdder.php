<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class='container'>
	<legend>Comments</legend>
	<div class='container'>
		<div class='span10 offset2'>
			<?php $this->comments->commentform(uri_string()) ?>
		</div>
	</div>
</div>
