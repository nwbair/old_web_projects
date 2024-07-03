<?php

class Users extends Controller {
	function Users() {
		parent::Controller();
		session_start();
		
		if($_SESSION['userlevel'] != 777) {
			if($_SESSION['userid'] < 1) {
				redirect('main/verify','refresh');
			} else {
				redirect('dashboard','refresh');
			}
		}
	}
	
	function index() {
		$data['title'] = "Manage Users";
		$data['main'] = 'admin/admin_users_home';
		$data['admins'] = $this->MUsers->getAllUsers();
		$this->load->vars($data);
		$this->load->view('admin/dashboard_template');
	}
	
	function create() {
		if ($this->input->post('username')) {
			$this->MUsers->addUser();
			$this->session->set_flashdata('message', 'User created');
			redirect('admin/users/index', 'refresh');
		} else {
			$data['title'] = "Create User";
			$data['main'] = 'admin/admin_users_create';
			$this->load->vars($data);
			$this->load->view('admin/dashboard_template');
		}
	}
	
	function edit($id=0) {
		if ($this->input->post('username')) {
			$this->MUsers->updateUser();
			$this->session->set_flashdata('message','User updated');
			redirect('admin/users/index', 'refresh');
		} else {
			$data['title'] = "Edit User";
			$data['main'] = 'admin/admin_users_edit';
			$data['user'] = $this->MUsers->getUser($id);
			if (!count($data['user'])) {
				redirect('admin/users/index','refresh');
			}
			$this->load->vars($data);
			$this->load->view('admin/dashboard_template');
		}
	}
	
	function delete($id) {
		$this->MUsers->deleteUser($id);
		$this->session->set_flashdata('message','User deleted');
		redirect('admin/users/index', 'refresh');
	}
}