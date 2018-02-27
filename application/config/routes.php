<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['incidente/:num'] = 'incidente';
$route['pessoa/:num'] = 'pessoa';
$route['usuario/:num'] = 'usuario';
$route['modulo/:num'] = 'modulo';
