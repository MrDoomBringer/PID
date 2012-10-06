<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projects extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->library('table');
		$this->load->library('typography');
		$this->load->library('WebParent');
		$this->load->library('projectSubmit');
		$this->load->database();
		$this->webglobal = $this->webparent->webdata;
		$this->db->select('Project_Name');
		$query = $this->db->get('public.Project_Ideas');
		$this->webglobal['menuProjects'] = "";
	}
	public function index(){
		$this->webglobal['page_title'] = 'Home';
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		$this->load->view('footer');
	}
	public function viewall(){
		$this->load->library('ViewAll');
		$this->webglobal['page_title'] = 'ViewAll';
		$this->db->select('Project_Name,Project_Acronym,Committee,Difficulty,Credit,Status,Modified');
		$query = $this->db->get('public.Project_Ideas');
		$this->webglobal['info_q'] = $query;
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		$this->load->view('viewall',$this->webglobal);
		$this->load->view('footer');
	}
	public function Search($searchterm,$sample){
		$this->load->library('Search');
		$this->webglobal['page_title'] = 'Search';
		$this->db->select('Project_Name,Project_Acronym,Committee,Difficulty,Credit,Status,Modified');
		$query = $this->db->get('public.Project_Ideas');
		$newquery = array();
		if($sample == 'searchall'){
			$searchterm = $_POST['search'];
			foreach($query->result_array() as $row){
				if(strstr($row['Project_Name'],$searchterm)){$newquery[] = $row;};
				if(strstr($row['Project_Acronym'],$searchterm)){$newquery[] = $row;};
				if(strstr($row['Committee'],$searchterm)){$newquery[] = $row;};
				if(strstr($row['Credit'],$searchterm)){$newquery[] = $row;};
				if(strstr($row['Status'],$searchterm)){$newquery[] = $row;};
			}
		}else{
			foreach($query->result_array() as $row){
				if($sample == 'credit'){
					if(strstr($row['Credit'],$searchterm)){$newquery[] = $row;};
				}
			}
		}
		$this->webglobal['info_q'] = $newquery;
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		$this->load->view('searchview',$this->webglobal);
		$this->load->view('footer');
	}
	public function Edit($project){
		$this->load->library('form_validation');
		$project = rawurldecode($project);
		$this->db->select("Project_Acronym,Committee,Difficulty,Credit,Status,Info,Source,Related,Created,Modified,Project_Name");
		$query = $this->db->get_where('public.Project_Ideas',array('Project_Name'=>$project));
		$this->webglobal['info_q'] = $query;
		if ($this->webglobal['info_q']->num_rows() == 0){
			redirect('projects/error');
		}
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
		$this->form_validation->set_rules('project_nick','Project Acronym','min_length[2]|max_length[8]|callback__invalidChar');
		$this->form_validation->set_rules('project_name','Project Name','required|callback__invalidChar');
		$this->form_validation->set_rules('committee[]','Committee','callback__committeeCheck|callback__invalidChar');
		$this->form_validation->set_rules('info','Project Info','max_length[1000]|callback__invalidChar');
		$this->form_validation->set_rules('difficulty','Difficulty','callback__difficultyForm|callback__invalidChar');
		$this->form_validation->set_rules('source','Source','max_length[254]|prep_url|callback__invalidChar');
		$this->form_validation->set_rules('status','Status','callback__statusForm|callback__invalidChar');
		$this->form_validation->set_rules('team','Team','callback__invalidChar');
		$this->webglobal['page_title'] = 'Edit '.$project;
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		if($this->form_validation->run() == False){
			$this->load->view('editview',$this->webglobal);
		}else{
			$this->load->view('editSubmit',$this->webglobal);
		}
		$this->load->view('footer');
	}
	public function NewProject(){
		$this->webglobal['page_title'] = 'New';
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
		$this->form_validation->set_rules('project_nick','Project Acronym','min_length[2]|max_length[8]|callback__invalidChar');
		$this->form_validation->set_rules('project_name','Project Name','required|callback__invalidChar');
		$this->form_validation->set_rules('committee[]','Committee','callback__committeeCheck|callback__invalidChar');
		$this->form_validation->set_rules('info','Project Info','max_length[1000]|callback__invalidChar');
		$this->form_validation->set_rules('difficulty','Difficulty','callback__difficultyForm|callback__invalidChar');
		$this->form_validation->set_rules('source','Source','max_length[254]|prep_url|callback__invalidChar');
		$this->form_validation->set_rules('status','Status','callback__statusForm|callback__invalidChar');
		$this->form_validation->set_rules('team','Team','callback__invalidChar');
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		if($this->form_validation->run() == FALSE){
			$this->load->view('newview',$this->webglobal);
		}else{
			$this->load->view('projectSubmit',$this->webglobal);
		}
		$this->load->view('footer');
	}
	public function _invalidChar($value){
		$this->form_validation->set_message('_invalidChar', '%s has a invalid char');
		return !preg_match("/[^A-Za-z0-9\,\#\"\'\.\+\-\&\\s\:\/]/", $value);
	}
	public function _committeeCheck($value){
		$this->form_validation->set_message('_committeeCheck', '%s has a non valid input');
		switch($value){
			case "OpComm":
			case "R&D":
			case "Social":
			case "History":
			case "Eval":
			case "Financial":
			case "Other": return True;
			default: return False;
		}
	}
	public function _difficultyForm($value){
		$this->form_validation->set_message('_difficultyForm', '%s has a non valid input');
		if($value >= 0 && $value <= 10){
			return True;
		}else{
			return False;
		}
	}
	public function _statusForm($value){
		$this->form_validation->set_message('_statusForm', '%s is a non-valid input');
		$options = array('Idea Phase','Planning Phase','In Development','Completed',
						'Deployed & Completed','Deployed & Forgotten','Deployed & In Development',
						'CSH Done','Broken & Forgotten','Cursed');
		foreach($options as $key => $element){
			if($value == $element){
				return True;
			}
		}
		return False;
	}
	public function addComment(){
		$data = array('User_Name' => $this->webglobal['username']);
		if(empty($_POST['comment'])){
			$data['Comment'] = NULL;
		}else{
			$data['Comment'] = $_POST['comment'];
			$data['Comment'] = str_replace('<','&lt;',$data['Comment']);
			$data['Comment'] = str_replace('>','&gt;',$data['Comment']);
			$data['Comment'] = str_replace(' ','&nbsp;',$data['Comment']);
			$data['Comment'] = nl2br($data['Comment']);
		}
		if(empty($_POST['like'])){
			$data['Like'] = NULL;
		}else{
			$data['Like'] = $_POST['like'];
		}
		$data['Project_Name'] = preg_replace('/projects\/view\//','',$_POST['webpage']);
		$this->db->insert('Project_Comments',$data);
		redirect($_POST['webpage']);
	}
	public function view($project_name){
		$this->load->library('Comments');
		$name = urldecode($project_name);
		$this->webglobal['info_q'] = $this->db->get_where('Project_Ideas',array('Project_Name'=>$name));
		$this->db->order_by("Comment_ID asc");
		$this->webglobal['comment_q'] = $this->db->get_where('Project_Comments',array('Project_Name'=>$name));
		if ($this->webglobal['info_q']->num_rows() > 0){
			$this->webglobal['page_title'] = $name;
			$this->load->view('header',$this->webglobal);
			$this->load->view('menu',$this->webglobal);
			$this->load->view('projectview',$this->webglobal);
			// Comment Section
			$this->load->view('commentAdder');
			foreach($this->webglobal['comment_q']->result() as $row){
				$this->load->view('commentView',$row);
			}
			$this->load->view('footer');
		}else{
			redirect('projects/error');
		}
	}
	public function error(){
		$this->webglobal['page_title'] = "404";
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		$this->load->view('project404');
		$this->load->view('footer');
	}
}
