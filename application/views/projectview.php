<?php
$diff = $info_q->row()->Difficulty;
$status = $info_q->row()->Status;
if ($diff == 0) {
	$diff = '???';
	$diff_color = 'info';
}elseif ($diff >= 1 && $diff <= 3) {
	$diff_color = 'info';
}elseif ($diff >= 4 && $diff <= 6) {
	$diff_color = 'warning';
}elseif ($diff >= 7 && $diff <= 9) {
	$diff_color = 'danger';
}elseif ($diff == 10) {
	$diff_color = 'inverse';
	$diff = 'PTSD';
}
switch ($status){
	case "In Progress":
		$status_color = 'warning';
		break;
	case "Complete":
		$status_color = 'success';
		break;
	case "Planning":
		$status_color = 'info';
		break;
	case "Abandonded";
		$status_color = 'error';
		break;
}
?>
<div class="container">
	<div class="hero-unit">
		<div class="row-fluid">
			<div class="span5 offset1">
				<div class="page-header">
					<h1><?php echo $info_q->row()->Project_Name ?></h1>
					<p><?php echo $info_q->row()->Info ?></p>
				</div>
			</div>
			<div class="span4 offset2">
				<button class="btn btn-large btn-block disabled btn-<?php echo $status_color ?>" type="button"><strong><?php echo $status ?></strong></button>
				<button class="btn btn-large btn-block disabled btn-<?php echo $diff_color ?>" type="button"><strong><?php echo $diff ?></strong></button>
				<br />
				<h2>Work Force</h2>
				<p><?php echo $info_q->row()->Credit ?></p>
			</div>
		</div>
	</div>
</div>
