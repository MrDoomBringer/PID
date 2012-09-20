<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProjectSubmit{
	public function camelCase($string){
		// Formats title string
		$string = preg_replace('/([A-Z])/','<u>$1</u>',$string);
		$string = '<h3>'.$string.'</h3>';
		return $string;
	}
	private function psqarray($single){
		// surrounds string in curly braces
		return '{'.$single.'}';
	}
	private function clean($post){
		// Gets data ready for database set
		if($post['Difficulty'] == "Unsure"){
			$post['Difficulty'] = 0;
		}
		$post['Committee'] = $this->psqarray(implode(',',$post['Committee']));
		$post['Credit'] = $this->psqarray($post['Credit']);
		if($post['Source'] != NULL){
			$post['Source'] = $this->psqarray($post['Source']);
		}
		if($post['Related'] != NULL){
			$post['Related'] = $this->psqarray($post['Related']);
		}
		return $post;
	}
}
