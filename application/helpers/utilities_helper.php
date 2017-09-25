<?php 

if (!function_exists('doBootstrapAlert')){
	function doBootstrapAlert($message, $alertType){
		// $this->session->set_flashdata('message', $message);
		// $this->session->set_flashdata("alert-type", $alertType);
		$_SESSION['message'] = $message;
		$_SESSION['alert-type'] = $alertType;
	}
}

if (!function_exists('echoBootstrapAlert')){
	function echoBootstrapAlert(){
		//if ($this->session->flashdata('message')){
		if (isset($_SESSION['message'])){
			echo "<div class='alert alert-" . $_SESSION['alert-type'] . "'>";

			//echo $this->session->flashdata('message');
			echo "<a href=# class=close data-dismiss=alert>&times; </a>";
			echo $_SESSION['message'];
			echo "</div>";
			
			unset($_SESSION['message']);
			unset($_SESSION['alert-type']);
		}
		
	}
}	

if (!function_exists("goBack")){
	function goBack(){
		$CI =& get_instance();
		$CI->load->library("user_agent");
		redirect($CI->agent->referrer());
	}
}

if (!function_exists('csrf_tokener')){
	function csrf_tokener(){
		$CI =& get_instance();
		$csrf_token_name = $CI->security->get_csrf_token_name();
		$csrf_token_hash = $CI->security->get_csrf_hash();
		return "<input type=\"hidden\" name=\"$csrf_token_name\"" . " value=\"$csrf_token_hash\">";
		
	}
}
?>