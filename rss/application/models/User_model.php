<?php
	class User_model extends CI_Model {
		function __construct(){
			parent::__construct();
			$this->load->database();
		}
 
		public function login($email, $password){
			$query = $this->db->get_where('user', array('username'=>$email, 'password'=>$password));
			return $query->row_array();
		}

		public function register($email, $password){
			$data = array( 
				'username'	=>  $email,
				'password'	=>  $password
			);
			if ($this->db->insert('user', $data))
			{
				return $data;
			}
			else
			{
				return false;
			}
		}
	}
?>