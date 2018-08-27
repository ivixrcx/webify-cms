<?php 
	
/**
* 
*/
class page extends CI_Controller 
{
	
	function __construct() 
	{
		parent::__construct();
		$this->load->library('theme');
		$this->load->library('webify');
		$this->load->model('pagemodel');
		$this->load->model('menumodel');
		$this->load->model('settingsmodel');
	}

	public function search($page,$statusid="",$preview=false)
	{
		if($preview){
			$this->webify->is_logged_in();
		}

        $menu = $this->menumodel->get();
        $data['menus'] 	= json_decode($menu[0]->Sequence);
        $data['page'] 	= $this->pagemodel->search($page, $statusid);

       	if(empty($data['page'])){
       		redirect(base_url());
       	}

       	$data['title'] = $data['page'][0]->Title;
		$data['settings'] = $this->settingsmodel->get();
		$data['template'] = $data['page'][0]->Template;

		$this->theme->initialize($data);
	}

	// admin area
	public function dashboard()
	{
		$this->webify->is_logged_in();

		$data['navigation'] = 'pages';
		$data['action'] 	= 'My Pages';
		$data['button'] 	= '<a href="'.base_url().'my/page/create" class="btn btn-primary">Create</a>';
		$data['settings'] 	= $this->settingsmodel->get();

		$this->load->view('shared/admin-header',$data);
		$this->load->view('content/admin-page',$data);
		$this->load->view('shared/admin-footer');
	}

	public function create()
	{
		$this->webify->is_logged_in();

		$data['navigation'] = 'pages';
		$data['action'] 	= 'Create Page';
		$data['connector'] 	= base_url().'filemanager/connector';
		$data['settings'] 	= $this->settingsmodel->get();

		$this->load->view('shared/admin-header',$data);
		$this->load->view('content/create-page',$data);
		$this->load->view('shared/admin-footer');
	}

	public function edit($page)
	{
		$this->webify->is_logged_in();

		$data['navigation'] = 'pages';
		$data['action'] 	= 'Edit Page';
        $data['connector'] 	= base_url().'filemanager/connector';
        $data['page'] 		= $page;
		$data['settings'] 	= $this->settingsmodel->get();
        $data['status']		= '';

		$this->load->view('shared/admin-header',$data);
		$this->load->view('content/edit-page',$data);
		$this->load->view('shared/admin-footer');
	}

	public function draft()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();
		
		$pageid 	= $this->input->post('pageid');
		$title 		= $this->input->post('title');
		$content 	= $this->input->post('content');
		$url 		= $this->input->post('url');
		$image 		= $this->input->post('image');
		$template 	= $this->input->post('template');

		if(empty($pageid)){
			$this->pagemodel->create($title, $content, $url, $image, $template, 1);
			$pageid = $this->db->insert_id();
			$this->webify->response['status'] = array('message'=>'success','pageid'=>$pageid);
			$this->webify->output();
		}
		else{
			$this->pagemodel->draft($pageid, $title, $content, $url, $image, $template, 3);
			$this->webify->response['status'] = array('message'=>'success','pageid'=>'');
			$this->webify->output();
		}

		$this->webify->response['status'] = array('message'=>'failed');
		$this->webify->output();
	}

	public function get()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();
		$this->webify->response['data'] = array(
			'message' 	=> 'success',
			'data' 		=> $this->pagemodel->get()
		);
		$this->webify->output();
	}

	public function search_json($page)
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();
		$this->webify->response['data'] = $this->pagemodel->search($page)[0];
		$this->webify->output();
	}

}



?>