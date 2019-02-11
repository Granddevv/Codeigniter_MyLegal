<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

	private $class = "";
	private $method = "";
	private $data = array();
	private $classExclude = array("welcome", "module_list", "auth", "migrate", "welcome", "lawyer", "cron"); // Can either use this or not extend the parent controller

	public function __construct() {
		parent::__construct();

		$this->class = strtolower($this->router->class);
		$this->method = strtolower($this->router->method);
		$this->_checkSession();
		if(!$this->_pageAccess()) {
			echo "<h1>You do not have permission to access this page</h1>";
			exit();
			// show_404();
		}

		$this->load->vars($this->data);
	}

	// Check user session
	private function _checkSession() {
		if(!$this->session->userdata("user_id") && !in_array($this->class, $this->classExclude)) {
			redirect("login");
		}
	}

	public function doesHaveAccess($class = "", $method = "") {
		if(!empty($class))
			$this->class = $class;

		if(!empty($method))
			$this->method = $method;

		return $this->_pageAccess();
	}

	// Check page access
	private function _pageAccess() {
		if(in_array($this->class, $this->classExclude)) return TRUE;
		$this->load->model("admin_model");
		$result = $this->admin_model->get_user_page_access($this->method, $this->class);

		return ($result === TRUE || count($result) > 0);
	}

	protected function isMobile() {
	    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
	}

    public function send_email($template_id, $user_id = FALSE, $subject = FALSE) {
    	$code_tag = array(
    		"first_name" => "||first_name||",
    		"last_name" => "||last_name||",
    		"to" => "||email||",
    		"practice_name" => "||practice_name||",
    	);

    	$template_info = $this->Template_model->get_template($template_id);
    	if(!$subject) $subject = $template_info->subject;
    	$email_msg = $template_info->content;

    	$user = $this->Template_model->get_template_user_info($user_id);
    	$to = $user->email;
    	$first_name = $user->first_name;
    	$last_name = $user->last_name;
    	$practice_name = $user->practice_name;

    	foreach($code_tag as $key => $tag)
			$email_msg = str_replace($tag, ${$key}, $email_msg);
        
        $logs = $this->mandrill_lib->mandrill_template_email($template_info->mandrill_template, array(array("name" => "maincontent", "content" => $email_msg)), $to, $subject);
        // log
        $this->Template_model->log_status($template_id, $to, $email_msg, $subject, $logs, $logs[0]['status']);
        if($logs) {
        	return $logs;
        } else {
        	return FALSE;
        }
    }

}