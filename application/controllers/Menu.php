<?php 
	
/**
* 
*/
class menu extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('webify');
		$this->load->model('menumodel');
		$this->load->model('pagemodel');
		$this->load->model('settingsmodel');
	}

	// admin area
	public function dashboard()
	{
		$this->webify->is_logged_in();

		$data['navigation'] = 'menu';
		$data['action'] = 'Customize Menu';
		$data['pages'] = $this->pagemodel->get();
		$data['settings'] = $this->settingsmodel->get();
		
		$this->load->view('shared/admin-header', $data);
		$this->load->view('content/menu', $data);
		$this->load->view('shared/admin-footer');
	}

	public function get()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();
		
		echo $this->menumodel->get()[0]->Sequence;
	}

	public function save()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();

		$sequence = $this->input->post('sequence');
		$this->menumodel->save($sequence);
		
		$this->webify->response['data'] = array('message'=>'success');
		$this->webify->output();
	}

}



?>