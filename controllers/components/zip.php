<?php
/**
 * Component that manages zip archive creation, modification and extraction.
 */
class ZipComponent extends Object {

	var $controller;
	var $zip;
	function __get($function){
		return $this->zip->{$function};
	}
	
	/**
	 * Initializes the zip object.
	 */
	function startup(&$controller) {
		$this->zip = new ZipArchive();
	}
	
	/**
	 * Starts up the work on a zip file.
	 * @param $path string The path to the file.
	 * @param $mode int the mode in wich the zip file is going to be opened. 
	 * 
	 * @return boolean true on success.
	 * 
	 * usage: Opens a zip file in one of the following modes:
	 * overwrite => Overwrite the file if it exists.
	 * create => Creates a new file
	 * excl => Fails if the file exists
	 * check => Makes additional consistency checks.
	 */
	function begin($path = '', $mode = 'create') {
		$modes = array(
			'overwrite' => ZIPARCHIVE::OVERWRITE,
			'create' => ZIPARCHIVE::CREATE,
			'excl' => ZIPARCHIVE::EXCL,
			'check' => ZIPARCHIVE::CHECKCONS
		);
		$mode = (array_key_exists($mode, $modes)) ? $mode : 'create';
		$mode = $modes[$mode];
		return $this->zip->open($path, $mode);
	}
	
	/**
	 * Alias for ZipComponent::begin($path).
	 * @param $path string The path to the file.
	 * 
	 * usage: Opens a zip file in create mode.
	 */
	function create($path) {
		$this->begin($path);
	}
	
	/**
	 * Closes the zip file.
	 * 
	 * @return boolean true on success.
	 */
	function close(){
		return $this->zip->close();
	}
	
	/**
	 * Alias for ZipComponent::close.
	 * 
	 * @return boolean true on success.
	 */
	function end(){
		return $this->close();
	}
	
	/**
	 * Adds file to the open zip archive.
	 * @param $file string path to the file to add to the zip archive.
	 * @param $localFile string name to give inside the zip archive.
	 * 
	 * @return boolean true if added successfully.
	 * 
	 * usage: add a file $file to the current zip archive, optionally rename it to
	 * $localFile inside the archive.
	 * Note: the zip file needs to be closed before it can be extracted.
	 */
	function addFile($file, $localFile = null ){
		return $this->zip->addFile($file, (is_null($localFile) ? $file : $localFile)); 
	}
	
	/**
	 * Adds a file with the specified content to the zip archive.
	 * @param $localFile string name to give inside the zip archive.
	 * @param $contents string content of the file to add to the zip archive.
	 * 
	 * @return boolean true on success 
	 * usage: adds the file $localFile with the content $contents to the open file.
	 * Note: the zip file needs to be closed before it can be extracted.
	 */
	function addByContent($localFile, $contents){
		return $this->zip->addFromString($localFile, $contents);
	}
	
	/**
	 * Adds a directory (and all its contents) to the open zip archive.
	 * @param $directory string path to the directory to add to the zip archive.
	 * @param $as string name to give the directory inside the zip archive.
	 * 
	 * @return boolean true on success 
	 * usage: adds the directory $directory renamed to $as, to the open zip archive 
	 * Note: the zip file needs to be closed before it can be extracted.
	 */
	function addDirectory($directory, $as){
		if(substr($directory, -1, 1) != DS){
			$directory = $directory.DS;
		}
		if(substr($as, -1, 1) != DS){
			$as = $as.DS;
		}
		if(is_dir($directory)){
			if($handle = opendir($directory)){
				while(false !== ($file = readdir($handle))){
					if(is_dir($directory.$file.DS)){
						if($file != '.' && $file != '..'){
							$this->addDirectory($directory.$file.DS, $as.$file.DS);
						}
					} else {
						$this->addFile($directory.$file, $as.$file);
					}
				}
				closedir($handle);
			} else{
				return false;
			}
		} else{
			return false;
		}
		return true;
	}
	
	/**
	 * Alias to ZipComponent::addDirectory.
	 * @param $directory string path to the directory to add to the zip archive.
	 * @param $as string name to give the directory inside the zip archive.
	 * 
	 * @return boolean true on success 
	 * Note: the zip file needs to be closed before it can be extracted.
	 */
	function addDir($directory, $as){
		return $this->addDirectory($directory, $as);
	}
	
	/**
	 * Undos the changes applied to an element of the zip archive.
	 * @param $mixed mixed the element or elements to undo.
	 * 
	 * @return boolean true on success.
	 * usage: undos the changes made to the elements listed in $mixed.
	 * $mixed can be a string (name inse the zip archive), a comma separated list of file names,
	 * '*' or 'all' to undo all modified items, or an array of ints (indexes) and string (names)
	 * 
	 * Examples:
	 * 		$this->Zip->undo(1);
	 * 		$this->Zip->undo('myText.txt');
	 * 		$this->Zip->undo('*');
	 * 		$this->Zip->undo('myText.txt, myText1.txt');
	 * 		$this->Zip->undo(array(1, 'myText.txt'));
	 */
	function undo($mixed = '*'){
		if(is_array($mixed)){
			foreach($mixed as $value){
				$constant = is_string($value) ? 'Name' : 'Index';
				if(!$this->zip->{'unchange' . $constant}($value)){
					return false;
				}
			}
		} else {
			$mixed = explode(',', $mixed);
			if(in_array($mixed[0], array('*', 'all'))){
				if(!$this->zip->unchangeAll()){
					return false;
				}
			} else {
				foreach($mixed as $name){
					if(!$this->zip->unchangeName($name)){
						return false;
					}
				}
			} 
		}
		return true;
	}
	
