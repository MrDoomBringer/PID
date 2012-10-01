<?php
function psqarray($single){
	return '{'.$single.'}';
}
function nullCheck($value){
	if($value == ''){
		return True;
	}else{
		return False;
	}
}
function clean($post){
	$post['Committee'] = psqarray(implode(',',$post['Committee']));
	$post['Credit'] = psqarray($post['Credit']);
	$post['Source'] = psqarray($post['Source']);
	if(nullCheck($post['Related'])){
		$post['Related'] = NULL;
	}else{
		$post['Related'] = psqarray($post['Related']);
	}
	return $post;
}
$this->submit = $this->projectsubmit;
$post = array();
$post['Project_Name'] = $_POST['project_name'];
$post['Info'] = $_POST['info'];
$post['Committee'] = $_POST['committee'];
$post['Difficulty'] = $_POST['difficulty'];
if(empty($_POST['source'])){
	$post['Source'] = NULL;
}else{
	$post['Source'] = $_POST['source'];
}
$post['Status'] = $_POST['status'];
$post['Credit'] = $_POST['team'];
if(empty($_POST['related'])){
	$post['Related'] = NULL;
}else{
	$post['Related'] = $_POST['related'];
}
$this->db->insert('Project_Ideas',clean($post));
redirect('projects/view/'.rawurlencode($post['Project_Name']));
?>
