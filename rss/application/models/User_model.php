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
	}
?>