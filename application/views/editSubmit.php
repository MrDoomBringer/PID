<?php
function nullCheck($value){
	if($value == ''){
		return True;
	}else{
		return False;
	}
}
function psqarray($single){
	// surrounds string in curly braces
	return '{'.$single.'}';
}
function clean($data){
	$data['Committee'] = psqarray(implode(',',$data['Committee']));
	$data['Credit'] = psqarray($data['Credit']);
	$data['Source'] = psqarray($data['Source']);
	if(nullCheck($data['Related'])){
		$data['Related'] = NULL;
	}else{
		$data['Related'] = psqarray($data['Related']);
	}
	return $data;
}
$data = array();
$data['Project_Name'] = $_POST['project_name'];
$data['Info'] = $_POST['info'];
$data['Committee'] = $_POST['committee'];
$data['Difficulty'] = $_POST['difficulty'];
if(empty($_POST['source'])){
	$data['Source'] = NULL;
}else{
	$data['Source'] = $_POST['source'];
}
$data['Status'] = $_POST['status'];
$data['Credit'] = $_POST['team'];
if(empty($_POST['related'])){
	$data['Related'] = NULL;
}else{
	$data['Related'] = $_POST['related'];
}
$this->db->where('Project_Name',$data['Project_Name']);
$this->db->update('Project_Ideas',clean($data));
redirect('projects/view/'.rawurlencode($data['Project_Name']));
?>
