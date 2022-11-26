<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Login_model');
	}

	
	public function index()
	{
		if($this->Login_model->is_login()){
			redirect(base_url('Dashboard/index'),'refresh');
		}
		else{
			$this->load->view('login');
		}
	}

    function login_action(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run("login_form") == FALSE)
		{
			$this->load->view('login');
		}
		else
		{
			$userdata = $this->Login_model->loginProcess( $username, md5($password) );
			//print_r($userdata);
			if(!empty($userdata)){
				$session_data = array(
				  "username"   => $userdata->username,
				  "password"   => $userdata->password
				);                                      
				$this->session->set_userdata($session_data);
				redirect(base_url('Dashboard/index'),'refresh');
			}
			else{
				$data = array();
				$data['msg'] = 1;
				$this->load->view('login', $data);
			}
		}
		
	}
}
