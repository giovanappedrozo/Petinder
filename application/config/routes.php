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

$route['imagem'] = 'imageUpload_Controller';
$route['usuarios/login'] = 'usuarios/login';
$route['animais/register'] = 'animais/register';
$route['animais/review'] = 'animais/review';
$route['animais/filter'] = 'animais/filter';
$route['animais/racas'] = 'animais/select_racas';
$route['animais/queue/(:any)'] = 'animais/queue/$1';
$route['animais/back_to_adoption/(:any)'] = 'animais/back_to_adoption/$1';
$route['animais/delete/(:any)'] = 'animais/delete/$1';
$route['animais/edit/(:any)'] = 'animais/edit/$1';
$route['animais/view/(:any)'] = 'animais/view/$1';
$route['animais/(:number)'] = 'animais';
$route['animais'] = 'animais';
$route['usuarios/register'] = 'usuarios/register';
$route['usuarios/verify_notifications'] = 'usuarios/verify_notifications';
$route['usuarios/denuncia/(:any)/(:any)/(:any)/(:any)'] = 'usuarios/denuncia/$1/$2/$3/$4';
$route['usuarios/review/(:any)'] = 'usuarios/review/$1';
$route['usuarios/application'] = 'usuarios/adoption_form';
$route['usuarios/match'] = 'usuarios/perfect_match';
$route['usuarios/recover_password'] = 'usuarios/recover_password';
$route['usuarios/change_password'] = 'usuarios/change_password';
$route['usuarios/resetpassword/(:any)'] = 'usuarios/resetpassword/$1';
$route['usuarios/solicitacoes'] = 'usuarios/view_likes';
$route['usuarios/matches/adotar'] = 'usuarios/view_matches_adotar';
$route['usuarios/matches/doar'] = 'usuarios/view_matches_doar';
$route['usuarios/my_animals'] = 'usuarios/my_animals';
$route['usuarios/my_adopted'] = 'usuarios/my_adopted';
$route['usuarios/my_donated'] = 'usuarios/my_donated';
$route['usuarios/des-au-gosteis'] = 'usuarios/my_dislikes';
$route['usuarios/mi-au-doreis'] = 'usuarios/my_likes';
$route['usuarios/chats/donate'] = 'usuarios/my_chats_donate';
$route['usuarios/chats/adopt'] = 'usuarios/my_chats_adopt';
$route['usuarios/load_notification'] = 'usuarios/load_notification';
$route['usuarios/confirm_password'] = 'usuarios/confirm_password';
$route['usuarios/delete/(:any)'] = 'usuarios/delete/$1';
$route['usuarios/edit/(:any)'] = 'usuarios/edit/$1';
$route['mensagens/addMessage'] = 'mensagens/addMessage';
$route['mensagens/load_messages'] = 'mensagens/load_messages';
$route['mensagens/verify_messages'] = 'mensagens/verify_message';
$route['mensagens/(:any)/(:any)'] = 'mensagens/chat/$1/$2';
$route['mensagens/(:any)'] = 'mensagens/chat/$1';
$route['usuarios/application'] = 'usuarios/application';
$route['usuarios/logout'] = 'usuarios/logout';
$route['usuarios/(:any)/(:any)'] = 'usuarios/view/$1/$2';
$route['usuarios/(:any)'] = 'usuarios/view/$1';
$route['usuarios'] = 'usuarios';
$route['teste'] = 'TesteUnitario';
$route['petinder'] = 'Informations/about';
$route['adoption'] = 'Informations/adoption';
$route['howtoadopt'] = 'Informations/how_to';
$route['match'] = 'Informations/match';
$route['default_controller'] = 'LanguageSwitcher';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
