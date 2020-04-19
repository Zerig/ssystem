<?php
namespace SSystem;


class UserFolder extends \FileManager\Folder{
	public $fakeUrl;
	public $fakeName;
	public $users;

	public function __construct($url){
		parent::__construct($url);

		self::setUser();
		self::setFakeUrl();
	}

	public function setUser(){
		$array_name = explode("@", $this->name);
		$this->fakeName = $array_name[0];	// set fakeName

		// remove first part => name and the rest is array of user numbers
		array_shift($array_name);
		$this->users = $array_name;

	}

	public function setFakeUrl(){
		$this->fakeUrl = clone $this->dir;
		$this->fakeUrl->addPath($this->fakeName);
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


	public function hasUser($user_type){
		$result = true;
		if(!empty($this->users) && $this->users[0] == "") return true;
		$user_type = (is_array($user_type))? $user_type : [$user_type];

		foreach($user_type as $ut){
			$result = $result && in_array($ut, $this->users);
		}

		return $result;
	}

	public function getUsersCount(){
		if(empty($this->users))		return 0;
		if($this->users[0] == null)	return -1;
		else						return count($this->users);
	}

}
