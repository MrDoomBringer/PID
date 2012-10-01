<?php 
	$this->submit = $this->projectsubmit;
	$post = array();
	if(empty($_POST['project_nick'])){
		$redirect = rawurlencode($_POST['project_name']);
		$post['Project_Name'] = $_POST['project_name'];
		$post['Info'] = $_POST['info'];
	}else{
		$redirect = rawurlencode($_POST['project_nick']);
		$post['Project_Name'] = $_POST['project_nick'];
		$post['Info'] = $this->projectsubmit->camelCase($_POST['project_name']).$_POST['info'];
	}
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
	$this->db->insert('Project_Ideas',$this->projectsubmit->clean($post));
?>
