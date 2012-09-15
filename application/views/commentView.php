<div class='container'>
	<div class='span2'>
		<?php echo '<p><strong>'.$User_Name.'</strong></p>';
			echo date_format(date_create($time), 'H:i ');
			echo date_format(date_create($time), '(d-m-Y)');
		?>
	</div>
	<div class='span9'>
		<?php
			echo '<div class="well"><p>'.$Comment.'</p></div>';
		?>
	</div>
</div>
