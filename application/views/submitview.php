<?php
function camelCase($string){
	$string = preg_replace('/([A-Z])/','<u>$1</u>',$string);
	$string = '<h3>'.$string.'</h3>';
	return $string;
}

function psqarray($single){
	return '{'.$single.'}';
}

function clean($post){
	if($post['Difficulty'] == "Unsure"){
		$post['Difficulty'] = 0;
	}
	$post['Committee'] = psqarray(implode(',',$post['Committee']));
	$post['Credit'] = psqarray($post['Credit']);
	$post['Source'] = psqarray($post['Source']);
	$post['Related'] = psqarray($post['Related']);
	return $post;
}

$post = array(
	'Project_Name' => $_POST['project_nick'],
	'Info' => camelCase($_POST['project_name']).$_POST['info'],
	'Committee' => $_POST['committee'],
	'Difficulty' => $_POST['difficulty'],
	'Source' => $_POST['source'],
	'Status' => $_POST['status'],
	'Credit' => $_POST['team'],
	'Related' => $_POST['related']
)
?>

<div class="container">
	<?php $this->db->insert('Project_Ideas',clean($post)) ?>
</div>
