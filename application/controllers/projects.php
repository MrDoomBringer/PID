<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projects extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('WebParent');
		$this->data = $this->webparent->webdata;
	}
	public function index(){
		$this->load->view('header',$this->data);
		$this->load->view('menu',$this->data);
		$this->load->view('footer');
	}
	public function view($project_name){
		$this->data['info_q'] = $this->db->get_where('Project_Ideas',array('Project_Name'=>$project_name));
		$this->data['comment_q'] = $this->db->get_where('Project_Comments',array('Project_Name'=>$project_name));
		if ($this->data['info_q']->num_rows() > 0){
			$this->data['page_title'] = $project_name;
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
