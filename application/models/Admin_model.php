<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function save($data){
		$this->db->insert("admin", $data);
		return $this->db->insert_id();
	}

	public function verifySecret($secret){
		$this->db->where('secret_key', md5($secret));
		$result = $this->db->get('admin_secret');
		if ($result->num_rows() > 0){
			return TRUE;
		}
		return FALSE;
	}

	public function getAdminByEmail($email){
		$this->db->where('email', $email);
		return $this->db->get('admin')->row();
	}

	public function getUsers($limit=20, $start=0, $order_by="DESC"){
		$this->db->limit($limit, $start);
		$this->db->order_by("date_registered", $order_by);
		return $this->db->get("user")->result();
	}

	public function getDonations($limit=20, $start=0, $order_by="DESC"){
		$this->db->limit($limit, $start);
		$this->db->order_by("date");
		return $this->db->get("donations")->result();
	}

	public function countUsers(){
		return $this->db->count_all("user");
	}

	public function countDonations(){
		return $this->db->count_all("donations");
	}

	public function updateUser($user_id, $data){
		$this->db->where('id', $user_id);
		$this->db->update('user', $data);
		return $this->db->affected_rows();
	}

	public function getNotifications($limit=2, $start=0){
		$this->db->limit($limit, $start);
		$this->db->order_by("date", "DESC");
		return $this->db->get("notifications")->result();
	}

	
	public function deletePairing($pairing_id){
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
		$this->db->set('user', ['active' => $status]);
		$this->db->update('user');
		return $this->db->affected_rows();
	}
}