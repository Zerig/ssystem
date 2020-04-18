<?php
namespace SSystem;


class UserFile extends \FileManager\File{
	public $fakeUrl;
	public $fakeName;
	public $fakeFilename;
	public $users;

	public function __construct($url){
		parent::__construct($url);

		self::setUser();
		self::setFakeUrl();
	}

	public function setUser(){
		$array_name = explode("@", $this->filename);
		$this->fakeFilename = $array_name[0];					// set fakeFilename
		$this->fakeName = $array_name[0].".".$this->extension;	// set fakeName


		// remove first part => name and the rest is array of user numbers
		array_shift($array_name);
		$this->users = $array_name;
	}

	public function setFakeUrl(){
		$this->fakeUrl = clone $this->dir;
		$this->fakeUrl->addPath($this->fakeName);
	}


	public function hasUser($user){
		if(!empty($this->users) && $this->users[0] == "") return true;
		return in_array($user, $this->users);
	}

	public function getUsersCount(){
		return count($this->users);
	}

}
