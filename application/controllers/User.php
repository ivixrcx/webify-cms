<?php 
	
/**
* 
*/
class user extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->model('settingsmodel');
	}

	public function index()
	{
		$data['settings'] 	= $this->settingsmodel->get();

		$this->load->view('shared/admin-header', $data);
		// $this->load->view('dashboard');
		$this->load->view('shared/admin-footer');
	}

	public function profile()
	{
		$data['settings'] 	= $this->settingsmodel->get();

		$this->load->view('shared/admin-header', $data);
		// $this->load->view('dashboard');
		$this->load->view('shared/admin-footer');
	}

	public function login()
	{
		$data['settings'] 	= $this->settingsmodel->get();
		$this->load->view('login', $data);
	}

	public function do_login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->usermodel->validate($email, $password);
		if(!empty($user)){
			$this->session->set_userdata('login_data',$user);
			echo json_encode(array('message'=>'success'));exit;
		}
		echo json_encode(array('message'=>'failed'));exit;
	}

	public function logout()
	{
		$this->session->unset_userdata('login_data');
		redirect(base_url().'admin');
	}
}



?>