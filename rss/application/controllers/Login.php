<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');

		$d['v'] = 'login';
		$this->load->view('template', $d);
	}

	public function parse()
	{
		$rss_url = "​https://www.theregister.co.uk/software/headlines.atom​";
	}
}
