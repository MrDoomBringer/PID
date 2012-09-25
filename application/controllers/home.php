<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
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
		$this->load->view('homeview',$this->webglobal);
		$this->load->view('footer');
	}
}
?>
