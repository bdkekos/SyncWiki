<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There is one reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
*/

$route['default_controller'] = "page";

/**************************
** SyncWiki Routes Ahoy! **
**************************/

// Auth

$route['auth'] = 'auth';

// System

$route['System/Page[ _]List'] = 'system/page_list';

// Pages
// Must be last as they override

$route['([^/]*?)'] = 'page/view/$1';
$route['([^/]*?)/edit'] = 'page/edit/$1';
$route['([^/]*?)/edit-([0-9a-zA-Z]*?)'] = 'page/edit/$1/$2';
$route['([^/]*?)/history'] = 'page/history/$1';
$route['([^/]*?)/view/(:num)'] = 'page/view/$1/$2';

// AJAX

$route['ajax/page/update_protection'] = 'page/ajax_update_protection';
$route['ajax/page/delete'] = 'page/ajax_delete';


/* End of file routes.php */
/* Location: ./system/application/config/routes.php */