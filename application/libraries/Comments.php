<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments{
	public function commentform($webpage){
		$style = array(
			'name' => 'comment',
			'rows' => 3,
			'placeholder' => 'Respond to this project'
		);
		echo form_open('projects/addcomment');
		echo form_hidden('webpage',$webpage);
		echo form_textarea($style);
		echo br();
		echo form_submit('submit','Submit');
	}
}
