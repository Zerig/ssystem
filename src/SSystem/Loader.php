<?php
namespace SSystem;


class Loader{
	public $dirUrl;

	public $user_type = 1;

	public $_main = [];
	public $_php;
	public $php;
	public $_index;
	public $index;

	public $_page;
	public $page;



	public function setMain(){
		$dirUrl = 	clone $this->dirUrl;
		$scanUrl = 	

	}


	/*public function __construct($server_url){
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

		$i = 0;
		foreach($existFolder_array as $folder){
			$array_ff = $folder->scan();

			// => add USER FOLDER CHANGE; !!!!!!!!!!!!!!!!!

			echo "<hr>";

			// SPECIFIC FOLDER LEVEL SCAN
			foreach($array_ff as $ff){
				//if($ff->name == "_@.php") echo print_r($ff);

				if($ff->isDir() || $ff->extension != "php")					continue;	// ff must be file with ".php" extension
				if(!empty($ff->users) && !$ff->hasUser($this->user_type))	continue;	// when there is USER skip userFiles which is not for HIM
				if($this->user_type == null && $ff->getUsersCount() > 0)	continue;	// when there is NO USER skip userFiles


				if( !empty($_php) 	&& end($_php)->url->getDepth() < $ff->url->getDepth() )		$_php = [];
				if( !empty($php) 	&& end($php)->url->getDepth() < $ff->url->getDepth() )		$php = [];
				if( !empty($_index) && end($_index)->url->getDepth() < $ff->url->getDepth() )	$_index = [];
				if( !empty($index) 	&& end($index)->url->getDepth() < $ff->url->getDepth() )	$index = [];

				if($ff->fakeName == "_main.php") 	$_main[$i][] = $ff;		// collect all "_main.php" files
				if($ff->fakeName == "_.php") 		$_php[] = $ff;		// save latest "_.php" file
				if($ff->fakeName == ".php") 		$php[] = $ff;		// save latest ".php" file
				if($ff->fakeName == "_index.php") 	$_index[] = $ff;	// save latest "_index.php" file
				if($ff->fakeName == "index.php") 	$index[] = $ff;		// save latest "index.php" file

			}

			$i++;	// for "$_main[$i]" RAISER

		}
		echo "<hr>";
		echo "<hr>";
		//echo print_r($_main);
		foreach($_main as $i){
			foreach($i as $item){
				echo $item->url->getString()."<br>";
			}
		}
		echo "<hr>";



		foreach($_main as $_i){
			$this->_main[] = self::findBestUserFile($_i);
		}
		$this->_php = self::findBestUserFile($_php);
		$this->php = self::findBestUserFile($php);
		$this->_index = self::findBestUserFile($_index);
		$this->index = self::findBestUserFile($index);

		echo $this->_php->url->getString();
		self::setPage();

	}*/


	public function findBestUserFile($array_ufile){
		$best_ufile = null;
		$userCount =  PHP_INT_MAX;

		// FIND non USER file
		foreach($array_ufile as $ufile){
			if(empty($ufile->users))	$best_ufile = $ufile;
		}

		// FIND USER file for ALL users
		foreach($array_ufile as $ufile){
			if(!empty($ufile->users) && $ufile->users[0] == null)	$best_ufile = $ufile;
		}

		// FIND closest USER file for this specific type of user
		foreach($array_ufile as $ufile){
			if(!empty($ufile->users) && $ufile->users[0] != null){
				if($ufile->getUsersCount() < $userCount){
					$userCount =  $ufile->getUsersCount();
					$best_ufile = $ufile;
				}
			}
		}

		return $best_ufile;
	}


	public function setPage(){
		$len = [];

		$len["php"] = 	max( $this->_php->url->getDepth(), $this->php->url->getDepth() );
		$len["index"] = max( $this->_index->url->getDepth(), $this->index->url->getDepth() );

		if($len["php"] > $len["index"])			self::setUfileAsPage($this->_php, $this->php);
		else if($len["php"] < $len["index"])	self::setUfileAsPage($this->_index, $this->index);
		else{
			// if URL PATH has no GET part - only real existing part
			if($this->url->getString() == $this->real_url->getString())		self::setUfileAsPage($this->_index, $this->index);
			else															self::setUfileAsPage($this->_php, $this->php);
		}
	}


	public function setUfileAsPage($_ufile, $ufile){
		if($_ufile->url->getDepth() == $ufile->url->getDepth()){
			$this->_page = $_ufile;
			$this->page =  $ufile;
		}else if($this->_ufile->url->getDepth() > $this->ufile->url->getDepth()){
			$this->_page = $_ufile;
			$this->page =  null;
		}else{
			$this->_page = null;
			$this->page =  $ufile;
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
