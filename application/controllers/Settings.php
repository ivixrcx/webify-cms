<?php 
	
/**
* 
*/
class settings extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('webify');
		$this->load->model('settingsmodel');
		$this->load->model('pagemodel');
	}

	public function index()
	{
		$this->webify->is_logged_in();

		$data['navigation'] = 'settings';
		$data['action'] 	= 'Settings';
        $data['connector'] 	= base_url().'filemanager/connector';
        $data['settings'] 	= $this->settingsmodel->get();
        $data['pages'] 		= $this->pagemodel->get();

		$this->load->view('shared/admin-header', $data);
		$this->load->view('content/settings', $data);
		$this->load->view('shared/admin-footer');
	}

	public function update()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();

		$title 		 = $this->input->post('title');
		$description = $this->input->post('description');
		// $tags 		 = $this->input->post('tags');
		$tags = '';
		$homepage 	 = $this->input->post('homepage');
		$logo 		 = $this->input->post('logo');
		$favicon 	 = $this->input->post('favicon');

		$this->settingsmodel->update($title, $description, $tags, $homepage, $logo, $favicon);
		$this->webify->response['data'] = array('message'=>'success');
		$this->webify->output();
	}
}



?>