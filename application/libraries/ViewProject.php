<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projectView{
	public function rstrip($string){
		$string = preg_replace('/\,/',', ',$string);
		$string = preg_replace('/\"/','',$string);
		return preg_replace('/\{|\}/', '', $string);
	}
}
	public function hreffix($string){
		return rawurlencode($string);
	}
}
