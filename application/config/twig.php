<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| CACHE DIRECTORY
|--------------------------------------------------------------------------
| Set the cache directory which is used by the Twig library
| To disable caching, set to FALSE
| 
| Default: FALSE
*/
$config['twig_cache_path'] = FALSE;

/*
|--------------------------------------------------------------------------
| THEMES DIRECTORY
|--------------------------------------------------------------------------
| Set the themes directory which is used by the Twig library
| 
| Default: APPPATH . 'themes/'
*/
$config['twig_theme_path'] = APPPATH. 'themes/';

/*
|--------------------------------------------------------------------------
| DEFAULT THEME
|--------------------------------------------------------------------------
| Set the default theme which is used by the Twig library
| 
| Default: 'default'
*/
$config['twig_theme'] = 'default';

/*
|--------------------------------------------------------------------------
| FUNCTIONS
|--------------------------------------------------------------------------
| Set the CI functions which are used by the Twig library
| These functions must already be called as a helper in your application
| 
| Default: array()
*/
$config['twig_functions'] = array(
    'form_open',
    'form_label',
    'form_close',
    'form_error',
    'form_input',
    'form_password',
    'form_checkbox',
    'form_submit'
);
