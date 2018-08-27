<?php 

/**
 * Webify System Library Extension
 *
 * @author		Mark Dayl Jerezon
 * @link		https://linkedin.com/in/markdaryl
 */

class webify
{
	protected 	$ci;
	private 	$ajaxified 	= false;
	public 		$response 	= array();

	function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->ci =& get_instance();
    }

	public function is_logged_in()
	{
		$data = $this->ci->session->userdata('login_data');

		if( $this->ajaxified ){

			header('Content-Type: application/json; charset=utf-8;');
			$this->response['status'] = isset( $data )
			? array('message' => 'OK'			, 'code' => 200)
			: array('message' => 'UNAUTHORIZED'	, 'code' => 401);
		}

		if(!isset($data) && !$this->ajaxified ){
			// redirect to admin login
			redirect(base_url('admin'));
		}
	}

	public function ajax_only()
	{
		// the best practice to filter non-ajax request
		if(!isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
			die( @file_get_contents(VIEWPATH . 'forbidden_request.php') );
		}

		$this->ajaxified = true;
	}

	public function output()
	{
		header('Content-Type: application/json; charset=utf-8;');
		echo json_encode($this->response);
		exit;
	}
}

?>