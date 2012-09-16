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
		$this->data = $this->webparent->webdata;
		$this->submit = $this->projectsubmit;
	}
	public function index(){
		$this->load->view('header',$this->data);
		$this->load->view('menu',$this->data);
		$this->load->view('footer');
	}
	public function viewall(){
		$this->data['page_title'] = 'ViewAll';
		$query = 'SELECT "Project_Name","Committee","Difficulty","Credit","Status" FROM "public"."Project_Ideas"';
		$this->data['info_q'] = $this->db->query($query);
		$this->load->view('header',$this->data);
		$this->load->view('menu',$this->data);
		$this->load->view('viewall',$this->data);
		$this->load->view('footer');
	}
	public function NewProject(){
		$this->data['page_title'] = 'New';
		$this->load->view('header',$this->data);
		$this->load->view('menu',$this->data);
		$this->load->view('newview',$this->data);
		$this->load->view('footer');
	}
	public function projectSummit(){
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
		redirect('projects/view/'.$redirect);
	}
	public function projectDeny(){
	}
	public function projectAccept(){
	}
	public function addComment(){
		$data = array('User_Name' => $this->data['username']);
		if(empty($_POST['comment'])){
			$data['Comment'] = NULL;
		}else{
			$data['Comment'] = $_POST['comment'];
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
		$this->data['info_q'] = $this->db->get_where('Project_Ideas',array('Project_Name'=>$name));
		$this->db->order_by("Comment_ID asc");
		$this->data['comment_q'] = $this->db->get_where('Project_Comments',array('Project_Name'=>$name));
		if ($this->data['info_q']->num_rows() > 0){
			$this->data['page_title'] = $name;
			$this->load->view('header',$this->data);
			$this->load->view('menu',$this->data);
			$this->load->view('projectview',$this->data);
			// Comment Section
			$this->load->view('commentAdder');
			foreach($this->data['comment_q']->result() as $row){
				$this->load->view('commentView',$row);
			}
			$this->load->view('footer');
		}else{
			$this->load->view('project404');
		}
	}
}
