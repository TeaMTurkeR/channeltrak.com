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
|	example.com/class/method/id/
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'traks';
$route['404_override'] = '';

$route['join'] = 'users/join';
$route['login'] = 'users/login';
$route['logout'] = 'users/logout';
$route['dashboard'] = 'users/dashboard';
$route['edit/(:num)'] = 'channels/edit/$1';


$route['channel/(:any)'] = 'channels/channel/$1';
$route['channels'] = 'channels/index';
$route['trak/(:any)'] = 'traks/trak/$1';
$route['random'] = 'traks/random';
$route['popular'] = 'traks/popular';
$route['latest'] = 'traks/latest';

/* End of file routes.php */
/* Location: ./application/config/routes.php */