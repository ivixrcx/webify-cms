<?php 

/**
* 
*/
class menumodel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		$sql = "SELECT Sequence FROM menu";
		return $this->db->query($sql)->result();
	}

	public function save($sequence)
	{
		$data = array('Sequence' => $sequence);
		return $this->db->update('menu', $data);
	}


}


?>