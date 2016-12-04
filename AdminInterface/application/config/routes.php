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


$route['Kustuta/Kool/(:num)'] = 'Delete/delete_school/$1';
$route['Kustuta/Klass/(:num)'] = 'Delete/delete_class/$1';
$route['Kustuta/Nimekiri/(:num)'] = 'Delete/delete_list/$1';
$route['Kustuta/Nimekirjast/(:num)'] = 'Delete/delete_from_list/$1';
$route['Kustuta/Kasutaja/(:num)'] = 'Delete/delete_user/$1';
$route['Kustuta/Raamat/(:num)'] = 'Delete/delete_book/$1';
$route['Kustuta/M%C3%A4rks%C3%B5na/(:num)'] = 'Delete/delete_keyword/$1';

$route['Koolid'] = 'View/view_schools';
$route['Raamatud'] = 'View/view_books';
$route['Nimekiri/(:num)'] = 'View/view_reading_list/$1';
$route['Nimekiri'] = 'View/view_reading_list';
$route['Klassid/(:num)'] = 'View/view_classes/$1';
$route['Klassid'] = 'View/view_classes';
$route['Kasutajad'] = 'View/view_users';
$route['M%C3%A4rks%C3%B5nad'] = 'View/view_keywords';

$route['Muuda/Kool/(:num)'] = 'Edit/edit_school/$1';
$route['Muuda/Klass/(:num)'] = 'Edit/edit_class/$1';
$route['Muuda/Nimekiri/(:num)'] = 'Edit/edit_reading_list/$1';
$route['Muuda/Raamat/(:num)'] = 'Edit/edit_book/$1';
$route['Muuda/M%C3%A4rks%C3%B5na/(:num)'] = 'Edit/edit_keyword/$1';

$route['Lisa/Kool'] = 'Add/add_school';
$route['Lisa/Raamat'] = 'Add/add_book';
$route['Lisa/Nimekiri/(:num)'] = 'Add/add_book_to_list/$1';
$route['Lisa/Nimekiri'] = 'Add/add_book_to_list';
$route['Lisa/Klass/(:num)'] = 'Add/add_class/$1';
$route['Lisa/Klass'] = 'Add/add_class';
$route['Lisa/Kasutaja'] = 'Add/add_user';
$route['Lisa/M%C3%A4rks%C3%B5na'] = 'Add/add_keyword';

$route['json/Koolid'] = 'JSON/schools';
$route['json/Klassid/(:num)'] = 'JSON/classes/$1';
$route['json/Nimekiri/(:num)'] = 'JSON/lists/$1';

$route['default_controller'] = 'Login/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
