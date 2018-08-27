<?php 

/**
 * Webify Theme Library Extension
 *
 * @author		Mark Dayl Jerezon
 * @link		https://linkedin.com/in/markdaryl
 */

class theme
{
	protected 		$ci;
	public static 	$theme 		= '';
	public static 	$theme_path 	= '';
	public static 	$theme_folder = '';

	function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->ci =& get_instance();
        $this->ci->load->model('thememodel');

        self::$theme 		= $this->ci->thememodel->getTheme();
        self::$theme_path 	= self::$theme[0]->Path;
        self::$theme_folder = self::$theme[0]->FolderName;
    }

	public function initialize($data)
	{
		// Extract $data 
		if(is_array($data))
		{
			extract($data);
		}

		// Define constants
		define( 'BASE_URL'		, base_url() );
		define( 'BASE_URL_BLOG'	, base_url() . 'blog/' );
		define( 'BASE_URL_THEME', base_url() . self::$theme_path . '/' );
		define( 'INCLUDES'		, base_url() . self::$theme_path . '/includes/' );
		define( 'PLUGINS'		, base_url() . self::$theme_path . '/plugins/'  );		
		define( 'MEDIA'			, base_url() . 'filemanager/files/'  );

		// include self::$theme_path . 'function.php';
		include self::$theme_path . 'header.php';

		if(isset($template) && !empty($template)){
			include self::$theme_path . $template;
		}
		else {
			include VIEWPATH . 'content/page.php';
		}

		include self::$theme_path . 'footer.php';
	}

	public function templates($excludes="", $includes="")
	{

		$files = array_diff( scandir( 'bm-content/themes/' . self::$theme_folder ), $excludes );

		$a = array();
		if(!empty($includes)){
			foreach ($files as $file) {
				foreach ($includes as $inc) {
					if (strpos($file, $inc) !== false) {
						$a[] = $file;
					}
				}
				
			}
		}

		if(empty($a))
			return $files;
		return $a;
	}

}

?>