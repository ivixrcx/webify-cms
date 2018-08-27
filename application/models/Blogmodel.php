<?php 

/**
* 
*/
class blogmodel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function create($title, $description, $tags, $content, $url, $image, $statusid)
	{
		$data = array(
			'Title' 		=> ucfirst($title),
			'Description' 	=> ucfirst($description),
			'Tags' 			=> strtolower($tags),
			'Content' 		=> ucfirst($content),
			'Url' 			=> strtolower($url),
			'Image' 		=> $image,
			'StatusId' 		=> $statusid,
		);

		return $this->db->insert('blog', $data);
	}

	public function draft($blogid, $title, $description, $tags, $content, $url, $image, $statusid)
	{
		$this->db->set('Title', ucfirst($title));
		$this->db->set('Description', ucfirst($description));
		$this->db->set('Tags', strtolower($tags));
		$this->db->set('Content', ucfirst($content));
		$this->db->set('Url', strtolower($url));
		$this->db->set('Image', $image);
		$this->db->set('DateModified', date('Y-m-d'));
		$this->db->set('StatusId', $statusid);
		$this->db->where('BlogId', $blogid);
		return $this->db->update('blog');
	}

	public function publish($blogid)
	{
		$this->db->set('DateModified', date('Y-m-d'));
		$this->db->set('DatePublished', date('Y-m-d'));
		$this->db->set('StatusId', 4);
		$this->db->where('BlogId', $blogid);
		return $this->db->update('blog');
	}

	public function unpublish($blogid)
	{
		$this->db->set('DateModified', date('Y-m-d'));
		$this->db->set('StatusId', 5);
		$this->db->where('BlogId', $blogid);
		return $this->db->update('blog');
	}

	public function get($statusid="", $exclude_item="")
	{
		$this->db->select('BlogId');
		$this->db->select('Title');
		$this->db->select('Description');
		$this->db->select('Tags');
		$this->db->select('Content');
		$this->db->select('Url');
		$this->db->select('Image');
		$this->db->select('DATE_FORMAT(DateCreated, \'%M %d, %Y\') DateCreated');
		$this->db->select('DATE_FORMAT(DateModified, \'%M %d, %Y\') DateModified');
		$this->db->select('DATE_FORMAT(DatePublished, \'%M %d, %Y\') DatePublished');
		$this->db->select('status.StatusId');
		$this->db->select('status.Name Status');
		$this->db->from('blog');
		$this->db->join('status', 'status.StatusId = blog.StatusId', 'left');

		if(!empty($statusid)){
			$this->db->where('status.StatusId', $statusid);
		}

		if(!empty($exclude_item)){

			$this->db->where('BlogId != ' . $exclude_item);
		}

		$this->db->where('status.StatusId != 2');
		$this->db->order_by('blogid', 'DESC');

		return $this->db->get()->result();
	}

	public function search($blog, $statusid='')
	{
		$this->db->select('*');
		$this->db->like('Url', $blog);
		$this->db->from('blog');

		if(!empty($statusid)){
			$this->db->where('StatusId', $statusid);
		}

		$this->db->limit(1);
		return $this->db->get()->result();
	}

	public function recents($url)
	{
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('Url !=', $url);
		$this->db->where('StatusId', 4);
		return $this->db->get()->result();
	}

	public function delete($blogid)
	{
		$this->db->set('StatusId', 2);
		$this->db->where('BlogId', $blogid);
		return $this->db->update('blog');
	}
}


?>