<?php
date_default_timezone_set("Africa/Lagos");
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("user_model");
		if (!$this->session->has_userdata("user_logged_in")){
			doBootstrapAlert("Please login to continue", "warning");
			redirect(site_url("signin"));
		}
		$this->user_model->deleteExpiredPairings();
	}

	public function index(){
		$data['title'] = "Dashboard";
		$data['page_alias'] = "dashboard";
		$this->load->view('user/header', $data);
		$this->load->view('user/index');
		$this->load->view('user/footer');
	}

	public function viewMyProfile(){
		$data['title'] = "My Profile";
		$data['page_alias'] = "profile";
		$this->load->view('user/header', $data);
		$this->load->view('user/profile');
		$this->load->view('user/footer');
	}
	public function edit(){
		$user = $this->user_model->getUserById($this->session->userdata("user_id"));
		if (!empty($user)){
			$data['user'] = $user;
			$data['title'] = $user->username . " | Edit profile";
			$data['page_alias'] = "update profile";
			$this->load->view('header', $data);
			$this->load->view('updateprofile', $data);
			$this->load->view('footer');
		}
	}

	public function update(){
		$this->form_validation->set_rules("fname", "Full Name", "trim|required|alpha_numeric_spaces");
		$this->form_validation->set_rules("phone", "Phone Number", "trim|required");
		if ($this->form_validation->run() === FALSE){
			$this->edit();
		}
		else{
			$data['fname'] = $this->input->post("fname");
			$data['phone'] = $this->input->post("phone");
			if ($this->user_model->update($this->session->userdata("user_id"), $data)){
				doBootstrapAlert("Your profile information has been updated successfully", "success");
				redirect(site_url("update"));
			}
			else{
				doBootstrapAlert("We are unable to update your profile at this time, please try later", "danger");
				redirect(site_url("update"));
			}
		}
	}

	
	public function updatePaymentInfo(){
		$this->form_validation->set_rules("bank-name", "Bank Name", "trim|required");
		$this->form_validation->set_rules("account-name", "Account Name", "trim|required");
		$this->form_validation->set_rules("account-number", "Account Number", "trim|required");
		if ($this->form_validation->run() === FALSE){
			$user = $this->user_model->getUserById($this->session->userdata("user_id"));
			if (!empty($user)){
				$data['user'] = $user;
				$data['title'] = $user->username . " | Edit profile";
				$data['page_alias'] = 'update payment info';
				$this->load->view('header', $data);
				$this->load->view('paymentinfo', $data);
				$this->load->view('footer');
			}
		}
		else{
			$data['bank_name'] = $this->input->post("bank-name");
			$data['account_no'] = $this->input->post("account-number");
			$data['account_name'] = $this->input->post('account-name');
			if ($this->user_model->update($this->session->user_id, $data)){
				doBootstrapAlert("Your payment information has been updated", "success");
				redirect("updatepaymentinfo");
			}
			else{
				doBootstrapAlert("We are unable to update your payment infomation now, please try later", "danger");
				redirect("updatepaymentinfo");
			}
		}
	}
	
	public function submitPairingRequest(){
		$data['title'] = "Pair Request";
		$this->load->view('user/header', $data);
		// $package_id = $this->input->post("package_id");
		
		// if (is_null($package_id) OR $package_id === "" OR $package_id === NULL){
		// 	doBootstrapAlert("You need to select a package", "info");
		// 	redirect(site_url('user/loadProvideHelpPage'));
		// }
		$user = getUserById($this->session->user_id);
		$package = getPackageById($user->package_id);

		$data['available_user'] = $this->user_model->getUserAvailableForMatching($this->session->user_id, $package->id);
		
		
		if ($data['available_user'] !== FALSE AND !is_null($data['available_user'])){
			
			$this->user_model->addNewPairing($this->session->user_id, 
				$data['available_user']->id, 
				$package->id, 
				$package->package_price);
			$data['package_price'] = $package->package_price;
			doBootstrapAlert("We found one user to pair you with", "success");
			// $this->load->view('user/paired_panel', $data);
			redirect(site_url('user/viewpairing'));
		}
		else{
			doBootstrapAlert("There's no user available at this time, please try later", "info");
			
			redirect(site_url('user/loadprovidehelppage'));
		}
		$this->load->view('user/footer');
	}

	public function viewPairing(){
		$data['title'] = "Provide Help";
		
		$this->load->view('user/header', $data);
		$current_user = getUserById($this->session->user_id);
		
		$user_already_paired = $this->user_model->userAlreadyPaired($this->session->user_id);

		if ($user_already_paired){

			$paired_user = $this->user_model->getUserById($user_already_paired->paired_to);
			$package = getPackageById($current_user->package_id);
			$data['package_price'] = $package->package_price;
			$data['available_user'] = $paired_user;
			$data['pairing_data'] = $user_already_paired;
			$this->load->view('user/paired_panel', $data);
		}
		
		
		$this->load->view('user/footer');
	}
	// public function provideHelp(){
		
	// 	$data['title'] = "Provide Help";
		
	// 	$this->load->view('user/header', $data);
		
	// 	$user_already_paired = $this->user_model->userAlreadyPaired($this->session->user_id);
	// 	if ($user_already_paired){
	// 		$paired_user = $this->user_model->getUserById($user_already_paired->paired_to);
	// 		$data['package_price'] = $user_already_paired->package_price;
	// 		$data['available_user'] = $paired_user;
	// 		$this->load->view('user/paired_panel', $data);
	// 	}
		
		
	// 	$this->load->view('user/footer');
	// }

	public function loadProvideHelpPage(){
		$data['title'] = "Provide Help";
		
		$this->load->view('user/header', $data);
		$this->load->view('user/providehelp');
		$this->load->view('user/footer');
	}
	public function refusePayment(){
		
		$this->user_model->deletePairing($this->session->user_id, $this->input->post('paired_to'));
		doBootstrapAlert("The pairing has been canceled", "warning");
		redirect(site_url('user/loadProvideHelpPage'));
	}

	public function uploadPOP(){
		$user = $this->user_model->getUserById($this->session->user_id);
		$date = date("Y-m-d_H-i-s");
		$config['upload_path'] = './uploads/pops';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 0;
		$config['max_width'] = 0;
		$config['max_height'] = 0;
		
		$config['file_name'] = "pop_by_" . $user->username . "_on_" . $date . ".jpg";
		$config['overwrite'] = TRUE;
		
		$this->load->library('upload', $config);
		
		if (! $this->upload->do_upload('userfile')){
			// $error = array('error' => $this->upload->display_errors("<div class='alert alert-danger'>", "</div>"));
			$error = $this->upload->display_errors();
			doBootstrapAlert($error, "danger");
			redirect(site_url('user/viewpairing'));
		}
		else{
			$package = getPackageById($user->package_id);
			/* upload the image location to database */
			$file_name = $this->upload->data('file_name');
			$data = array("proof_of_payment" => $file_name,
				"made_by" => $this->session->user_id, 
				"made_to" => $this->input->post("made_to"),
				"amount" => $package->package_price);
			
			$this->user_model->insertNewDonation($data);
			// $this->user_model->addNewNotification(["body" => $user->username . " made a donation "]);
			doBootstrapAlert("Your proof of payment has been uploaded", "success");
			redirect(site_url('user'));
		}
		
	}

	public function editDonation(){
		$user_id = $this->session->user_id;
		$donation_id = $this->input->post("donation_id");
		$donation = $this->user_model->getDonationById($donation_id);
		if (!userOwnsDonation($user_id, $donation_id)){
			echo "Invalid data";
			exit();
		}
		if ($this->input->post("action") === "confirm"){
			//update the number of donations received by the receiver(which is the currently logged in user)
			
			if ($this->user_model->getCurrentDonationCount($user_id) <= 1){
				
				$this->db->set("num_donations_received", "num_donations_received + 1", FALSE);
				$this->db->where("id", $user_id);
				$this->db->update("user");
				
				if (isFirstDonation($donation->made_by)){
					creditReferrer($donation->made_by);	
				}
				
				$this->db->where("id", $donation_id);
				$this->db->update("donations", array("status" => "accepted"));

				$this->db->where("user_id", $donation->made_by);
				$this->db->where("paired_to", $donation->made_to);
				$this->db->update("pairings", ["active" => 0]);


			}
			
			else{
				//update donation status of the receiver, so they cannot be eligible to receive donation
				//i.e reset the donation status to 0
				$this->db->where("id", $donation->made_to);//currently logged in user
				$this->db->update("user", array("has_donated" => 0, "num_donations_received" => 0));				
			}	
			if (intval($this->user_model->getCurrentDonationCount($user_id)) > 1){
				
				$this->user_model->resetDonationsStatusCount($user_id);
				$this->db->where("id", $donation->made_to);//currently logged in user
				$this->db->update("user", array("has_donated" => 0));
			}
			
			
			

			//update donation status of the donor, so they can be eligible to receive donation
			$this->user_model->update($donation->made_by, array("has_donated" => 1, 'last_donation_date' => date("Y-m-d H:i:s")));
			doBootstrapAlert("You have accepted the donation", "success");
			redirect(site_url("user"));
			
		}
		else if($this->input->post("action") === "deny"){
			$this->db->where("id", $donation_id);
			$this->db->update("donations", ["status" => "declined"]);
			doBootstrapAlert("You have denied that donation", "info");
			redirect(site_url("user"));
		}
	}

	public function writeTestimony(){
		$this->form_validation->set_rules('message', "Message", "trim|required");
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
		
		if ($this->form_validation->run() === FALSE){
			$data['title'] = $this->config->item('app_name') . ": Letter Of Happiness";
			$this->load->view('user/header', $data);
			$this->load->view('user/testimony');
			$this->load->view('user/footer'); 
			return;
		}
		$user = $this->user_model->getUserById($this->session->user_id);
		$data['username'] = $user->username;
		$data['email'] = $user->email;
		$data['user_id'] = $this->session->user_id;
		$data['body'] = $this->input->post('message');
		if ($this->user_model->createTestimony($data)){
			doBootstrapAlert("Your testimony has been submitted", "success");
			redirect(site_url('user'));
		}
		else{
			doBootstrapAlert("An unknown error occured, please try later", "danger");
			redirect(site_url("user/writeTestimony"));
		}
	}

	public function viewDonations(){
		$data['title'] = $this->config->item('app_name') .  "|View Donations";
		$this->load->view('user/header', $data);
		$this->load->view('user/donations');
		$this->load->view('user/footer');
	}

	public function viewMessages(){
		//to view broadcast messages from admin
	}
}