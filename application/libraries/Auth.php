<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ERP
 *
 * @author      Amit Kumar
 * @copyright   Copyright (c) 2018
 */

/**
 * Class Auth
 */

class Auth
{
	/*
	|--------------------------------------------------------------------------
	| Auth Library
	|--------------------------------------------------------------------------
	|
	| This Library handles authenticating users for the application and
	| redirecting them to your home screen.
	|
	*/

	protected $CI;

	public $user = null;
	public $userID = null;
	public $userName = null;
	public $password = null;
	public $userRoles = null;
	public $roleID = 0;
	public $roleName = null;
	public $permissions = null;
	public $loginStatus = false;
	public $error = array();
	

	public function __construct()
	{
		// constructor
		$this->CI =& get_instance();
		$this->init();
	}

	/**
	 * Initialization the Auth class
	 */
	protected function init()
	{	
		if ($this->CI->session->has_userdata("userID") && $this->CI->session->loginStatus) {
			$this->userID = $this->CI->session->userID;
			$this->userName = $this->CI->session->userName;
			$this->roleID = $this->CI->session->roleID;
			$this->roleName = $this->CI->session->roleName;
			$this->loginStatus = true;
		}
		return;
	}

	/**
	 * Show login form
	 *
	 * @param array $data
	 * @return mixed
	 */
	public function showLoginForm($data = array())
	{
		$data['title'] = "Login";
		return $this->CI->load->view("login", $data);
	}

	/**
	 * Login
	 *
	 * @param $request
	 * @return array|bool|void
	 */
	public function login($request,$xder,$end_date)
	{		
	    if($xder==200){

			if($this->validate($request)) {			
				$this->user = $this->credentials($this->userName, $this->password,$this->userRoles);
				//var_dump($this->user);
				if ($this->user) {
					if($this->user->user_role_id == '8')
					{
						$this->updateLoginTime($this->user->emp_p_id,$this->user->user_role_id);
					}else{
						$this->updateLoginTime($this->user->user_p_id,$this->user->user_role_id);
					}
					
					return $this->setUser($this->user->user_role_id,$xder,$end_date);
				} else {
					return $this->failedLogin($request);
				}
			}
		}
		return false;
	}

