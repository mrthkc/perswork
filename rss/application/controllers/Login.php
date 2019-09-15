<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
	}

	public function index()
	{
		$d['v'] = 'login';
		$this->load->view('template', $d);
	}

	public function parse()
	{
		$rss_url = "​https://www.theregister.co.uk/software/headlines.atom​";
	}
}
