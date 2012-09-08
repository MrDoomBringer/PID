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
		$this->load->database();
		$this->data = $this->webparent->webdata;
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
		//$this->load->view('newview',$this->data);
		$this->load->view('footer');
	}
	public function view($project_name){
		$name = urldecode($project_name);
		$this->data['info_q'] = $this->db->get_where('Project_Ideas',array('Project_Name'=>$name));
		$this->data['comment_q'] = $this->db->get_where('Project_Comments',array('Project_Name'=>$name));
		if ($this->data['info_q']->num_rows() > 0){
			$this->data['page_title'] = $name;
			$this->load->view('header',$this->data);
			$this->load->view('menu',$this->data);
			$this->load->view('projectview',$this->data);
			$this->load->view('footer');
		}
		else{
			$this->load->view('project404');
		}
	}
}
