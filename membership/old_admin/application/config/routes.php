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



$route['default_controller'] 	= "index";

/*====== Main Category Route ====================*/
$route['main_category'] 	    = "main_category_controller"; 
$route['searchmain']				= "main_category_controller/search";
$route['add_main_category'] 	= "main_category_controller/add"; 
$route['submit_main_category']  = "main_category_controller/submit";
$route['maincategoryedit/(:any)']	= "main_category_controller/edit";
$route['maincategoryupdate']		= "main_category_controller/update";
$route['maincategorydelete/(:any)']	= "main_category_controller/delete";
/*====== End Main Category Route ====================*/

/*====== Package Route ====================*/
$route['package'] = "package_controller";
$route['add_package'] = "package_controller/add";
$route['submit_package'] = "package_controller/submit";
$route['packageedit/(:any)']   = "package_controller/edit";
$route['packageupdate'] = "package_controller/update";
$route['packagedelete/(:any)'] = "package_controller/delete";


/*====== End Package Route ====================*/
$route['404_override'] 			= '';





/* End of file routes.php */

/* Location: ./application/config/routes.php */