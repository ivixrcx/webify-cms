<?php

/**
*
*/
class thememodel extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function get()
	{
		$this->db->select('*');
		$this->db->from('theme');
		$this->db->where('StatusId', 1);
		return $this->db->get()->result();
	}

	public function getTheme()
	{
		$this->db->select('*');
		$this->db->from('theme');
		$this->db->where('IsUsed', 1);
		$this->db->limit(1);
		return $this->db->get()->result();
	}

	public function create($name, $foldername, $description, $image, $path)
	{
		$data = array(
			'Name' 			=> $name,
			'FolderName' 	=> $foldername,
			'Description' 	=> $description,
			'Image' 		=> $image,
			'Path' 			=> $path,
		);

		return $this->db->insert('theme', $data);
	}

	public function use_theme($themeid)
	{
		$this->db->set('IsUsed', 0);
		$this->db->update('theme');

		$this->db->set('IsUsed', 1);
		$this->db->where('ThemeId', $themeid);
		$this->db->update('theme');

		return true;
	}

}



?>
