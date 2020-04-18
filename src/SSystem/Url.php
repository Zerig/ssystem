<?php
namespace SSystem;


class Url extends \UrlParser\Url{
	public $dir;
	public $mysql;
	public $get;

	public function __construct($url, $server_url){
		parent::__construct($url);




		$server_url->pop();
		$server_url->addPath("www");
		$server_url->addPath(self::getPath());
		$server_url->removeExtension();
		$server_url->removeScheme();
		$server_url->removeHost();
		$server_url->removeRoot();

		//echo $server_url->getString();

		//$this->url = $server_url;

		// FIND REAL EXISTING FOLDERS in fake URL
		$existFolder_array = array_reverse( self::existingFolders(clone $server_url, []) );		// Folders fro URL which are real
		$existUrl = end($existFolder_array)->url;	// [System\UserFolder] choose the longest real path

		echo $existUrl->getString();

		$this->dir = $existUrl->getPath();		// save existing path into DIR

		//$path = new \UrlParser\Url($this->path);
		echo count($this->dir);
		$server_url->shift(count($this->dir));	// remove all existing dir part
		$this->get = $server_url->getPath();		// save all rest folders into GET

	}






	public function existingFolders($url, $existFolder_array){
		$folder = new \SSystem\UserFolder(clone $url);

		// When you get to root folder, then stop all deep cycling
		if($folder->url->getString() != ""){
			// when folder path really exist put it into
			if($folder->exist())	$existFolder_array[] = $folder;

			$url->pop();
			return self::existingFolders($url, $existFolder_array);
		}

		return $existFolder_array;
	}

}
