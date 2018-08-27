<?php 

/**
* 
*/
class usermodel extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function validate($email, $password){
		$sql = "SELECT 
				user.Firstname,
				user.Lastname,
				user.Email,
				user.Password,
				user.UserTypeId,
				usertype.Name AS 'UserType' 
				FROM user 
				LEFT JOIN usertype ON usertype.UserTypeId = user.UserTypeId 
				WHERE user.Email = '$email' AND user.Password = SHA1('$password') AND user.StatusId = 1";

		return $this->db->query($sql)->result();
	}


}


?>