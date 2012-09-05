<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projects extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('html');
		$this->load->database();
		$this->data['website'] = 'Project Database Web';
		$this->data['page_title'] = 'blarg';
		$this->data['user'] = 'ehouse';
	}
	public function index(){
		$this->load->view('header',$this->data);
		$this->load->view('menu',$this->data);
		$this->load->view('footer');
	}
	public function view($project_name){
		$this->load->view('header',$this->data);
		$this->load->view('menu',$this->data);
		$this->data['project_info_q'] = $this->db->query("SELECT * FROM proideas 
			WHERE proideas.project_name={$this->db->escape(urldecode($project_name))} ;");
		$this->data['project_comment_q'] = $this->db->query("SELECT * FROM procomments
			WHERE procomments.project_name={$this->db->escape(urldecode($project_name))} ;");
		if ($this->data['project_info_q']->num_rows() > 0){
			$this->load->view('projectview',$this->data);
		}
		else{
			$this->load->view('project404');
		}
		$this->load->view('footer');
	}
}
