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
	case "Done":
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
<?php
function strip($string){
	$string = preg_replace('/\,/',', ',$string);
	$string = preg_replace('/\"/','',$string);
	return preg_replace('/\{|\}/', '', $string);
}
function hreffix($string){
	$string = urlencode($string);
	return $string;
}
?>
<div class="container">
	<div class="hero-unit">
		<div class="row-fluid">
			<div class="span6 offset1">
				<div class="page-header">
					<h1><?php echo $info_q->row()->Project_Name ?></h1>
					<p>
					<?php $info = $info_q->row()->Info;
					$info = $this->typography->auto_typography($info);
					echo $info ?>
					<p><?php echo auto_link(strip($info_q->row()->Source)) ?></p>
					<?php ?>
					</p>
				</div>
			</div>
			<div class="span4 offset1">
				<div class="row-fluid">
					<div class="span10">
						<button class="btn btn-large btn-block disabled btn-<?php echo $status_color ?>" type="button"><strong><?php echo $status ?></strong></button>
					</div>
					<div class="span2">
						<button class="btn btn-large btn-block disabled btn-<?php echo $diff_color ?>" type="button"><strong><?php echo $diff ?></strong></button>
					</div>
				</div>
				<h3>Work Force</h3>
				<p><?php echo strip($info_q->row()->Credit) ?></p>
				<?php 
					$related = $info_q->row()->Related;
					if($related){
						echo "<h3>Related Projects</h3>";
						$blown = explode(',',strip($related));
						foreach($blown as $value){
							echo anchor('projects/view/'.hreffix($value),$value);
						}
					}
				?>
			</div>
		</div>
	</div>
	<div class="row-fluid">
	</div>
</div>