	/**
	 * Renames a file inside the zip archive.
	 * @param $file mixed names of the files to rename inside the zip archive.
	 * @param $new string new name to give to the file.
	 * 
	 * @return boolean true on success.
	 * usage: rename $file to $new if $file is not an array.
	 * Else, rename each file from $file keys to $file values.
	 */
	function rename($file, $new = null){
		if(is_array($file)){
			foreach($file as $cur => $new){
				$constant = is_string($cur) ? 'Name' : 'Index';
				if(!$this->zip->{'rename' . $constant}($cur, $new)){
					return false;
				}
			}
		} else {
			$constant = is_string($file) ? 'Name' : 'Index';
			if (!$this->zip->{'rename' . $constant}($file, $new)){
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Finds a file inside the zip archive.
	 * @param $mixed mixed name or index of the file to find.
	 * @param $options array mode in which the search has to be made.
	 * 
	 * @return mixed index or name if the file was found, false otherwise.
	 */
	function find($mixed, $options = array()){
		$flags = array(
			'nocase' => ZIPARCHIVE::FL_NOCASE,
			'nodirs' => ZIPARCHIVE::FL_NODIR 
		);
		$mode = ($options == array_keys($flags)) ?
			$flags['nocase'] | $flags['nodirs'] :
			$flags[array_pop($options)];
		if(is_string($mixed)){
			return $this->zip->locatename($mixed, $mode);
		} else {
			return $this->zip->getNameIndex($mixed);
		}
	}
	
	/**
	 * Delete a file (or files) from the zip archive.
	 * @param mixed name or array of names and indexes of the files to delete.
	 * 
	 * @return boolean true on success.
	 * usage: delete the file or files in $mixed. 
	 * If one fails no rollback is made.
	 */
	function delete($mixed){
		if(is_array($mixed)){
			foreach($mixed as $value){
				$constant = is_string($value) ? 'Name' : 'Index';
				if(!$this->zip->{'delete' . $constant}($value)){
					return false;
				}
			}	
		} else {
			$mixed = explode(',', $mixed);
			foreach($mixed as $value){
				$constant = is_string($value) ? 'Name' : 'Index';
				if(!$this->zip->{'delete' . $constant}($value)){
					return false;
				}
			}
		}
	}
	
	/**
	 * Sets comments to the files inside the archive (or to the archive itself)
	 * @param mixed $mixed name of the file to add a comment, or array of files.
	 * @param string $comment comment to set to the file.
	 * 
	 * @return boolean true on success
	 * usage: set comment $comment to the archive if $mixed == 'archive', else
	 * set the comment to the file $mixed (filename or index).
	 * If $mixed is an array, sets the comment of each file, form $mixed's keys, to the comment form $mixed's values.  
	 */
	function comment($mixed = 'archive', $comment = null) {
		if(is_array($mixed)){
			foreach($mixed as $file => $comment){
				$constant = is_string($value) ? 'Name' : 'Index';
				if (!$this->zip->{'setComment' . $constant}($comment)) {
					return false;
				}
			}
		} else {
			if(low($mixed) === 'archive'){
				return $this->zip->setArchiveComment($comment);
			} else {
				$constant = is_string($mixed) ? 'Name' : 'Index';
				return $this->zip->{'setComment' . $constant}($comment); 
			}
		}
	}
	
	/**
	 * Gets the details of the file identified by $mixed (key or name).
	 * @param mixed $mixed string (name) or int (key)
	 * @param array $flags wether to get the current file status or the original, and
	 * if $mixed is string wether to ignore case and directories.
	 * 
	 * @return mixed the details of the file or false on failure.
	 * usage: 
	 */
	function stats($mixed, $original = array()) {
		$constant = is_string($mixed) ? 'Name' : 'Index';
		$flags = array(
			'nocase' => ZIPARCHIVE::FL_NOCASE,
			'nodirs' => ZIPARCHIVE::FL_NODIR,
			'original' => ZIPARCHIVE::FL_UNCHANGED 
		);
		if (is_string($mixed)) {
			$mode = null;
			foreach ($original as $key) {
				if (in_array($key, array_keys($flags))) {
					$mode = $mode | $flags[$key];
				}
			}
			if (!empty($original))
				return $this->zip->{'stat' . $constant}($mixed, $mode);
			else
				return $this->zip->{'stat' . $constant}($mixed);
		} else {
			if ($original===array('original'))
				return $this->zip->{'stat' . $constant}($mixed, $modes['original']);
			else
				return $this->zip->{'stat' . $constant}($mixed);
		}
	}
	
	
	/**
	 * Extract the zip archive to a location.
	 * @param string $location path to the location where the zip archive is
	 * going to be extracted.
	 * @param mixed $entries name or array of names of files to extract.
	 * 
	 * @return boolean true on success
	 * usage: extracts current zip archive to the specified location.
	 * Extracts only the files specified in $entries or all files if $entries is null.
	 */
	function extract($location, $entries = null){
		if (!empty($entries))
			return $this->zip->extractTo($location, $entries);
		return $this->zip->extractTo($location);
	}
	
	/**
	 * Alias for ZipComponent::extract
	 * 
	 * @return boolean true on success
	 */
	function unzip($location, $entries = null){
		return $this->extract($location, $entries);
	}
}
?>
