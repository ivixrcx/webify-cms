<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/* custom routes */

$route['upload_gallery/(:any)/(:any)']  = 'blog/upload_gallery/$1/$2';
$route['delete_photo/(:any)/(:any)']    = 'blog/delete_photo/$1/$2';
$route['gallery_files/(:any)']          = 'blog/gallery_files/$1';

$route['my/dashboard'] 			    = 'blog/dashboard';
$route['my/blog'] 				      = 'blog/dashboard';

$route['blog']                  = 'blog/lists';
$route['blog/(:any)'] 			    = 'blog/search/$1/4';
$route['preview/blog/(:any)'] 	= 'blog/search/$1//true';

$route['my/blog/create']        = 'blog/create';
$route['my/blog/draft'] 		    = 'blog/draft';;
$route['my/blog/edit/(:any)'] 	= 'blog/edit/$1';
$route['my/blog/publish'] 		  = 'blog/publish';
$route['my/blog/unpublish'] 	  = 'blog/unpublish';
$route['my/blog/get/all'] 		  = 'blog/get/all';
$route['my/blog/get/draft'] 	  = 'blog/get/draft';
$route['my/blog/get/published'] = 'blog/get/published';
$route['my/blog/delete/(:num)'] = 'blog/delete/$1';

$route['my/page'] 				      = 'page/dashboard';
$route['my/page/create'] 		    = 'page/create';
$route['my/page/draft'] 		    = 'page/draft';
$route['my/page/edit/(:any)'] 	= 'page/edit/$1';
$route['my/page/get'] 			    = 'page/get';

$route['my/themes']				      = 'themes/index';
$route['my/themes/create']		  = 'themes/create';

$route['my/menu'] 				      = 'menu/dashboard';
$route['my/filemanager']		    = 'filemanager/index';
$route['my/settings']			      = 'settings/index';
$route['my/settings/update'] 	  = 'settings/update';
$route['my/profile'] 			      = 'user/profile';

$route['admin'] 				        = 'user/login';
$route['logout'] 				        = 'user/logout';
$route['(:any)'] 				        = 'page/search/$1';
$route['preview/(:any)'] 		    = 'page/search/$1//true';

// Front area
// $route['blogs'] = 'blog/index';
// artlandcebu.com/blogs

// Admin area
// $route['my/blogs'] = 'blog/dashboard'
// artlandcebu.com/my/blogs

// $route['my/blogs/create'] = 'blog/create'
// artlandcebu.com/my/blogs
