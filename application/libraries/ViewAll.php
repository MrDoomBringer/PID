<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Viewall{
	public function displayrow($row){
		echo '<tr>';
		echo '<td>'.anchor('projects/view/'.$row['Project_Name'],$row['Project_Name']).'</td>';
		echo '<td>'.$this->clean($row['Committee']).'</td>';
		echo '<td>'.$row['Difficulty'].'</td>';
		echo '<td>'.$this->clean($row['Credit']).'</td>';
		echo '<td>'.$row['Status'].'</td>';
		echo '<td>'.date_format(date_create($row['Modified']),'d-m-Y').'</td>';
		echo '</tr>';
	}
	private function clean($data){
		return preg_replace('/[\{\}]/','',$data);
	}
}
