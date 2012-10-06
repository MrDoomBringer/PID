<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class='container'>
	<div class="row-fluid">
		<div class='well'>
			<table id='profile-table' class='table table-bordered table-striped'>
				<thead><tr>
					<th>Project Name</th>
					<th>Committee</th>
					<th>Difficulty</th>
					<th>Workers</th>
					<th>Status</th>
					<th>Last Modified</th>
					<th></th>
				</tr></thead>
				<tbody>
					<?php foreach($info_q as $row){ $this->profile->displayrow($row);} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
