<?php
namespace SSystem;


class Url extends \UrlParser\Url{
	public $dir;
	public $mysql;
	public $get;

	public $user_type = 2;

	public function __construct($url, $server_url){
		parent::__construct($url);

		// from SERVER_URL create PAGE_URL
		$server_url->pop();
		$server_url->addPath("www");
		$server_url->addPath(self::getPath());
		$server_url->removeExtension();
		$server_url->removeScheme();
		$server_url->removeHost();
		$server_url->removeRoot();


		// FIND REAL EXISTING FOLDERS in fake URL
		$real_url = self::existingFolders(clone $server_url, new \UrlParser\Url("www"));		// Folders fro URL which are real

		$this->dir = $real_url->getPath();		// save existing path into DIR


		$server_url->shift(count($this->dir));	// remove all existing dir part
		$this->get = $server_url->getPath();		// save all rest folders into GET

	}









	/*
	 * $url [\UrlParser\Url]		potential server url => "www/aaa/bbb"
	 * $real_url [\UrlParser\Url]	in the beginning => "", then collect real existing best user URL
	 * @return [\UrlParser\Url]		returns updated $real_url
	 */
	public function existingFolders($url, $real_url){
		$array_potential_url = [];									// array of potential folders
		$search_folder = new \SSystem\UserFolder($real_url);	// folder for scanning

		// array of scanned FF from FOLDER
		$array_ff = $search_folder->scan();

		// GO through all scanned ff and seleft only potential folders
		foreach($array_ff as $ff){
			if(!$ff->isDir())											continue;	// SKIP if the FF is not FOLDER
			if(!empty($ff->users) && !$ff->hasUser($this->user_type))	continue;	// when there is USER skip userFiles which is not for HIM
			if($this->user_type == null && $ff->getUsersCount() > 0)	continue;	// when there is NO USER skip userFiles

			if($ff->fakeName == $url->getPath("array")[0])	$array_potential_url[] = $ff; 	// [] add Potential url Folder
		}

		$real_uFolder = self::findBestUserFolder($array_potential_url);			// From potential
		$real_url = ($real_uFolder != null)? $real_uFolder->url : $real_url;	// best USER ufolder->url

		$url->shift();	// remove what was find
		if($url->getPath() == []) return $real_url;

		return self::existingFolders($url, $real_url);
	}








	public function findBestUserFolder($array_ufolder){
		$best_ufolder = null;
		$userCount =  PHP_INT_MAX;

		// FIND non USER folder
		foreach($array_ufolder as $ufolder){
			if(empty($ufolder->users))	$best_ufolder = $ufolder;
		}

		if($this->user_type == 0)	return $best_ufolder;

		// FIND USER folder for ALL users
		foreach($array_ufolder as $ufolder){
			if(!empty($ufolder->users) && $ufolder->users[0] == null)	$best_ufolder = $ufolder;
		}

		// FIND closest USER folder for this specific type of user
		foreach($array_ufolder as $ufolder){
			if(!empty($ufolder->users) && $ufolder->users[0] != null){
				if($ufolder->getUsersCount() < $userCount){
					$userCount =  $ufolder->getUsersCount();
					$best_ufolder = $ufolder;
				}
			}
		}

		return $best_ufolder;
	}












	public function getDir($exp = null){
		if(!isset($this->dir)) 	return null;

		if($exp == null)			return $this->dir;
		if($exp == "array")			return $this->dir;
		if($exp == "string")		return implode($this->sign, $this->dir);
	}

	public function getGet($exp = null){
		if(!isset($this->get)) 	return null;

		if($exp == null)			return $this->get;
		if($exp == "array")			return $this->get;
		if($exp == "string")		return implode($this->sign, $this->get);
	}

	public function getMysql($exp = null){
		if(!isset($this->mysql)) 	return null;

		if($exp == null)			return $this->mysql;
		if($exp == "array")			return $this->mysql;
		if($exp == "string")		return implode($this->sign, $this->mysql);
	}
}
