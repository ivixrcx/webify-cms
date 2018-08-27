<?php 

/**
* 
*/
class pagemodel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function create($title, $content, $url, $image, $template, $statusid)
	{
		$data = array(
			'Title' 		=> ucfirst($title),
			'Content' 		=> ucfirst($content),
			'Url' 			=> strtolower($url),
			'Image' 		=> $image,
			'Template' 		=> $template,
			'StatusId' 		=> $statusid,
		);

		return $this->db->insert('page', $data);
	}

	public function draft($pageid, $title, $content, $url, $image, $template, $statusid)
	{
		$this->db->set('Title', ucfirst($title));
		$this->db->set('Content', ucfirst($content));
		$this->db->set('Url', strtolower($url));
		$this->db->set('Image', $image);
		$this->db->set('Template', $template);
		$this->db->set('DateModified', date('Y-m-d'));
		$this->db->set('StatusId', $statusid);
		$this->db->where('PageId', $pageid);
		return $this->db->update('page');
	}

	public function get($pageid="")
	{
		$this->db->select('PageId');
		$this->db->select('Title');
		$this->db->select('Content');
		$this->db->select('Url');
		$this->db->select('Image');
		$this->db->select('Template');
		$this->db->select('DATE_FORMAT(DateCreated, \'%M %d, %Y\') DateCreated');
		$this->db->select('DATE_FORMAT(DateModified, \'%M %d, %Y\') DateModified');
		$this->db->select('status.StatusId');
		$this->db->select('status.Name Status');
		$this->db->from('page');

		if(!empty($pageid)){
			$this->db->where('PageId', $pageid);
		}

		$this->db->join('status', 'status.StatusId = page.StatusId', 'left');
		$this->db->where('status.StatusId !=', 2); # !active

		return $this->db->get()->result();
	}

	public function search($page, $statusid='')
	{
		$this->db->select('*');
		$this->db->like('Url', $page);
		$this->db->from('page');

		if(!empty($statusid)){
			$this->db->where('StatusId', $statusid);
		}

		$this->db->limit(1);
		return $this->db->get()->result();
	}

	
}


?>