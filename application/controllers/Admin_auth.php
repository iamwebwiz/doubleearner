<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}
	public function login(){
		$data['title'] = "Admin Login";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/login');
		$this->load->view('admin/footer');
	}

	public function doLogin(){
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		if ($this->form_validation->run() === FALSE){
			$this->login();
			return;
		}
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$adminExists = $this->admin_model->getAdminByEmail($email);
		if ($adminExists){
			if (password_verify($password, $adminExists->password)){
				$this->session->set_userdata("admin_id", $adminExists->id);
				$this->session->set_userdata("admin_logged_in", TRUE);
				redirect(site_url('admin'));
			}
			else{
				doBootstrapAlert("Incorrect email/password", "danger");
				redirect(site_url('admin_auth/login'));
			}
		}
		else{
			doBootstrapAlert("Incorrect email/password", "danger");
			redirect(site_url('admin_auth/login'));
		}
	}

	public function signup(){
		$data['title'] = "Admin Signup";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/signup');
		$this->load->view('admin/footer');
	}

	public function doSignUp(){
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		$this->form_validation->set_rules("confirmpassword", "Confirm Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("admin_secret", "Admin Secret", "trim|required");
		if ($this->form_validation->run() === FALSE){
			$this->signup();
			return;
		}
		if (!$this->admin_model->verifySecret($this->input->post('admin_secret'))){
			doBootstrapAlert("You do not have access to this area", "info");
			redirect(site_url('admin_auth/signup'));

		}
		$email = $this->input->post('email');
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$admin_id = $this->admin_model->save(array('email' => $email,
			'password' => $password));
		if ($admin_id){
			$this->session->set_userdata('admin_id', $admin_id);
			$this->session->set_userdata('admin_logged_in', TRUE);
			redirect(site_url('admin'));
		}
	}

	

	public function logout(){
		$this->session->sess_destroy();
		goBack();
	}
}