<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
    }
    
    public function index(){
		if($this->session->userdata('user')){
			$d['v'] = 'home';
			$this->load->view('template', $d);
		}
		else{
			$d['v'] = 'login';
			$this->load->view('template', $d);
		}
    }
}