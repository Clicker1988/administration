<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Users Router
$route['user/login']					= "admin_controller/loginpage/$1";
$route['user/login/submit']				= "admin_controller/submitLogin/$1";
$route['user/logout']					= "admin_controller/submitLogout/$1";
$route['user/(:any)/(:num)']			= "main_controller/admins/$1/$2";
$route['user/(:any)']					= "main_controller/admins/$1";
$route['user/crud/(:any)/(:any)']		= "admin_controller/crud/$1/$2";
$route['user/prepupdate/(:any)']		= "admin_controller/prep_update/$1";
//Employee Router
$route['employees/(:any)/(:num)']		= "main_controller/employees/$1/$2";
$route['employees/(:any)']		 		= "main_controller/employees/$1";
$route['employees/crud/(:any)/(:any)'] 	= "employee_controller/crud/$1/$2";
$route['employees/prepupdate/(:any)']	= "employee_controller/prep_update/$1";
//CRM Router
$route['crm/(:any)']					= "main_controller/crm/$1";
$route['crm/crud/(:any)/(:any)']		= "crm_controller/crud/$1/$2";
//Project Router
$route['projects/(:any)/(:num)']		= "main_controller/projects/$1/$2";
$route['projects/(:any)']				= "main_controller/projects/$1";
$route['projects/crud/(:any)/(:any)']	= "project_controller/crud/$1/$2";
$route['projects/prepupdate/(:any)']	= "project_controller/prep_update/$1";
//Payroll Router
$route['payroll/(:any)/(:num)']			= "main_controller/payroll/$1/$2";
$route['payroll/(:any)']				= "main_controller/payroll/$1";
$route['payroll/crud/(:any)/(:any)']	= "payroll_controller/crud/$1/$2";
$route['payroll/prepupdate/(:any)']		= "payroll_controller/prep_update/$1";
//Infokit Router
$route['infokit/(:any)/(:num)']			= "main_controller/infokit/$1/$2";
$route['infokit/(:any)']				= "main_controller/infokit/$1";
$route['infokit/crud/(:any)/(:any)']	= "infokit_controller/crud/$1/$2";
$route['infokit/prepupdate/(:any)']		= "infokit_controller/prep_update/$1";

//Asset Router
$route['asset/(:any)/(:num)']			= "main_controller/asset/$1/$2";
$route['asset/(:any)']					= "main_controller/asset/$1";
$route['asset/crud/(:any)/(:any)']		= "asset_controller/crud/$1/$2";
$route['asset/prepupdate/(:any)']		= "asset_controller/prep_update/$1";

//Estimation Router
$route['estimation/(:any)']					= "main_controller/estimation/$1";
$route['estimation/(:any)/(:num)']			= "main_controller/estimation/$1/$2";
$route['estimation/crud/(:any)/(:any)']		= "estimation_controller/crud/$1/$2";
$route['estimation/crud/(:any)/(:any)/(:any)']		= "estimation_controller/crud/$1/$2/$3";


//API Router
$route['apitest']						= "rest_controller/receive/$1";
$route['api/(:any)']					= "rest_controller/api/$1";

$route['firebaseapi']					= "firebase_controller/index/$1";
$route['firebaseapi/(:any)']			= "firebase_controller/retrieveData/$1";
