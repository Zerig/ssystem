<?php
namespace SSystem;


class Loader{
	public $url;
	public $real_url;

	public $user_type = 1;

	public $_main = [];
	public $_php;
	public $php;
	public $_index;
	public $index;

	public $_page;
	public $page;


	public function __construct($server_url){
		$server_url->pop();
		$server_url->addPath("www");
		$server_url->addPath($GLOBALS["url"]->getPath());
		$server_url->removeExtension();
		$server_url->removeScheme();
		$server_url->removeHost();
		$server_url->removeRoot();

		$this->url = $server_url;

		// FIND REAL EXISTING FOLDERS in fake URL

		$existFolder_array = array_reverse( self::existingFolders(clone $this->url, []) );		// Folders fro URL which are real
		$this->real_url = end($existFolder_array)->url;


		foreach($existFolder_array as $folder){
			echo print_r( $folder->url->getString() )."<br>";

			$array_ff = $folder->scan();
			foreach($array_ff as $ff){
				if(!isset($ff->extension) ||  $ff->extension != "php") break;

				if($ff->name == "_main.php") 	$this->_main[] = $ff;	// collect all "_main.php" files

				if($ff->name == "_.php") 		$this->_php = $ff;		// save latest "_.php" file
				if($ff->name == ".php") 		$this->php = $ff;		// save latest ".php" file

				if($ff->name == "_index.php") 		$this->_index = $ff;	// save latest "_index.php" file
				if($ff->name == "index.php") 		$this->index = $ff;		// save latest "index.php" file
			}

		}

		self::setPage();


		/*if($GLOBALS["url"]->hasFile())	$ff = new \FileManager\Folder($server_url);
		else    						$ff = new \FileManager\Folder($server_url);

		echo "EXIST: ".$ff->exist()."<br>";

		echo print_r($ff);*/
	}

	public function setPage(){
		$len = [];

		$len["php"] = 		max( intval(count($this->_php->url->getPath("array"))) , intval(count($this->php->url->getPath("array"))) );
		$len["index"] = 	max( intval(count($this->_index->url->getPath("array"))) , intval(count($this->index->url->getPath("array"))) );

		if($len["php"] > $len["index"]){
			$this->_page = $this->_php;
			$this->page = $this->php;

		}else if($len["php"] < $len["index"]){
			$this->_page = $this->_index;
			$this->page = $this->index;

		}else{
			if($this->url->getString() == $this->real_url->getString()){
				$this->_page = $this->_index;
				$this->page = $this->index;

			}else{
				$this->_page = $this->_php;
				$this->page = $this->php;
			}
		}





	}



	public function existingFolders($url, $existFolder_array){
		$folder = new \FileManager\Folder(clone $url);

		// When you get to root folder, then stop all deep cycling
		if($folder->url->getString() != ""){
			if($folder->exist())	$existFolder_array[] = $folder;

			$url->pop();
			return self::existingFolders($url, $existFolder_array);
		}

		return $existFolder_array;
	}

}
