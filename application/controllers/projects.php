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
		foreach($query->result_array() as $row){
			$this->webglobal['menuProjects'] .= ",\"{$row['Project_Name']}\"";
		}
		$this->webglobal['menuProjects'] = preg_replace('/\,/','',$this->webglobal['menuProjects'],1);
	}
	public function index(){
		$this->webglobal['page_title'] = 'Home';
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		$this->load->view('footer');
	}
	public function viewall(){
		$this->webglobal['page_title'] = 'ViewAll';
		$this->load->library('ViewAll');
		$this->db->select('Project_Name,Committee,Difficulty,Credit,Status,Modified');
		$query = $this->db->get('public.Project_Ideas');
		$this->webglobal['info_q'] = $query;
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		$this->load->view('viewall',$this->webglobal);
		$this->load->view('footer');
	}
	public function NewProject(){
		$this->webglobal['page_title'] = 'New';
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-block">', '</div>');
		$this->form_validation->set_rules('project_nick','Project Acronym','min_length[2]|max_length[8]');
		$this->form_validation->set_rules('project_name','Project Name','required');
		$this->form_validation->set_rules('committee[]','Committee','callback__committeeCheck');
		$this->form_validation->set_rules('info','Project Info','max_length[500]');
		$this->form_validation->set_rules('difficulty','Difficulty','callback__difficultyForm');
		$this->form_validation->set_rules('source','Source','max_length[254]|prep_url');
		$this->form_validation->set_rules('status','Status','callback__statusForm');
		$this->form_validation->set_rules('team','Team','');
		$this->load->view('header',$this->webglobal);
		$this->load->view('menu',$this->webglobal);
		if($this->form_validation->run() == FALSE){
			$this->load->view('newview',$this->webglobal);
		}else{
			$this->load->view('projectSubmit',$this->webglobal);
		}
		$this->load->view('footer');
	}
	public function _committeeCheck($value){
		$this->form_validation->set_message('_committeeCheck', '%s has a non valid input');
		switch($value){
			case "OpComm": return True;
			case "R&D": return True;
			case "Social": return True;
			case "History": return True;
			case "Eval": return True;
			case "Financial": return True;
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
	public function projectDeny(){
	}
	public function projectAccept(){
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
			$this->load->view('project404');
		}
	}
}
