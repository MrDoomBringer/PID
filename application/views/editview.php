<?php function clean($data){
	return preg_replace('/[\{\}]/','',$data);
} ?>
<div class='container'>
	<?php echo form_open('projects/edit'); ?>
	<div class='row-fluid'>
	<div class='span6'>
		<h2>Project Edit Form</h2>
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
			<input type="text" name='project_nick' value='<?php echo $info_q->row()->Project_Acronym ?>' placeholder="Project Acronym">
			<br />
			<div class='control-group error'>
				<input id='inputWarning' type="text" name='project_name' value='<?php echo $info_q->row()->Project_Name ?>' placeholder="Project Full Name">
			</div>
		</div>
		<div class='span6'>
			<legend>Committee</legend>
			<?php echo form_error('committee[]'); ?>
			<div class='control-group error'>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='OpComm' <?php echo set_checkbox("committee[]",'OpComm') ?> <?php echo (strstr($info_q->row()->Committee,'OpComm')) ? 'checked ' : '' ?> />OpComm
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='R&D' <?php echo set_checkbox("committee[]",'R&D') ?><?php echo (strstr($info_q->row()->Committee,'R&D')) ? 'checked ' : '' ?>/>R&D
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Social' <?php echo set_checkbox('committee[]','Social') ?><?php echo (strstr($info_q->row()->Committee,'Social')) ? 'checked ' : '' ?>/>Social
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='History' <?php echo set_checkbox('committee[]','History') ?><?php echo (strstr($info_q->row()->Committee,'History')) ? 'checked ' : '' ?>/>History
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Eval' <?php echo set_checkbox('committee[]','Eval') ?><?php echo (strstr($info_q->row()->Committee,'Eval')) ? 'checked ' : '' ?>/>Eval
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Financial' <?php echo set_checkbox('committee[]','Financial') ?><?php echo (strstr($info_q->row()->Committee,'Financial')) ? 'checked ' : '' ?>/>Financial
			</label>
			<label class="checkbox inline">
				<input name="committee[]" type="checkbox" value='Other' <?php echo set_checkbox('committee[]','Other') ?><?php echo (strstr($info_q->row()->Committee,'Other')) ? 'checked ' : '' ?>/>Other
			</label>
			</div>
		</div>
	</div>
	<div class='row-fluid'>
		<div class='span6'>
			<legend>General Information</legend>
			<?php echo form_error('info'); ?>
			<?php echo form_error('source'); ?>
			<textarea class='span11' name="info" placeholder="Project Info" rows=3><?php echo $info_q->row()->Info ?></textarea>
			<br />
			<input class='span11' type="text" name="source" value='<?php echo clean($info_q->row()->Source) ?>' placeholder="Source link">
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
							"Old & Replaced" => "Old & Replaced",
							"Broken & Forgotten" => "Broken & Forgotten",
							"Cursed" => "Cursed");
							echo form_dropdown('status', $options,$info_q->row()->Status, "id='inputWarning'") ?>
					</div>
					<?php echo form_error('team'); ?>
					<?php echo form_label('Team Members','team'); ?>
					<div class='control-group error'>
						<input id='inputWarning' class="text" type="text" name="team" placeholder="Team" value=<?php echo clean($info_q->row()->Credit) ?>>
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
									echo ($info_q->row()->Difficulty == $x) ? 'selected ' : '';
									echo "value=$x>Unsure</option>";
									break;
								case 1:
									echo "<option ";
									echo ($info_q->row()->Difficulty == $x) ? 'selected ' : '';
									echo "value=$x>$x - 30 second project</option>";
									break;
								case 10:
									echo "<option ";
									echo ($info_q->row()->Difficulty == $x) ? 'selected ' : '';
									echo "value=$x>$x - Induces Panic Attacks</option>";
									break;
								default:
									echo "<option ";
									echo ($info_q->row()->Difficulty == $x) ? 'selected ' : '';
									echo "value=$x>$x</option>";
									break;
							}
						} ?>
					</select>
					</div>
					<?php echo form_error('related'); ?>
					<?php echo form_label('Related Projects','related') ?>
					<input type="text" name="related" value='<?php echo clean($info_q->row()->Related) ?>' placeholder="Related Projects">
				</div>
			</div>
		</div>
	</div>
	</form>
</div>
