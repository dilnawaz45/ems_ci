<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeeForm extends CI_Controller {

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
			$this->load->view('employe_form', $data);
		}
		else{
			redirect(base_url('Login'),'refresh');
		}
	}

	public function edit($id)
	{
		$data = array();
		$data['employee'] = $this->employee_model->getValue('employees', $id);
		$this->load->view('employe_form', $data);
	}

	public function create(){
		
		$name = $this->input->post('name');
		$dob = $this->input->post('dob');
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$doj = $this->input->post('doj');
		$end_date = $this->input->post('end_date');
		$salary = $this->input->post('salary');
		$id = $this->input->post('edit_id');
		
		if(empty($id)){
			$num = $this->employee_model->existData('employees', "WHERE `email`='$email' OR `mobile`='$mobile'");
			if($num == 0){

				$config['upload_path']="./assets/images";
				$config['allowed_types']='gif|jpg|jpeg|png';
				$config['max_size'] = 1024 * 8;
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload',$config);

				if($this->upload->do_upload("image")){
					$data = array('upload_data' => $this->upload->data());
					$image= $data['upload_data']['file_name']; 
					$emp_id = $this->employee_model->emp_id();
					$emp_details = array(
						"emp_id" => $emp_id,
						"name" => $name,
						"dob" => date("Y-m-d", strtotime($dob)),
						"email" => $email,
						"mobile" => $mobile,
						"start_date" => date("Y-m-d", strtotime($doj)),
						"end_date" => date("Y-m-d", strtotime($end_date)),
						"salary" => $salary,
						"images" => $image,
						"rating" => 0,
						"created_at" => date("Y-m-d H:i:s"),
						"status" => 1
					);
					$data = $this->employee_model->create_emp($emp_details);
					if($data){
						echo "1|Employee saved successfully!";
					}
					else{
						echo "0|Employee failed to create!";
					}
				}
				else{
					echo "0|Failed to upload Image!";
				}

			}
			else{
				echo "0|Phone Number or Email already exist!";
			}
		}
		else{
			
			$num = $this->employee_model->existData('employees', "WHERE (`email`='$email' OR `mobile`='$mobile') AND `id`!='$id'");
			if($num ==0)
			{
				$emp = $this->employee_model->getValue("employees", $id);
				
				$image = $emp->images;
				if(!empty($_FILES['image']['name'])){
					
					$config['upload_path']="./assets/images";
					$config['allowed_types']='gif|jpg|jpeg|png';
					$config['max_size'] = 1024 * 8;
					$config['encrypt_name'] = TRUE;
					$this->load->library('upload',$config);
					if($this->upload->do_upload("image")){
						$data = array('upload_data' => $this->upload->data());
						$image= $data['upload_data']['file_name']; 
					}
				}
				
				$emp_details = array(
					"name" => $name,
					"dob" => date("Y-m-d", strtotime($dob)),
					"email" => $email,
					"mobile" => $mobile,
					"start_date" => date("Y-m-d", strtotime($doj)),
					"end_date" => date("Y-m-d", strtotime($end_date)),
					"salary" => $salary,
					"images" => $image
				);
				$data = $this->employee_model->create_emp($emp_details, $id);
				if($data){
					echo "1|Employee updated successfully!";
				}
				else{
					echo "0|Employee failed to updated!";
				}
			}
			else{
				echo "0|Phone Number or Email already exist!";
			}
		}
	}
	
	public function rate($id){
		$data = array();
		$data['employee'] = $this->employee_model->getValue('employees', $id);
		$this->load->view('employee_rating', $data);
	}

	public function save_rate(){
		$id = $this->input->post('id');
		$rate = $this->input->post('rate');
		$rateArr = array(
			"rating" => $rate
		);
		$data = $this->employee_model->create_emp($rateArr, $id);
		if($data){
			echo "1|Rating saved successfully!";
		}
		else{
			echo "0|Rating failed to saved!";
		}
	}

}
