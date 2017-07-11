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

// Web
$route['search'] = "home/search";
$route['push_wajibati'] = "home/push_form";
$route['daily_hadith'] = "home/daily_hadith";
$route['dua_rabbana'] = "home/dua_rabbana";
$route['dua_rabbana_detail/(.*)'] = "home/dua_detail/$1";
$route['friday_sermons'] = "home/friday_sermons";
$route['friday_sermons/(:num)'] = "home/friday_sermons/$1";
$route['sermon_detail/(.*)'] = "home/sermon_detail/$1";
$route['names'] = "home/names";
$route['dua_after_athan'] = "home/dua_after_athan";
$route['dua_after_prayer'] = "home/dua_after_prayer";
$route['monthly_prayer_time'] = "home/monthly_prayer_time";
$route['masjid_gallery'] = "home/masjid_gallery";
$route['fortress'] = "home/fortress";
$route['fortress/(:any)'] = "home/fortress/$1";
$route['masjid_locator'] = "home/masjid_locator";
$route['food_finder'] = "home/food_finder";
$route['hadith_library'] = "home/hadith_library";
$route['fourty_ahadees'] = "home/fourty_ahadees";
$route['coming_soon'] = "home/coming_soon";

// Admin
$route['pro_notification'] = "home/product_notification";
$route['mosques_list'] = "home/get_mosques";
$route['add_mosque'] = "home/mosque_form";
$route['save_mosque'] = "home/save_mosque";
$route['view_mosques'] = "home/view_mosques";
$route['edit_mosque/(:num)'] = "home/edit_mosque/$1";
$route['del_mosque/(:num)'] = "home/del_mosque/$1";


// Api
$route['add_token'] = "home/save_token";
$route['add_token_android'] = "home/save_android_token";
$route['get_khutbas'] = "home/get_khutbas";
$route['khutbas_list'] = "home/get_khutbas";
$route['add_khutbas'] = "home/khutbas_form";
$route['save_khutbas'] = "home/save_khutbas";
$route['view_khutbas'] = "home/view_khutbas";
$route['edit_khutbas/(:num)'] = "home/edit_khutbas/$1";
$route['del_khutbas/(:num)'] = "home/del_khutbas/$1";
$route['times'] = "home/get_paryer_timings";
$route['gallery'] = "home/gallery";

$route['get_pins'] = "home/get_pins";
$route['get_links'] = "home/get_links";

$route['default_controller'] = "home";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */