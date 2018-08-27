<?php 
	
/**
* 
*/
class index extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('settingsmodel');
	}

	public function index()
	{
		$settings = $this->settingsmodel->get();
		redirect(base_url($settings[0]->HomePage));
	}	
}



?>