<?php 
	
/**
* 
*/
class blog extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('theme');
		$this->load->library('webify');
		$this->load->model('blogmodel');
		$this->load->model('menumodel');
		$this->load->model('settingsmodel');
	}

	public function search($blog,$statusid="",$preview=false)
	{
		if($preview){
			$this->webify->is_logged_in();
		}

		$blog = $this->blogmodel->search($blog, $statusid)[0];
        $data['blog'] 	= $blog;
		$data['blogs'] 	= $this->blogmodel->get(4, $blog->BlogId); // list of published blogs

       	if(empty($data['blog'])){
       		redirect(base_url());
       	}

        $menu = $this->menumodel->get();	
        $data['menus'] 		= json_decode($menu[0]->Sequence);
		$data['settings'] 	= $this->settingsmodel->get();
        $data['recents'] 	= $this->blogmodel->recents($blog->Url);
		$data['template'] 	= 'template-blog-post.php';        

        $this->theme->initialize($data);
	}

	// admin area
	public function dashboard()
	{
		$this->webify->is_logged_in();

		$data['navigation'] = 'blogs';
		$data['action'] 	= 'My Blogs';
		$data['button'] 	= '<a href="'.base_url().'my/blog/create" class="btn btn-primary">Create</a>';
		$data['settings'] 	= $this->settingsmodel->get();

		$this->load->view('shared/admin-header', $data);
		$this->load->view('content/admin-blog');
		$this->load->view('shared/admin-footer');
	}

	public function create()
	{
		$this->webify->is_logged_in();

		$data['navigation'] = 'blogs';
		$data['action'] 	= 'Create Blog';
        $data['connector'] 	= base_url().'filemanager/connector';
		$data['settings'] 	= $this->settingsmodel->get();

		$this->load->view('shared/admin-header',$data);
		$this->load->view('content/create-blog',$data);
		$this->load->view('shared/admin-footer');
	}

	public function edit($blog)
	{
		$this->webify->is_logged_in();

		$data['navigation'] = 'blogs';
		$data['action'] 	= 'Edit Blog';
        $data['connector'] 	= base_url().'filemanager/connector';
        $data['blog'] 		= $blog;        
		$data['settings'] 	= $this->settingsmodel->get();

		$this->load->view('shared/admin-header',$data);
		$this->load->view('content/edit-blog',$data);
		$this->load->view('shared/admin-footer');
	}

	public function draft()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();

		$blogid 		= $this->input->post('blogid');
		$title 			= $this->input->post('title');
		$description 	= $this->input->post('description');
		$tags 			= $this->input->post('tags');
		$content 		= $this->input->post('content');
		$url 			= $this->input->post('url');
		$image 			= $this->input->post('image');

		if(empty($blogid)){
			$this->blogmodel->create($title, $description, $tags, $content, $url, $image, 1);
			$blogid = $this->db->insert_id();
			$this->webify->response['data'] = array('message'=>'success','blogid'=>$blogid);
			$this->webify->output();
		}
		else{
			$this->blogmodel->draft($blogid, $title, $description, $tags, $content, $url, $image, 3);
			$this->webify->response['data'] = array('message'=>'success','blogid'=>'');
			$this->webify->output();
		}

		$this->webify->response['data'] = array('message'=>'failed');
		$this->webify->output();
	}

	public function publish()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();

		$blogid = $this->input->post('blogid');
		$this->blogmodel->publish($blogid);

		$this->webify->response['data'] = array('message'=>'success');
		$this->webify->output();
	}

	public function unpublish()
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();

		$blogid = $this->input->post('blogid');
		$this->blogmodel->unpublish($blogid);

		$this->webify->response['data'] = array('message'=>'success');
		$this->webify->output();
	}

	public function get($request)
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();

		$data = "";
		switch ($request) {
			case 'all':
				$data = $this->blogmodel->get();
				break;
			case 'draft':
				$data = $this->blogmodel->get(3);
				break;
			case 'published':
				$data = $this->blogmodel->get(4);
				break;
		}

		$this->webify->response['data'] = array(
			'message' 	=> 'success',
			'data' 		=> $data
		);
		$this->webify->output();
	}

	public function lists()
	{
		$data['title'] 		= 'Blogs';
		$data['blogs'] 		= $this->blogmodel->get(4); // get publish only
		$data['settings'] 	= $this->settingsmodel->get();
		$menu = $this->menumodel->get();

		if(!empty($menu)){
			$data['menus'] = json_decode($menu[0]->Sequence);
		}

		$data['template'] = 'template-blog.php';

		$this->theme->initialize($data);
	}

	public function search_json($blog)
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();
		$this->webify->response['data'] = $this->blogmodel->search($blog)[0];
		$this->webify->output();
	}

	public function delete($blogid)
	{
		$this->webify->ajax_only();
		$this->webify->is_logged_in();
		$this->blogmodel->delete($blogid);
		$this->webify->response['data'] = array('message'=>'success');
		$this->webify->output();
	}

}

?>