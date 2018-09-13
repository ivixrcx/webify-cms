<?php

/**
*
*/
class settingsmodel extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function get()
	{
		$this->db->select('*');
		$this->db->from('settings');
		$this->db->limit(1);
		return $this->db->get()->result()[0];
	}

	public function update($title, $description, $tags, $homepage, $logo, $favicon)
	{
		$this->db->set('SiteTitle', $title);
		$this->db->set('SiteDescription', $description);
		$this->db->set('SiteTags', $tags);
		$this->db->set('HomePage', $homepage);
		$this->db->set('Logo', $logo);
		$this->db->set('Favicon', $favicon);
		return $this->db->update('settings');
	}
}



?>
