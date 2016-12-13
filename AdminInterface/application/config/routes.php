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
$route['Kustuta/RaamatultM%C3%A4rks%C3%B5na/(:num)'] = 'Delete/delete_keyword_from_book/$1';
$route['Kustuta/Autor/(:num)'] = 'Delete/delete_author/$1';
$route['Kustuta/RaamatultAutor/(:num)'] = 'Delete/delete_author_from_book/$1';
$route['Kustuta/%C5%BDanr/(:num)'] = 'Delete/delete_genre/$1';
$route['Kustuta/Raamatult%C5%BDanr/(:num)'] = 'Delete/delete_genre_from_book/$1';

$route['Koolid'] = 'View/view_schools';
$route['Raamatud'] = 'View/view_books';
//$route['Raamat/(:num)'] = 'View/view_book/$1';
$route['Nimekiri/(:num)'] = 'View/view_reading_list/$1';
$route['Nimekiri'] = 'View/view_reading_list';
$route['Klassid/(:num)'] = 'View/view_classes/$1';
$route['Klassid'] = 'View/view_classes';
$route['Kasutajad'] = 'View/view_users';
$route['M%C3%A4rks%C3%B5nad'] = 'View/view_keywords';
$route['Autorid'] = 'View/view_authors';
$route['%C5%BDanrid'] = 'View/view_genres';

$route['Muuda/Kool/(:num)'] = 'Edit/edit_school/$1';
$route['Muuda/Klass/(:num)'] = 'Edit/edit_class/$1';
$route['Muuda/Nimekiri/(:num)'] = 'Edit/edit_reading_list/$1';
$route['Muuda/Raamat/(:num)'] = 'Edit/edit_book/$1';
$route['Muuda/M%C3%A4rks%C3%B5na/(:num)'] = 'Edit/edit_keyword/$1';
$route['Muuda/Autor/(:num)'] = 'Edit/edit_author/$1';
$route['Muuda/%C5%BDanr/(:num)'] = 'Edit/edit_genre/$1';

$route['Lisa/Kool'] = 'Add/add_school';
$route['Lisa/Raamat'] = 'Add/add_book';
$route['Lisa/Nimekiri/(:num)'] = 'Add/add_book_to_list/$1';
$route['Lisa/Nimekiri'] = 'Add/add_book_to_list';
$route['Lisa/Klass/(:num)'] = 'Add/add_class/$1';
$route['Lisa/Klass'] = 'Add/add_class';
$route['Lisa/Kasutaja'] = 'Add/add_user';
$route['Lisa/M%C3%A4rks%C3%B5na'] = 'Add/add_keyword';
$route['Lisa/M%C3%A4rks%C3%B5na/(:num)'] = 'Add/add_keyword_to_book/$1';
$route['Lisa/Autor'] = 'Add/add_author';
$route['Lisa/Autor/(:num)'] = 'Add/add_author_to_book/$1';
$route['Lisa/%C5%BDanr'] = 'Add/add_genre';
$route['Lisa/%C5%BDanr/(:num)'] = 'Add/add_genre_to_book/$1';

$route['json/Koolid'] = 'JSON/schools';
$route['json/Klassid/(:num)'] = 'JSON/classes/$1';
$route['json/Nimekiri/(:num)'] = 'JSON/lists/$1';
$route['json/Otsing'] = 'JSON/search';
$route['json/M%C3%A4rks%C3%B5nad'] = 'JSON/keywords';
$route['json/Autorid'] = 'JSON/authors';
$route['json/%C5%BDanrid'] = 'JSON/genres';
$route['json/Raamat'] = 'JSON/book';

$route['default_controller'] = 'Login/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