	/**
	 * Validate the login data
	 *
	 * @param $request
	 * @return bool
	 */
	protected function validate($request)
	{
		$this->CI->form_validation->set_rules('username', 'User Name', 'required|trim');
		$this->CI->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->CI->form_validation->run() == true) {
			$this->userName = $this->CI->input->post("username", true);
			$this->password = $this->CI->input->post("password", true);
			$this->userRoles = $this->CI->input->post("role", true);
			return true;
		}
		return false;
	}

	/**
	 * Check the credentials
	 *
	 * @param $username
	 * @param $password
	 * @return mixed
	 */
	protected function credentials($username, $password,$roles)
	{
		$this->CI->load->library("password");
		/*print_r($roles);
		exit;*/
		if($roles == '8'){
			$user = $this->CI->db
			->select("*")
			->from("employees")
			->join("roles", "roles.role_p_id = employees.user_role_id")
			->where(array("username" => $username, "employees.is_active" => '1', "employees.deleted" => '0'), 1)->get()->row();
		}else{
			// print_r($roles);
			// exit;
			$user = $this->CI->db
			->select("*")
			->from("users")
			->join("roles", "roles.role_p_id= users.user_role_id")
			->where(array("user_email" => $username, "user_role_id" =>$roles,  "users.is_active" => '1', "users.deleted" => '0'), 1)->get()->row();
		}
		//print_r($user);
		// exit;
		if($user && $this->CI->password->validate_password($password, $user->password)) {
			return $user;
		}
		return false;
	}

	/**
	 * Update time login
	 *
	 * @param $id
	 * @return void
	 */
	public function updateLoginTime($id,$roleID)
	{	
		if($roleID == '8'){
			$this->CI->db->where('emp_p_id', $id);
			$this->CI->db->update('employees', array('last_login' => date('d-m-Y h:i:s A')));
		}else{
			$this->CI->db->where('user_p_id', $id);
			$this->CI->db->update('users', array('last_login' => date('d-m-Y h:i:s A')));
		}
		return;
	}

	/**
	 * Setting session for authenticated user
	 */
	protected function setUser($roleIds,$tyrty,$end_date)
	{		
		//var_dump($tyrty);die;
		if($roleIds == '8'){
			$this->CI->session->set_userdata(array(
				"userID" => $this->user->emp_p_id,
				"userFullName" => $this->user->emp_name,
				"userName" => $this->user->username,
				"roleID" => $this->user->user_role_id,
				"roleName" => $this->user->role_name,
				"isDeveloper" => '0',
				"loginStatus" => true,
				"ex_date"=>$end_date,
				"ajax_dnt"=>$tyrty,
			));
		}else{
			//$this->name = $this->user->name;
			$this->CI->session->set_userdata(array(
				"userID" => $this->user->user_p_id,
				"userFullName" => $this->user->user_full_name,
				"userName" => $this->user->user_email,
				"roleID" => $this->user->user_role_id,
				"roleName" => $this->user->role_name,
				"isDeveloper" => $this->user->is_developer,
				"loginStatus" => true,
				"ajax_dnt"=>$tyrty,
				"ex_date"=>$end_date,
			));
		}
		if($tyrty==200){
			if($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '2'){
				return redirect("dashboards");
			}elseif($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '3'){
				return redirect("dashboards/hostel");
			}elseif($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '4'){
				return redirect("dashboards/library");
			}elseif($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '5'){
				return redirect("accountants");
			}elseif($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '8'){
			 	return redirect("employees/profile/{$this->user->emp_p_id}");
			}elseif($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '7'){
			 	return redirect("super_admin");
			}elseif($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '9'){				
			 	return redirect("principal_desk");
			}elseif($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '11'){
			 	return redirect("sms");
			}
			elseif($this->CI->session->userdata['roleID'] == '1' || $this->CI->session->userdata['roleID'] == '12'){
			 	return redirect("inventry/items");
			}
		}
		
		//$this->newLoginNotification();
	}

	/**
	 * Get the error message for failed login
	 *
	 * @param $request
	 * @return array
	 */
	protected function failedLogin($request)
	{
		//var_dump($request['role']);
		$this->error["roll"] = $request['role'];
		$this->error["failed"] = "Username or Password Incorrect";
		redirect('main/login/'.$request['role']);
		return $this->error;
	}

	/**
	 * Read authenticated user ID
	 *
	 * @return int
	 */
	public function userID()
	{
		return $this->userID;
	}

	/**
	 * Read authenticated user Name
	 *
	 * @return string
	 */
	public function userName()
	{
		return $this->userName;
	}

	/**
	 * Read authenticated user roles
	 *
	 * @return array
	 */
	public function roleID()
	{
		return $this->roleID;
	}

	/**
	 * Read authenticated name
	 *
	 * @return array
	 */
	public function name()
	{
		return $this->name;
	}

	/**
	 * Send mail if logged from new device
	 */
	protected function newLoginNotification()
	{
		$this->CI->load->library('user_agent');
		$browser = $this->CI->agent->browser();
		$os = $this->CI->agent->platform();
		$getip = $this->CI->input->ip_address();
		
		$result = $this->CI->db->get("settings")->row();
		$stLe = $result->site_title;
		$tz = $result->timezone;
		
		$now = new DateTime();
		$now->setTimezone(new DateTimezone($tz));
		$dTod =  $now->format('d-m-Y');
		$dTim =  $now->format('H:i:s');
		
		$this->CI->load->helper('cookie');
		$keyid = rand(1,9000);
		$scSh = sha1($keyid);
		$neMSC = md5($this->userName);
		$setLogin = array(
			'name'   => $neMSC,
			'value'  => $scSh,
			'expire' => strtotime("+2 day"),
		);
		$getAccess = get_cookie($neMSC);
		
		if(!$getAccess && $setLogin["name"] == $neMSC)
		{
			$this->CI->load->library('email');
			$this->CI->load->library('sendmail');
			$bUrl = base_url();
			$message = $this->CI->sendmail->secureMail($this->name, $this->userName, $dTod, $dTim, $stLe, $browser, $os, $getip, $bUrl);
			$to_email = $this->userName;
			$this->CI->email->from($this->CI->config->item('email'), 'New sign-in! from '.$browser.'');
			$this->CI->email->to($to_email);
			$this->CI->email->subject('New sign-in! from '.$browser.'');
			$this->CI->email->message($message);
			$this->CI->email->set_mailtype("html");
			$this->CI->email->send();
			
			$this->CI->input->set_cookie($setLogin, TRUE);
			redirect('auth', 'refresh');
		}
		else
		{
			$this->CI->input->set_cookie($setLogin, TRUE);
			redirect('auth', 'refresh');
		}
	}

	/**
	 * Determine if the current user is authenticated.
	 *
	 * @return bool
	 */
	public function authenticate()
	{
		if (!$this->loginStatus()) {
			return redirect('main', 'refresh');
		}
		return true;
	}

	/**
	 * Check login status
	 *
	 * @return bool
	 */
	public function loginStatus()
	{
		return $this->loginStatus;
	}

	/**
	 * Check if user is developer or not
	 *
	 * @return bool
	 */
	public function _isDeveloper()
	{
		return $this->CI->session->userdata['isDeveloper'] == '1' ? true : false;
	}
	
	/**
	 * Read current user permissions name
	 *
	 * @return mixed
	 */
	public function userPermissions()
	{
		return array_map(function ($item) {
			return $item["permission_name"];
		}, $this->CI->db
		->select("permissions.*")
		->from("permissions")
		->join("role_permission", "permissions.permission_p_id = role_permission.permission_ID", "inner")
		->where_in("role_permission.role_ID", $this->roleID())
		->where(array("permissions.is_active" => '1'))
		->group_by("role_permission.permission_ID")
		->get()->result_array());
	}

	/**
	 * Determine if the current user is authenticated to view the route/url
	 *
	 * @return bool|void
	 */
	public function route_access()
	{
		if(count($this->CI->uri->segment_array()) == 1) {
			$routeName = (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2)) . "-" . $this->CI->uri->segment(1);
		} else {
			$routeName = is_null($this->CI->uri->segment(3)) ? $this->CI->uri->segment(1)."-".$this->CI->uri->segment(2) : $this->CI->uri->segment(1)."-".$this->CI->uri->segment(2)."-".$this->CI->uri->segment(3);
		}
		
		if($this->can($routeName))
			return true;
		return redirect('exceptions/custom_404', 'refresh');
	}
	
	/**
	 * Check if current user has a permission by its name.
	 *
	 * @param $permissions
	 * @param bool $requireAll
	 * @return bool
	 */
	public function can($permissions, $requireAll = false)
	{
		if (is_array($permissions)) {
			foreach ($permissions as $permission) {
				if ($this->checkPermission($permission) && !$requireAll)
					return true;
				elseif (!$this->checkPermission($permission) && $requireAll) {
					return false;
				}
			}
		}
		else {
			return $this->checkPermission($permissions);
		}
		// If we've made it this far and $requireAll is FALSE, then NONE of the perms were found
		// If we've made it this far and $requireAll is TRUE, then ALL of the perms were found.
		// Return the value of $requireAll;
		return $requireAll;
	}

	/**
	 * Check current user has specific permission
	 *
	 * @param $permission
	 * @return bool
	 */
	public function checkPermission($permission)
	{
		return in_array($permission, $this->userPermissions());
	}

	/**
	 * Determine if the current user is authenticated for specific methods.
	 *
	 * @param array $methods
	 * @return bool
	 */
	public function only($methods = array())
	{
		if (is_array($methods) && count(is_array($methods))) {
			foreach ($methods as $method) {
				if ($method == (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2))) {
					return $this->route_access();
				}
			}
		}
		return true;
	}

	/**
	 * Determine if the current user is authenticated except specific methods.
	 *
	 * @param array $methods
	 * @return bool
	 */
	public function except($methods = array())
	{
		if (is_array($methods) && count(is_array($methods))) {
			foreach ($methods as $method) {
				if ($method == (is_null($this->CI->uri->segment(2)) ? "index" : $this->CI->uri->segment(2))) {
					return true;
				}
			}
		}
		return $this->route_access();
	}

	/**
     * Logout
     *
     * @return bool
     */
    public function logout()
    {
        $this->CI->session->unset_userdata(array("userID", "userName", "roleID", "loginStatus"));
        $this->CI->session->sess_destroy();
        redirect(base_url());
        return true;
    }









	
	
	

	// forgot password
	public function forgot()
	{
		$result = $this->m_auth->getAllSettings();
		$sTl = $result->site_title;
		
		$email = $this->input->post('email-id');
		$clean = $this->security->xss_clean($email);
		$userInfo = $this->m_auth->getUserInfoByEmail($clean);

		if(!$userInfo){
			$this->session->set_flashdata('flash_message', 'We cant find your email address');
			redirect('auth/login', 'refresh');
		}
		
		if($userInfo->status != 'approved'){ //if status is not approved
			$this->session->set_flashdata('flash_message', 'Your account is not in approved status');
			redirect('auth/login', 'refresh');
		}
		
		//generate token
		$token = $this->m_auth->insertToken($userInfo->id);
		$qstring = $this->base64url_encode($token);
		$url = site_url() . '/auth/reset_password/token/' . $qstring;
		$link = '<a href="' . $url . '">' . $url . '</a>';

		$this->load->library('email');
		$this->load->library('sendmail');
				
		$message = $this->sendmail->sendForgot($userInfo->full_name,$this->input->post('email-id'),$link,$sTl);
		$to_email = $this->input->post('email-id');
		$this->email->from($this->config->item('forgot'), 'Reset Password! ' . $userInfo->full_name); //from sender, title email
		$this->email->to($to_email);
		$this->email->subject('Reset Password');
		$this->email->message($message);
		$this->email->set_mailtype("html");

		if($this->email->send())
		{
			$this->session->set_flashdata('success_message', 'A mail has been sent regarding password reset.');
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('flash_message', 'There was a problem sending an email.');
			redirect('auth/login', 'refresh');	
		}
	}

	// reset password
	public function reset_password()
	{
		$token = $this->base64url_decode($this->uri->segment(4));
		$cleanToken = $this->security->xss_clean($token);
		$user_info = $this->m_auth->isTokenValid($cleanToken); //either false or array();

		if(!$user_info){
			$this->session->set_flashdata('flash_message', 'Token is invalid or expired');
			redirect('auth/login', 'refresh');
		}
		$data = array(
			'email'=>$user_info->email,
			'token'=>$this->base64url_encode($token)
		);

		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passconf', 'confirm password', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = "Medishala::Reset Password";
			$this->load->view('common_header', $data);
			$this->load->view('reset_password', $data);
			$this->load->view('common_footer');
		}
		else
		{
			$this->load->library('password');
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$cleanPost['password'] = $hashed;
			$cleanPost['user_id'] = $user_info->id;
			unset($cleanPost['passconf']);
			if($this->m_auth->updatePassword($user_info->role, $cleanPost) == true)
			{
				$this->session->set_flashdata('success_message', 'Your password has been updated. You may now login');
			}
			else
			{
				$this->session->set_flashdata('flash_message', 'There was a problem updating your password');
			}
			redirect('auth/login', 'refresh');
		}
	}
	
	// change password
	public function change_password()
	{
		$data = $this->session->userdata;
		// check user level
		if(empty($data['role'])) {
			redirect('auth/login', 'refresh');
		}

		// check is admin or not
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]|max_length[16]');
		$this->form_validation->set_rules('passconf', 'confirm password', 'required|required|matches[password]');

		$data['user_id'] = $data['id'];
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = "Medishala::Change Password";
			$this->load->view('common_header', $data);
			$this->load->view('header', $data);
			$this->load->view('navbar', $data);
			$this->load->view('change_password', $data);
			$this->load->view('footer');
			$this->load->view('common_footer');
		}
		else
		{
			$this->load->library('password');
			$post = $this->input->post(NULL, TRUE);
			$cleanPost = $this->security->xss_clean($post);
			$hashed = $this->password->create_hash($cleanPost['password']);
			$cleanPost['password'] = $hashed;
			$cleanPost['user_id'] = $cleanPost['user-id'];
			unset($cleanPost['passconf']);
			if($this->m_auth->updatePassword($data['role'], $cleanPost) == true)
			{
				$this->session->set_flashdata('success_message', 'Your password has been updated. You may now login');
			}
			else
			{
				$this->session->set_flashdata('flash_message', 'There was a problem updating your password');
			}
			redirect('auth/logout', 'refresh');
		}
	}

	// base64 encoding
	public function base64url_encode($data) {
		return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
	}

	// base64 decoding
	public function base64url_decode($data) {
		return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
	}

}

/* End of file Auth.php */
/* Location: ./application/libraries/Auth.php */