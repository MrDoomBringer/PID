<div class='container'>
	<div class='row'>
		<?php echo form_open('projects/projectSummit'); ?>
		<h1>Project Form</h1>
		<legend>Project Name</legend>
		<input type="text" name='project_nick' placeholder="Project Acronym">
		<br />
		<input type="text" name='project_name' placeholder="Project Full Name">
		<br />
		<legend>Committee</legend>
		<label class="checkbox inline">
			<input name="committee[]" type="checkbox" value='OpComm' />OpComm
		</label>
		<label class="checkbox inline">
			<input name="committee[]" type="checkbox" value='R&D' />R&D
		</label>
		<label class="checkbox inline">
			<input name="committee[]" type="checkbox" value='Social' />Social
		</label>
		<label class="checkbox inline">
			<input name="committee[]" type="checkbox" value='History' />History
		</label>
		<label class="checkbox inline">
			<input name="committee[]" type="checkbox" value='Eval' />Eval
		</label>
		<label class="checkbox inline">
			<input name="committee[]" type="checkbox" value='Financial' />Financhial
		</label>
		<br />
		<br />
		<legend>Information</legend>
		<textarea name="info" placeholder="Project Info" rows=3></textarea>
		<br />
		<select name="difficulty">
			<?php for($x=0;$x<11;$x++){echo ($x == 0 ? "<option>Unsure</option>" : "<option>$x</option>");}; ?>
		</select>
		<br />
		<input type="text" name="source" placeholder="Source link">
		<br />
		<select name="status">
			<option>In Progress</option>
			<option>Done</option>
			<option>Planning</option>
			<option>Abandonded</option>
		</select>
		<br />
		<input class="uneditable-input" type="text" name="team" placeholder="Team" value=<?php echo $username ?>>
		<br />
		<input type="text" name="related" placeholder="Related Projects">
		<br />
		<legend>Final Step</legend>
		<?php echo form_reset('Reset','Reset') ?>
		<?php echo form_submit('submit','Submit'); ?>
	</div>
</div>
