<?php
namespace SSystem;


class Loader{
	public $url;
	public $real_url;

	public $user_type = 1;

	public $_main;
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





		$_main = [];
		$_php = [];
		$php = [];
		$_index = [];
		$index = [];


		foreach($existFolder_array as $folder){
			echo print_r( $folder->url->getString() )."<br>";

			$array_ff = $folder->scan();
			foreach($array_ff as $ff){
				if(!isset($ff->extension) || $ff->extension != "php"){	// ff must be file with ".php" extension
				if(empty($ff->users) || $ff->hasUser($this->user_type)){

				if($ff->fakename == "_main.php") 	$_main[] = $ff;	// collect all "_main.php" files

				if($ff->fakename == "_.php") 		$_php[] = $ff;		// save latest "_.php" file
				if($ff->fakename == ".php") 		$php[] = $ff;		// save latest ".php" file

				if($ff->fakename == "_index.php") 	$_index[] = $ff;	// save latest "_index.php" file
				if($ff->fakename == "index.php") 	$index[] = $ff;		// save latest "index.php" file
				}}
			}

		}

		echo print_r($_main);
		$_main = self::filterUserFiles($_main);
		$_php = self::filterUserFiles($_php);
		$php = self::filterUserFiles($php);
		$_index = self::filterUserFiles($_index);
		$index = self::filterUserFiles($index);

		$this->_main = self::findBestFile($_main);
		$this->_php = self::findBestFile($_php);
		$this->php = self::findBestFile($php);
		$this->_index = self::findBestFile($_index);
		$this->index = self::findBestFile($index);


		self::setPage();


		/*if($GLOBALS["url"]->hasFile())	$ff = new \FileManager\Folder($server_url);
		else    						$ff = new \FileManager\Folder($server_url);

		echo "EXIST: ".$ff->exist()."<br>";

		echo print_r($ff);*/
	}


	public function findBestFile($array_file){
		$longest_url_file = end($array_file);
		echo 9999;
		foreach($array_file as $file){
			//echo  (intval( count( $file->url->getPath("array") ) ) > intval( count( $longest_url_file->url->getPath("array") ) ) )."<br>";
			if( intval( count( $file->url->getPath("array") ) ) > intval( count( $longest_url_file->url->getPath("array") ) ) ){
				$longest_url_file = $file;
			}
		}

		return $longest_url_file;
	}


	public function filterUserFiles($array_file){
		$new_array_file = [];
		foreach($array_file as $file){
			if(empty($file->users)){
				$new_array_file[] = $file;

			}else{
				foreach($file->users as $user){
					if($user == $this->user_type)	$new_array_file[] = $file;
				}
			}
		}

		return $new_array_file;
	}



	public function setPage(){
		$len = [];

		//$len["php"] = 		max( intval(count($this->_php->url->getPath("array"))) , intval(count($this->php->url->getPath("array"))) );
		//$len["index"] = 	max( intval(count($this->_index->url->getPath("array"))) , intval(count($this->index->url->getPath("array"))) );

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
		$folder = new \SSystem\UserFolder(clone $url);

		// When you get to root folder, then stop all deep cycling
		if($folder->url->getString() != ""){
			if($folder->exist())	$existFolder_array[] = $folder;

			$url->pop();
			return self::existingFolders($url, $existFolder_array);
		}

		return $existFolder_array;
	}

}
