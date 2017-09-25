<?php
date_default_timezone_set("Africa/Lagos");
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	public function save($data){
		$this->db->insert("user", $data);
		return $this->db->insert_id();
	}

	public function getUserByUsername($username){
		$this->db->where('username', $username);
		return $this->db->get("user")->row();
	}

	public function getUserById($id){
		$this->db->where('id', $id);
		return $this->db->get('user')->row();
	}

	public function getUserByEmail($email){
		$this->db->where("email", $email);
		return $this->db->get("user")->row();
	}

	public function update($user_id, $data){
		$data = array_filter($data); // to remove null data
		$this->db->where("id", $user_id);
		$this->db->update("user", $data);
		return $this->db->affected_rows();
	}

	public function getDonations($user_id, $limit=2, $order_by="DESC"){
		$this->db->where("made_by", $user_id);
		$this->db->order_by("date", $order_by);
		$this->db->limit($limit);
		return $this->db->get("donations")->result();
	}

	public function getDonationsReceieved($user_id, $limit=2, $order_by="DESC"){
		$this->db->where("made_to", $user_id);
		$this->db->order_by("date", $order_by);
		$this->db->limit($limit);
		return $this->db->get("donations")->result();
	}

	public function getUserAvailableForMatching($user_id="", $package_id){
		$this->db->where('id !=', $user_id);
		$this->db->where("has_donated", 1);
		$this->db->where('active', 1);
		

		$this->db->where('package_id', $package_id);
		// $this->db->order_by("date_registered", "ASC");
		$this->db->order_by('last_donation_date', "ASC");
		
		$this->db->order_by('num_donations_received', 'ASC');
		$this->db->where('num_donations_received <=', 2);
		$users = $this->db->get('user')->result();
		if (empty($users)){
			return FALSE;
		}
		
		$users_array = [];
		foreach ($users as $user){
			if (!$this->hasFullPairing($user->id)){
				$users_array[] = $user;
			}
		}
		
		return !empty($users_array) ? $users_array[0] : FALSE;
		
		// return $users;
		// return $this->db->get("user")->row();
	}

	public function hasFullPairing($user_id){
		$this->db->where('paired_to', $user_id);
		$this->db->where('active', 1);
		$pairing_count = $this->db->count_all_results('pairings');
		if (intval($pairing_count) === 2){
			return TRUE;
		}
	}
	public function userAlreadyPaired($user_id){
		$this->db->where("user_id", $user_id);
		$this->db->where("active", 1);
		$result = $this->db->get('pairings');
		if ($result->num_rows() > 0){
			return $result->row();
		}
		return FALSE;
	}

	public function addNewPairing($user_id, $paired_to, $package_id, $package_price){
		$date = date_create(date("Y-m-d H:i:s"));
		// var_dump($date);
		
		date_add($date, 
			date_interval_create_from_date_string($this->config->item('pairing_interval')));

		$new_date = date_format($date, "Y-m-d H:i:s");
		$this->db->insert("pairings", array("user_id" => $user_id, 
			"paired_to" => $paired_to, 
			"package_id" => $package_id,
			"package_price" => $package_price, 
			"deadline_date" => $new_date));
		return $this->db->insert_id();
	}

	public function deletePairing($user_id, $paired_to){
		$this->db->where('user_id', $user_id);
		$this->db->where('paired_to', $paired_to);
		$this->db->delete("pairings");
		return $this->db->affected_rows();
	}

	public function getDonation($made_to, $status="pending"){
		$this->db->where("made_to", $made_to);
		$this->db->where("status", $status);
		return $this->db->get("donations")->row();

	}

	public function userHasUnCompletedDonations($user_id){
		$this->db->where('made_to', $user_id);
		$this->db->where('status', 'pending');
		if ($this->db->count_all_results("donations") < 2){
			return TRUE;
		}
		return FALSE;
	}

	public function countDonors(){
		
		$this->db->group_by("made_by");
		return count($this->db->get("donations")->result());
		// return $this->db->last_query();
		// return $this->db->count_all_results("donations");
	}

	public function hasDonated($user_id){
		$this->db->where('made_by', $user_id);
		$this->db->where('status', 'pending');
		if ($this->db->count_all_results("donations") == 1){
			return TRUE;
		}
		return FALSE;
	}

	public function resetDonationsStatusCount($user_id){
		$this->db->where('id', $user_id);
		$this->db->set('num_donations_received', 0);
		$this->db->update('user');
		if ($this->db->affected_rows() > 0){
			return TRUE;
		}
		return FALSE;
	}

	public function getDonationById($donation_id){
		$this->db->where('id', $donation_id);
		return $this->db->get('donations')->row();
	}

	public function insertNewDonation($data){
		if (!is_null($data)){
			$this->db->insert("donations", $data);
			return $this->db->insert_id();
		}
	}

	public function getCurrentDonationCount($user_id){
		$this->db->where('id', $user_id);
		return $this->db->get("user")->row()->num_donations_received;
	}

	public function addNewNotification($data){
		$this->db->insert("notifications", $data);
		return $this->db->insert_id();
	}

	public function getNotifications($limit=10, $start="", $order_by="DESC"){
		$this->db->limit($limit, $start);
		$this->db->order_by("date", $order_by);
		return $this->db->get("notifications")->result();
	}

	public function getTestimonies($limit=5, $start="", $order_by="DESC"){
		$this->db->limit($limit, $start);
		$this->db->order_by("date", $order_by);
		return $this->db->get("testimonies")->result();
	}
		
	public function createTestimony($data){
		$this->db->insert('testimonies', $data);
		return $this->db->affected_rows();
	}

	public function countAdminMessages(){
		return $this->db->count_all();
	}
	public function getAdminMessages($limit=20, $start=0, $order_by="DESC"){
		$this->db->limit($limit, $start);
		$this->order_by('date', $order_by);
		return $this->db->get('admin_broadcasts')->result();
	}

	public function deleteExpiredPairings(){
		$this->db->where('CURRENT_TIMESTAMP() > deadline_date');
		$this->db->where('active', 1);
		$results = $this->db->get('pairings')->result();
		if (!empty($results)){
			foreach ($results as $pairing){
				$this->changeUserStatus($pairing->user_id, "block");
				$this->deletePairingById($pairing->id);
			}
		}
	}

	public function deletePairingById($pairing_id){
		$this->db->where('id', $pairing_id);
		$this->db->delete('pairings');
		return $this->db->affected_rows();
	}

	public function changeUserStatus($user_id, $action="block"){
		$this->db->where('id', $user_id);
		$status = 1;
		if ($action == "block"){
			$status = 0;
		}
		$this->db->set('active', $status);
		$this->db->update('user');
		return $this->db->affected_rows();
	}
}