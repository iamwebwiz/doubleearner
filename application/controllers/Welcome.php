<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model("user_model");
		$data['title'] = $this->config->item('app_name');
		$data['notifications'] = $this->user_model->getNotifications();
		$data['testimonies'] = $this->user_model->getTestimonies();
		
			$this->load->view('header', $data);	
		
		$this->load->view('index');
		$this->load->view('footer');
	}

	public function about(){
		$data['title'] = "About Us";
		$this->load->view('header', $data);
		$this->load->view('about-us');
		$this->load->view('footer');
	}

	public function faq(){
		$data['title'] = $this->config->item('app_name') . " | FAQ";
		$this->load->view('header', $data);
		$this->load->view('faq');
		$this->load->view('footer');
	}

	public function support(){
		// $this->form_validation->set_rules('name', "Name", "trim|required");
		$this->form_validation->set_rules('email', "Email", "trim|required");
		$this->form_validation->set_rules('message_subject', "Subject", "trim|required");
		$this->form_validation->set_rules('message', "Message", "trim|required");
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
		if ($this->form_validation->run() === FALSE){
			$data['title'] = "Contact Support";
			if (isLoggedIn()){
				$this->load->view('user/header', $data);
				$this->load->view('user/sidebar');
				$this->load->view('user/support');
				$this->load->view('user/footer');
			}
			else{
				$this->load->view('header', $data);
				$this->load->view('support');
				$this->load->view('footer');
			}
			
		}
		else{
			$this->load->library('email');

			$this->email->from($this->config->item('contact_email'), $this->input->post('email'));
			$this->email->to($this->config->item('admin_email'));
			

			$this->email->subject($this->input->post('message_subject'));
			$this->email->message($this->input->post('message'));

			if ($this->email->send()){
				doBootstrapAlert("Your message has been submitted, we will get back to you shortly!", "success");
				goBack();
			}
			else{
				doBootstrapAlert("There was an error, please try later!", "danger");
				goBack();
			}
		}
		
	}
}
