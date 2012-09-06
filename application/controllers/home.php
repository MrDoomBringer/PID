<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index(){
		$this->load->library('WebParent');
		$webdata = $this->webparent->webdata;
		$webdata['page_title'] = 'Home';
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->view('header',$webdata);
		$this->load->view('menu',$webdata);
		$this->load->view('homeview');
		$this->load->view('footer');
	}
}
?>
