<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * CodeIgniter Twig Class
 *
 *
 * @package	CodeIgniter
 * @subpackage	Libraries 
 * @category	Libraries
 * @author	Kevin Fairbanks - Purple Monkey Studio
 * @link	https://gitlab.com/PurpleMonkeyStudio/Twig-CodeIgniter
 * @copyright   Copyright (c) 2015, Purple Monkey Studio, LLC.
 * @version 	1.0.0
 *
 */

//Load Twig autoloader
require_once(APPPATH . 'third_party/Twig/Autoloader.php');

class Twig{
    private $_ci;
    private $_twig;
    private $_cache_path = '';
    private $_theme_path = '';
    private $_theme = '';
    
    public function __construct(){
        //Register Twig and Setup Enviroment
        $this->_ci = &get_instance();
        $this->_ci->config->load('twig');
        $this->_twig = self::spawn();
    }
    
    /**
     * Spawn a new instance of Twig
     * @return object
     */
    private function spawn(){
        Twig_Autoloader::register();
        if($this->_cache_path === ''){
            $this->_cache_path = $this->_ci->config->item('twig_cache_path');
        }
        if($this->_theme_path === ''){
            $this->_theme_path = $this->_ci->config->item('twig_theme_path');
        }
        if($this->_theme === ''){
            $this->_theme = $this->_ci->config->item('twig_theme');
        }
        
        $loader = new Twig_Loader_Filesystem($this->_theme_path . $this->_theme);
        
        if($this->_cache_path){
            $twig = new Twig_Environment($loader, array(
                'autoescape' => false,
                'cache' => $this->_cache_path
            ));
        }else {
            $twig = new Twig_Environment($loader, array(
                'autoescape' => false
            ));
        }
        
        return $twig;        
    }
    
    /**
     * Set new theme
     * @return void
     */
    public function setTheme($theme){
        $this->_theme = $theme;
        $this->_twig = self::spawn();
    }
    
    /**
     * Register a function with Twig
     * @param string
     * @param string
     * @return void
     */
    public function registerFunction($functionName, $alias = ''){
        if($alias === ''){
            $this->_twig->addFunction($functionName, new Twig_Function_Function($functionName));
        }else {
            $this->_twig->addFunction($alias, new Twig_Function_Function($functionName));
        }
    }
    
    /**
     * Parse and render through Twig
     * @param string
     * @param array
     * @param bool
     * @return string
     */
    public function render($_view, $data, $return=FALSE){
        
        foreach($this->_ci->config->item('twig_functions') as $function){
            $this->registerFunction($function);
        }
        
        //Start Benchmark
        $this->_ci->benchmark->mark('start_twig_parsing');
        
        if(!is_array($data)){
            //convert object to array
            $data = (array)$data; 
        }
        
        //No missing data
        $data = array_merge($data, $this->_ci->load->_ci_cached_vars);
        
        //Parse template
        try{
            $parsed_view = $this->_twig->render($_view, $data);
        } catch (Exception $ex) {
            show_error($ex);
        }
        
        //Stop Benchmark
        $this->_ci->benchmark->mark('end_twig_parsing');
        
        //Return the results?
        if(!$return){
            $this->_ci->output->append_output($parsed_view);
        }
        
        return $parsed_view;
    }
    
}

/* End of file Twig.php */
/* Location: ./application/libraries/Twig.php */
