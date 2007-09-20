<?php 
class ZipComponent extends Object
{
    
    var $controller;
    
    var $zip;
    
    function __construct(){
        parent::__construct();
        $this->zip = new ZipArchive();
    }
    
    function __destruct(){
    }
    
    function __get($function){
        return $this->zip->{$function};
    }
    
    function startup(&$controller){
        
    }
    
    /*
     * @return boolean
     *
     * @params string, boolean 
     *
     * $path : local path for zip
     * $overwrite :   
     * 
     * usage :   
     */
    function begin($path = '', $mode = 1) {
        $mode = ( $mode>3 ) ? 0 : $mode ;
        $mode = max(0,$mode);
        $modes = array(
	      ZIPARCHIVE::OVERWRITE,
	      ZIPARCHIVE::CREATE,
	      ZIPARCHIVE::EXCL,
	      ZIPARCHIVE::CHECKCONS
        );
        $mode = $modes[$mode];
        return $this->zip->open($path, $mode);
    }
    
    function create($path) {
    		$this->begin($path);
    }
    
    function close(){
        return $this->zip->close();
    }
    
    function end(){
        return $this->close();
    }
    
    /*
     * @return boolean 
     * 
     * @params string, string (optional)
     * 
     * $file : file to be included (full path)
     * $localFile : name of file in zip, if different 
     *  
     */
    function addFile($file, $localFile = null ){
        return $this->zip->addFile($file, (is_null($localFile) ? $file : $localFile)); 
    }
    
    /*
     * @return boolean 
     * 
     * @params string, string
     *
     * $localFile : name of file in zip
     * $contents : contents of file
     *
     * usage : $this->Zip->addByContents('myTextFile.txt', 'Test text file');  
     */
    function addByContent($localFile, $contents){
        return $this->zip->addFromString($localFile, $contents);
    }
    
    /*
     * @return boolean
     * 
     * @params string, string
     * 
     * 
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
                            //$this->addFile($directory.$file, $as.$file);
                            $this->addDirectory($directory.$file.DS, $as.$file.DS);
                        }
                    }else{
                        $this->addFile($directory.$file, $as.$file);
                    }
                }
                closedir($handle);
            }else{
                return false;
            }
        }else{
            return false;
        }
        return true;
    }
    
    function addDir($directory, $as){
        $this->addDirectory($directory, $as);
    }
    
    /*
     * @return boolean
     * 
     * @params mixed
     * 
     * $mixed : undo changes to an archive by index(int), name(string), all ('all' | '*' | blank)
     * 
     * usage : $this->Zip->undo(1);
     * 		   $this->Zip->undo('myText.txt');
     * 		   $this->Zip->undo('*');
     * 
     * 		   $this->Zip->undo('myText.txt, myText1.txt');
     * 		   $this->Zip->undo(array(1, 'myText.txt'));
     */
    function undo($mixed = '*'){
        if(is_array($mixed)){
            foreach($mixed as $value){
                $constant = is_string($value) ? 'Name' : 'Index';
                if(!$this->zip->unchange{$constant}($value)){
                    return false;
                }
            }
        }else{
            $mixed = explode(',', $mixed);
            if(in_array($mixed[0], array('*', 'all'))){
                if(!$this->zip->unchangeAll()){
                    return false;
                }
            }else{
                foreach($mixed as $name){
                    if(!$this->zip->unchangeName($name)){
                        return false;
                    }
                }
            } 
        }
        return true;
    }
    
    /*
     * @return boolean
     * 
     * @params mixed, string (optional)
     * 
     * 
     */
    function rename($old, $new = null){
        if(is_array($old)){
            foreach($old as $cur => $new){
                $constant = is_string($cur) ? 'Name' : 'Index';
	            if(!$this->zip->rename{$constant}($ur, $new)){
	               return false;
	            }
            }
        }else{
            $constant = is_string($old) ? 'Name' : 'Index';
            if(!$this->zip->rename{$constant}($old, $new)){
               return false;
            }
        }
        
        return true;
    }
    
    /*
     * @return index, name or FALSE
     * 
     * @params mixed, mixed (FL_NODIR, FL_NOCASE)
     * 
     */
    function find($mixed, $options = 0){     
        if(is_string($mixed)){
            return $this->zip->locatename($mixed, $options);
        }else{
            return $this->zip->getNameIndex($mixed);
        }
    }
    
    /*
     * @return boolean
     * 
     * @params mixed
     * 
     * $mixed : undo changes to an archive by index(int), name(string), all ('all' | '*' | blank)
     * 
     */
    function delete($mixed){
        if(is_array($mixed)){
            foreach($mixed as $value){
                $constant = is_string($value) ? 'Name' : 'Index';
                if(!$this->zip->delete{$constant}($value)){
                    return false;
                }
            }    
        }else{
            $mixed = explode(',', $mixed);
            foreach($mixed as $value){
                $constant = is_string($value) ? 'Name' : 'Index';
                if(!$this->zip->delete{$constant}($value)){
                    return false;
                }
            }
        }
    }
    
    /*
     * @return boolean
     * 
     * @params mixed, string
     * 
     * $mixed : comment by index(int), name(string), entire archive ('archive')
     */
    function comment($mixed = 'archive', $comment){
        if(is_array($mixed)){
            //unsupported currently
        }else{
            if(low($mixed) === 'archive'){
                return $this->zip->setArchiveComment($comment);
            }else{
                $constant = is_string($mixed) ? 'Name' : 'Index';
                return $this->zip->setComment{$constant}($comment); 
            }
        }
    }
    
    
    function stats($mixed){
        $constant = is_string($mixed) ? 'Name' : 'Index';
        return $this->zip->stat{$constant}();
    }
    
    
    /*
     * @return boolean
     * 
     * @params string, mixed
     * 
     * $entries : single name or array of names to extract, null to extract all
     * 
     */
    function extract($location, $entries = null){
        if (!empty($entries))
                return $this->zip->extractTo($location, $entries);
        return $this->zip->extractTo($location);
    }
    
    function unzip($location, $entries = null){
        $this->extract($location, $entries);
    }
}
?>
