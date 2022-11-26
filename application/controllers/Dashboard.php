<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('employee_model');
	}
	
	public function index()
	{
		if($this->employee_model->is_login()){
			$data = array();
			$data['employee'] = $this->employee_model->getemployees();
			$this->load->view('employee_details', $data);
		}
		else{
			$this->logout();
		}
	}

	public function deleteEmp($id){
		$emp = $this->employee_model->getValue("employees", $id);
		$image = 'assets/images/' . $emp->images;
		if($this->employee_model->delete_employees($id)){
			unlink($image);
			echo "<script>alert('Employee Deleted successfully!'); window.location.href='".base_url('Dashboard/index')."';</script>";
		}
		else{
			echo "<script>alert('Something went wrong, please try again!'); window.location.href='".base_url('Dashboard/index')."';</script>";}
	}

	function logout() {
        
        $session_items = array('username' => '', 'password' => '', 'logged_in' => FALSE);
		$this->session->unset_userdata($session_items);		
		//$this->output->nocache();
		 $this->session->sess_destroy();
		redirect(base_url('Login'),'refresh');
    }
	
}
