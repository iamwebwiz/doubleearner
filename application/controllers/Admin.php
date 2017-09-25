<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	public function __construct(){
		parent::__construct();
		if (!isAdmin()){
			doBootstrapAlert("Login to continue", "warning");
			redirect(site_url('admin_auth/login'));
		}
		$this->load->model("admin_model");
	}

	public function index(){
		$data['users_count'] = $this->admin_model->countUsers();
		$data['donations_count'] = $this->admin_model->countDonations();
		$data['notifications'] = $this->admin_model->getNotifications();
		$data['latest_users'] = $this->admin_model->getUsers(2);
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/index');
		$this->load->view('admin/footer');
	}

	public function viewUsers(){
		include_once './Pagination.php';
		$pagination = new Pagination();
		$pagination->setBaseURL(current_url());
		$pagination->setTotalRows($this->admin_model->countUsers());
		$pagination->setRowsPerPage(20);
		if (isset($_GET['current_page']) AND is_numeric($_GET['current_page'])){
			$pagination->setCurrentPage($_GET['current_page']);
		}
		else{
			$pagination->setCurrentPage(1);
		}

		if ($pagination->getCurrentPage() > $pagination->getTotalPages()){
			$pagination->setCurrentPage($pagination->getTotalPages());
		}
		if ($pagination->getCurrentPage() < 1){
			$pagination->setCurrentPage(1);
		}

		$data['users'] = $this->admin_model->getUsers($pagination->getRowsPerPage(), $pagination->getOffset());
		$data['total_pages'] = $pagination->getTotalPages();
		$data['current_page'] = $pagination->getCurrentPage();
		$data['total_rows'] = $pagination->getTotalRows();
		$data['pagination_links'] = $pagination->generateLinks();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/users');
		$this->load->view('admin/footer');

	}

	public function deleteUser($user_id){
		$this->db->where('id', $user_id);
		if ($this->db->delete('user')){
			doBootstrapAlert("User deleted successfully", "success");
			goBack();
		}
		else{
			doBootstrapAlert("Unable to delete User", "info");
			goBack();
		}
	}

	public function deleteDonation($id){
		$this->db->where('id', $id);
		if ($this->db->delete('donations')){
			doBootstrapAlert("Donation deleted", "success");
			goBack();
		}
		else{
			doBootstrapAlert("Unable to delete that donation", "info");
			goBack();
		}
	}
	public function viewDonations(){
		include_once './Pagination.php';
		$pagination = new Pagination();
		$pagination->setBaseURL(current_url());
		$pagination->setTotalRows($this->admin_model->countDonations());
		$pagination->setRowsPerPage(20);
		if (isset($_GET['current_page']) AND is_numeric($_GET['current_page'])){
			$pagination->setCurrentPage($_GET['current_page']);
		}
		else{
			$pagination->setCurrentPage(1);
		}

		if ($pagination->getCurrentPage() > $pagination->getTotalPages()){
			$pagination->setCurrentPage($pagination->getTotalPages());
		}
		if ($pagination->getCurrentPage() < 1){
			$pagination->setCurrentPage(1);
		}

		$data['donations'] = $this->admin_model->getDonations($pagination->getRowsPerPage(), $pagination->getOffset());
		$data['total_pages'] = $pagination->getTotalPages();
		$data['current_page'] = $pagination->getCurrentPage();
		$data['total_rows'] = $pagination->getTotalRows();
		$data['pagination_links'] = $pagination->generateLinks();
		$this->load->view('admin/header', $data);
		$this->load->view('admin/sidebar');
		$this->load->view('admin/pops');
		$this->load->view('admin/footer');
	}

	public function markDonated($user_id){
		$this->db->where("id", $user_id);
		$this->db->set("has_donated", 1);
		if ($this->db->update("user")){
			doBootstrapAlert("User has been mark, and they are now eligible to receive donation", "success");
			goBack();
		}
		else{
			doBootstrapAlert("There was an error changing that user's status". "warning");
			goBack();
		}
	}

	public function blockUser($user_id){
		if ($this->admin_model->updateUser($user_id, ["active" => 0])){
			doBootstrapAlert("User has been blocked successfully", 'success');
			goBack();
		}
		else{
			doBootstrapAlert("Unable to block user at this time", "warning");
			goBack();
		}
	}

	public function unBlockUser($user_id){
		if ($this->admin_model->updateUser($user_id, ["active" => 1])){
			doBootstrapAlert("User has been unblocked successfully", 'success');
			goBack();
		}
		else{
			doBootstrapAlert("Unable to block user at this time", "warning");
			goBack();
		}
	}

	public function changeAdminSecret(){
		$data['title'] = "Change admin secret";
		$this->load->view('admin/header', $data);
		$this->load->view('admin/changekey' );
		$this->load->view('admin/footer');
	}

	public function changeKey(){
		$this->form_validation->set_rules('old_key', "Old Key", "trim|required");
		$this->form_validation->set_rules('new_key', "New Key", "trim|required");
		if ($this->form_validation->run() === FALSE){
			$this->changeAdminSecret();
			return;
		}
		if ($this->admin_model->verifySecret($this->input->post('old_key'))){
			$this->db->set('secret_key', md5($this->input->post('new_key')));
			$this->db->update('admin_secret');
			doBootstrapAlert('The admin secret key was updated successfully', "success");
			redirect(site_url('admin'));
		}
		doBootstrapAlert("Unable to change admin secret key", "danger");
		redirect(site_url('admin/changeAdminSecret'));
	}	
	
}