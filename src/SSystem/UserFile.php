<?php
namespace SSystem;


class UserFile extends \FileManager\File{
	public $user_type = 1;

	public $fakeUrl;
	public $fakename;
	public $users;

	public function __construct($url){
		parent::__construct($url);

		self::setUser();
	}

	public function setUser(){
		$array_name = explode("@", $this->filename);
		$this->fakename = $array_name[0];	// set fakename

		// remove first part => name and the rest is array of user numbers
		$this->users = array_shift($array_name);

	}

	public function setFakeUrl(){
		$this->fakeUrl = clone $this->dir;
		$this->fakeUrl->add($this->fakename.$this->extension);
	}

}
