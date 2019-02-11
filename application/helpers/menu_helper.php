<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('active_link')) {
	function active_link($controller, $page = '', $argument=NULL, $for_img = FALSE) {
		$return_value = "active";
		if($for_img) {
			$return_value = "_selected";
		}
		// Getting CI class instance.
		$CI = get_instance();
		// Getting router class to active.
		$class = $CI->router->fetch_class();
		$method = $CI->router->fetch_method();

		if(!empty($page)) {
			if(!$argument)
			return ($class == $controller && $method == $page) ? $return_value : '';	
			else return ($class == $controller && $method == $page && $argument == $CI->uri->segment(3)) ? $return_value : '';	
		}

		return ($class == $controller) ? $return_value : '';
	}
}