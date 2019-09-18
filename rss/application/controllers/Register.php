<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->library('session');
	}

	public function index()
	{
		if($this->session->userdata('user')){
			$d['v'] = 'home';
			$this->load->view('template', $d);
		}
		else{
			$d['v'] = 'register';
			$this->load->view('template', $d);
		}
	}

	public function do()
	{
		$output = array('error' => false);
 
		$email = $_POST['username'];
		$password = md5($_POST['password']);
 
		$data = $this->user_model->register($email, $password);
 
		if($data){
			$this->session->set_userdata('user', $data);
			$output['message'] = 'Registering. Please wait...';
		}
		else{
			$output['error'] = true;
			$output['message'] = 'User already exists.';
		}
		echo json_encode($output);
	}
}
