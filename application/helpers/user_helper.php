<?php 

if (!function_exists("isAdmin")){
	function isAdmin(){
		$CI =& get_instance();
		return $CI->session->has_userdata("admin_logged_in");
	}
}

if (!function_exists("isLoggedIn")){
	function isLoggedIn(){
		$CI =& get_instance();
		return $CI->session->has_userdata("user_logged_in");
	}
}

if (!function_exists("countUsers")){
	function countUsers(){
		$CI =& get_instance();
		return $CI->db->count_all_results("user");
	}
}
if (!function_exists("logout")){
	function logout(){
		$CI =& get_instance();
		$CI->session->sess_destroy();
		redirect(site_url());
	}
}
if (!function_exists("donationAvailable")){
	function donationAvailable($user_id){
		$CI =& get_instance();
		$CI->load->model("user_model");

	}
}

if (!function_exists("getDonation")){
	function getDonation($user_id){
		$CI =& get_instance();
		$CI->load->model("user_model");
		return $CI->user_model->getDonation($user_id);
	}
}

if (!function_exists("hasDonation")){
	function hasDonation($user_id){
		$CI =& get_instance();
		$CI->db->where("made_to", $user_id);
		$CI->db->where("status", "pending");
		$result = $CI->db->get("donations");
		if ($result->num_rows() > 0){
			return TRUE;
		}

	}
}

if (!function_exists("userOwnsDonation")){
	function userOwnsDonation($user_id, $donation_id){
		$CI =& get_instance();
		$CI->db->where("made_to", $user_id);
		$CI->db->where("id", $donation_id);
		
		$result = $CI->db->get("donations");
		if ($result->num_rows() > 0){
			return TRUE;
		}
	}
}

if (!function_exists("getUserById")){
	function getUserById($user_id){
		$CI =& get_instance();
		$CI->load->model("user_model");
		return $CI->user_model->getUserById($user_id);
	}
}

if (!function_exists("getDonationsMadeByUser")){
	function getDonationsMadeByUser($user_id, $limit=2, $order_by="DESC"){
		$CI =& get_instance();
		$CI->db->where("made_by", $user_id);
		$CI->db->limit($limit);
		$CI->db->order_by("date", $order_by);
		return $CI->db->get("donations")->result();
	}
}

if (!function_exists("getDonationsReceivedByUser")){
	function getDonationsReceivedByUser($user_id, $limit=2, $order_by="DESC"){
		$CI =& get_instance();
		$CI->db->where("made_to", $user_id);
		$CI->db->limit($limit);
		$CI->db->order_by("date", $order_by);
		return $CI->db->get("donations")->result();
	}
}

if (!function_exists("getNotifications")){
	function getNotifications($limit=10, $start=0, $order_by="DESC"){
		$CI =& get_instance();
		$CI->load->model("user_model");
		
		return $CI->user_model->getNotifications($limit=20, $start=0);
	}
}

if (!function_exists("makeDonation")){
	function makeDonation(){
			$CI =& get_instance();
			$CI->load->model("user_model");
			$CI->load->library("session");
			$CI->load->database();
			$user_already_paired = $CI->user_model->userAlreadyPaired($CI->session->user_id);
			if ($user_already_paired){

				$paired_user = $CI->user_model->getUserById($user_already_paired);
				$data['available_user'] = $paired_user;
			}
			else{
				$data['available_user'] = $CI->user_model->getUserAvailableForMatching($CI->session->user_id);
				if (!is_null($data['available_user'])){
					$CI->user_model->addNewPairing($CI->session->user_id, $data['available_user']->id);
				}
			}
		// }
		return $data['available_user'];
		// $this->load->view('header', $data);
		// $this->load->view("donate");
		// $this->load->view("footer");
	}
		
}

if (!function_exists("getPackages")){
	function getPackages(){
		$CI =& get_instance();
		return $CI->db->get('packages')->result();
	}
}

