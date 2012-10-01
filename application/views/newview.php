<div class='container'>
	<?php echo form_open('projects/NewProject'); ?>
	<h2>Project Submission Form</h2>
	<input class='btn btn-primary' type='submit' value='Submit Project'/>
	<input class='btn btn-warning' type='reset' value='Reset Project'/>
	<div class='row-fluid'>
		<div class='span6'>
			<legend>Project Name</legend>
			<?php echo form_error('project_nick'); ?>
			<?php echo form_error('project_name'); ?>
			<input type="text" name='project_nick' value='<?php echo set_value('project_nick') ?>' placeholder="Project Acronym">
			<br />
			<input type="text" name='project_name' value='<?php echo set_value('project_name') ?>' placeholder="Project Full Name">
		</div>
		<div class='span6'>
			<legend>Committee</legend>
			<?php echo form_error('committee[]'); ?>
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
				<input name="committee[]" type="checkbox" value='Financial' />Financial
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Other' />Other
			</label>
		</div>
	</div>
	<div class='row-fluid'>
		<div class='span6'>
			<legend>General Information</legend>
			<?php echo form_error('info'); ?>
			<?php echo form_error('source'); ?>
			<textarea class='span11' name="info" placeholder="Project Info" rows=3><?php echo set_value('info') ?></textarea>
			<br />
			<input class='span11' type="text" name="source" value='<?php echo set_value('source') ?>' placeholder="Source link">
		</div>
		<div class='span6'>
			<legend>Specific Information</legend>
			<div class='row-fluid'>
				<div class='span6'>
					<?php echo form_error('status'); ?>
					<?php echo form_label('Project Status','status'); ?>
					<?php $options = array('Choose One...',
						"Idea Phase" => "Idea Phase",
						"Planning Phase" => "Planning Phase",
						"In Development" => "In Development",
						"Completed" => "Completed",
						"Deployed & Completed" => "Deployed & Completed",
						"Deployed & Forgotten" => "Deployed & Forgotten",
						"Deployed & In Development" => "Deployed & In Development",
						"CSH Done" => "CSH Done",
						"Broken & Forgotten" => "Broken & Forgotten",
						"Cursed" => "Cursed");
						echo form_dropdown('status',$options) ?>
					<?php echo form_label('Project Difficulty','difficulty') ?>
					<?php echo form_error('difficulty'); ?>
					<select name="difficulty">
						<?php for($x=0;$x<11;$x++){echo ($x == 0 ? "<option>Unsure</option>" : "<option>$x</option>");}; ?>
					</select>
				</div>
				<div class='span6'>
					<?php echo form_error('team'); ?>
					<?php echo form_label('Team Members','team'); ?>
					<input class="text" type="text" name="team" placeholder="Team" value=<?php echo $username ?>>
					<?php echo form_error('related'); ?>
					<?php echo form_label('Related Projects','related') ?>
					<input type="text" name="related" value='<?php echo set_value('related') ?>' placeholder="Related Projects">
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
