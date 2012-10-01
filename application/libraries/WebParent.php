<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class WebParent{
	public function WebParent(){
		$this->webdata['website'] = 'PID';
		$this->webdata['username'] = $_SERVER['WEBAUTH_USER'];
		$this->webdata['realname'] = $_SERVER['WEBAUTH_LDAP_CN'];
	}
}
