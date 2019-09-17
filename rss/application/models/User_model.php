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
			$insert_query = $this->db->insert_string('user', $data);
			$insert_query = str_replace("INSERT INTO","INSERT IGNORE INTO",$insert_query);
			$this->db->query($insert_query);

			return ($this->db->affected_rows() != 1) ? false : $data;
		}
	}
?>