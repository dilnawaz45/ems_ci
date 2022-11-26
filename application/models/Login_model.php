<?php
class Login_model extends CI_model{

	function __construct() {
        parent::__construct();
    }

	function loginProcess($username, $password){
		$row = $this->db->get_where('admin',array('username' => $username, 'password' => $password))->row();
		if(!empty($row)){
			if($row->username == $username  && $row->password == $password){
				return $row;
			}
		}
		return null;
	}

	public function existData($tbl,$where){		
        $query = $this->db->query("SELECT * FROM $tbl $where");
		return $query->num_rows();
	}

	function is_login()
	{
	   
		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');
		
		if( $username == '' || $password == '' )
		{
			return 0;
		}
		else
		{
			$userdata = $this->existData( 'admin', "WHERE `username`='$username' AND `password`='$password'");
            
            if($userdata>0){
            	return 1;
            }
            else{
            	return 0;
            }
		}
	}

}
?>