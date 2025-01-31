<?php

namespace App\Trait;


trait DirReadTrait{

 	public function readDir(string $dir){

 		// Open a directory, and read its contents
		if (is_dir($dir)){		

			$fileArray = array();

			if ($dh = opendir($dir)){
		  	
		    	while (($file = readdir($dh)) !== false){
		    		
		      		array_push($fileArray,$file);
		    	}
		    	closedir($dh);
			}

			return $fileArray;
 		}
 	}
 }