if (!function_exists("countDonors")){
	function countDonors(){
		$CI =& get_instance();
		$CI->load->model("user_model");
		return $CI->user_model->countDonors();
	}
}

if (!function_exists("getPackageById")){
	function getPackageById($id){
		$CI =& get_instance();
		$CI->db->where('id', $id);
		return $CI->db->get('packages')->row();
	}
}

if (!function_exists("userAlreadyPaired")){
	function userAlreadyPaired($user_id){
		$CI =& get_instance();
		$CI->load->model("user_model");
		return $CI->user_model->userAlreadyPaired($user_id);
		
	}
}

if (!function_exists("hasPendingPairings")){
	function hasPendingPairings($user_id, $limit=2){
		$CI =& get_instance();
		$CI->db->where('paired_to', $user_id);
		$CI->db->where('active', 1);
		$CI->db->limit($limit);
		return $CI->db->get('pairings')->result();
	}
}

if (!function_exists("countDonationsReceived")){
	function countDonationsReceived($user_id){
		$CI =& get_instance();
		$CI->db->where('id', $user_id);
		return $CI->db->get('user')->row()->num_donations_received;
	}
}

if (!function_exists("yetToReceiveCompleteDonations")){
	function yetToReceiveCompleteDonations($user_id){
		$CI =& get_instance();
		$CI->db->where('id', $user_id);
		$user = $CI->db->get('user')->row();
		if (is_null($user))
			return FALSE;
		if (intval($user->has_donated) === 1 AND intval($user->num_donations_received) < 2){
			return TRUE;
		}

		return FALSE;
	}
}

if (!function_exists("hasPendingDonation")){
	function hasPendingDonation($user_id){
		$CI =& get_instance();
		$CI->db->where('made_by', $user_id);
		$CI->db->where('status', 'pending');
		$result = $CI->db->get('donations');
		if ($result->num_rows > 0){
			return TRUE;
		}
		return FALSE;
	}
}

if (!function_exists("alreadyTestified")){
	function alreadyTestified($user_id){
		$CI =& get_instance();
		$CI->db->where('user_id', $user_id);
		if ($CI->db->count_all_results('testimonies') > 0){
			return TRUE;
		}
		return FALSE;
	}
}

if (!function_exists("getTestimonies")){
	function getTestimonies($limit=3){
		$CI =& get_instance();
		$CI->db->limit($limit);
		$CI->db->order_by("date", "DESC");
		return $CI->db->get('testimonies')->result();
	}
}

if (!function_exists("isFirstDonation")){
	function isFirstDonation($user_id){
		$CI =& get_instance();
		$CI->db->where('made_by', $user_id);
		$CI->db->where('status', 'accepted');
		$result = $CI->db->count_all_results('donations');
		if (intval($result) < 1){
			return TRUE;
		}
		return FALSE;
	}
}

if (!function_exists('creditReferrer')){
	function creditReferrer($user_id){
		$CI =& get_instance();
		$CI->db->where('id', $user_id);
		$user = $CI->db->get('user')->row();
		if (is_null($user)){
			return FALSE;
		}
		if (is_null($user->referred_by)){
			return FALSE;
		}
		$CI->db->where('username', $user->referred_by);
		$referrer = $CI->db->get('user')->row();
		if (!is_null($referrer)){
			$package = getPackageById($user->package_id);
			$percentage = (intval(filter_var($package->package_price, FILTER_SANITIZE_NUMBER_INT)) * 0.05);
			
			$previousBonus = $referrer->referral_bonus;
			$previousBonus = intval(filter_var($previousBonus, FILTER_SANITIZE_NUMBER_INT));
			
			$updatedBonus = number_format($previousBonus + $percentage);
			
			$CI->db->where('username', $referrer->username);
			$CI->db->set('referral_bonus', "$updatedBonus");
			$CI->db->update('user');
			return TRUE;
		}
	}
}