<?php
class employee_model extends CI_model{
	
	function __construct()
    {
        parent::__construct();
    }

	public function existData($tbl,$where){		
        $query = $this->db->query("SELECT * FROM $tbl $where");
		return $query->num_rows();
	}
	
	public function emp_id(){		
        $query = $this->db->query("SELECT * FROM `employees`");
		return "EMP-".(1001+$query->num_rows());
	}


	public function create_emp($emp_details, $id=""){
		
		if(empty($id)){
			return $this->db->insert('employees',$emp_details);
		}
		else{
			return $this->db->update('employees',$emp_details, array("id" => $id));
		}
	}

	public function getemployees(){
		//$this->db->order_by("name", "asc");
        $this->db->from('employees');
        return $this->db->get()->result();
	}

	public function getValue($tbl, $id){
		return $this->db->get_where($tbl,array('id' => $id))->row();
	}


	public function delete_employees($id){
		if( $this->db->delete('employees',array('id' => $id)) ){  
			return true;
		}
		else{
			return false;
		}
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