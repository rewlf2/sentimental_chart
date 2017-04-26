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


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// $route['default_controller'] = 'dashboard';
$route['default_controller'] = 'welcome';


// testing
// $route['test/mail'] = 'test/mail';


// admin
$route['admin'] = 'admin/dashboard';




// testing routes

// $route['dashboard'] = 'dashboard';
// $route['user'] = 'user';
// $route['register'] = 'register';

// $route['news/create'] = 'news/create';
// $route['news/(:any)'] = 'news/view/$1';
// $route['news'] = 'news';

// $route['upload'] = 'welcome/upload';

// $route['(:any)'] = 'pages/view/$1';





// multi languages

$route['^(\w{2})$'] = $route['default_controller'];

// if want to show different languages in the url, use the following
// $controllers_methods = array(
//   'de' => array(
//     'willkommen/list' => 'welcome/list',
//     'willkommen' => 'welcome'
//   ),
//   'fr' => array(
//     'bienvenu/list' => 'welcome/list',
//     'bienvenu' => 'welcome'
//   )
// );
//
// $route['^(\w{2})/(.*)'] = function($language, $link) use ($controllers_methods)
// {
//   if(array_key_exists($language,$controllers_methods))
//   {
//     foreach($controllers_methods[$language] as $key => $sym_link)
//     {
//       if(strrpos($link, $key,0) !== FALSE)
//       {
//         $new_link = ltrim($link,$key);
//         $new_link = $sym_link.$new_link;
//         break;
//       }
//     }
//     return $new_link;
//   }
//   return $link;
// };

