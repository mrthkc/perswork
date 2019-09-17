<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
			$d['v'] = 'login';
			$this->load->view('template', $d);
		}
	}

	public function do()
	{
		$output = array('error' => false);
 
		$email = $_POST['username'];
		$password = $_POST['password'];
 
		$data = $this->user_model->login($email, $password);
 
		if($data){
			$this->session->set_userdata('user', $data);
			$output['message'] = 'Logging in. Please wait...';
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Login Invalid. User not found';
		}
		echo json_encode($output);
	}

	public function out()
	{
		$this->load->library('session');
		$this->session->unset_userdata('user');
		redirect('/login');
	}
}
