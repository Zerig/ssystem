<?php
namespace SSystem;


class UserFolder extends \FileManager\Folder{
	public $fakeUrl;
	public $fakename;
	public $users;

	public function __construct($url){
		parent::__construct($url);

		self::setUser();
		self::setFakeUrl();
	}

	public function setUser(){
		$array_name = explode("@", $this->name);
		$this->fakename = $array_name[0];	// set fakename

		// remove first part => name and the rest is array of user numbers
		array_shift($array_name);
		$this->users = $array_name;

	}

	public function setFakeUrl(){
		$this->fakeUrl = clone $this->dir;
		$this->fakeUrl->addPath($this->fakename);
	}

	public function scan(){
		$array_ff = parent::scan();
		$array_userff = [];

		foreach($array_ff as $ff){
			if($ff->isFile()) 	$array_userff[] = new UserFile($ff->url);
			if($ff->isDir()) 	$array_userff[] = new UserFolder($ff->url);
		}

		return $array_userff;
	}


	public function hasUser($user){
		if(!empty($this->users) && $this->users[0] == "") return true;
		return in_array($user, $this->users);
	}

}
