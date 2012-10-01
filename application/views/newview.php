<div class='container'>
	<?php echo form_open('projects/NewProject'); ?>
	<div class='row-fluid'>
	<div class='span6'>
		<h2>Project Submission Form</h2>
		<input class='btn btn-primary' type='submit' value='Submit Project'/>
	</div>
	<div class='span6'>
	<p>
		<span class="label label-important">Red</span> highlighted fields are required.
		<br />
		<span class="label label-default">Grey</span> highlighted fields are optional.
	</p>
	</div>
	</div>
	<div class='row-fluid'>
		<div class='span6'>
			<legend>Project Name</legend>
			<?php echo form_error('project_nick'); ?>
			<?php echo form_error('project_name'); ?>
			<input type="text" name='project_nick' value='<?php echo set_value('project_nick') ?>' placeholder="Project Acronym">
			<br />
			<div class='control-group error'>
				<input id='inputWarning' type="text" name='project_name' value='<?php echo set_value('project_name') ?>' placeholder="Project Full Name">
			</div>
		</div>
		<div class='span6'>
			<legend>Committee</legend>
			<?php echo form_error('committee[]'); ?>
			<div class='control-group error'>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='OpComm' <?php echo set_checkbox("committee[]",'OpComm') ?> />OpComm
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='R&D' <?php echo set_checkbox("committee[]",'R&D') ?>/>R&D
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Social' <?php echo set_checkbox('committee[]','Social') ?>/>Social
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='History' <?php echo set_checkbox('committee[]','History') ?>/>History
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Eval' <?php echo set_checkbox('committee[]','Eval') ?>/>Eval
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Financial' <?php echo set_checkbox('committee[]','Financial') ?>/>Financial
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Other' <?php echo set_checkbox('committee[]','Other') ?>/>Other
			</label>
			</div>
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
					<div class='control-group error'>
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
							echo form_dropdown('status',$options,set_value('status'),"id='inputWarning'") ?>
					</div>
					<?php echo form_error('team'); ?>
					<?php echo form_label('Team Members','team'); ?>
					<div class='control-group error'>
						<input id='inputWarning' class="text" type="text" name="team" placeholder="Team" value=<?php echo $username ?>>
					</div>
				</div>
				<div class='span6'>
					<?php echo form_label('Project Difficulty','difficulty') ?>
					<?php echo form_error('difficulty'); ?>
					<div class='control-group error'>
					<select id='inputWarning' name="difficulty">
						<?php for($x=0;$x<11;$x++){
							switch($x){
								case 0:
									echo "<option ";
									echo (set_value('difficulty') == $x) ? 'selected ' : '';
									echo "value=$x>Unsure</option>";
									break;
								case 1:
									echo "<option ";
									echo (set_value('difficulty') == $x) ? 'selected ' : '';
									echo "value=$x>$x - 30 second project</option>";
									break;
								case 10:
									echo "<option ";
									echo (set_value('difficulty') == $x) ? 'selected ' : '';
									echo "value=$x>$x - Induces Panic Attacks</option>";
									break;
								default:
									echo "<option ";
									echo (set_value('difficulty') == $x) ? 'selected ' : '';
									echo "value=$x>$x</option>";
									break;
							}
						} ?>
					</select>
					</div>
					<?php echo form_error('related'); ?>
					<?php echo form_label('Related Projects','related') ?>
					<input type="text" name="related" value='<?php echo set_value('related') ?>' placeholder="Related Projects">
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
