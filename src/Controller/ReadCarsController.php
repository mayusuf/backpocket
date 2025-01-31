<?php 

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Controller\CsvToArray;
use App\Controller\JsonToArray;
use App\Trait\DirReadTrait;

/**
 * Class readCarsController
 */
final class ReadCarsController extends Controller
{
	use DirReadTrait;

	public $dir;
	public $files = array();
	public $fileInfo = array();

	public function __construct(){

		$this->dir = "../uploads";
	}

	public function readCarsFromFile(Request $request)
	{	
		
		$this->files = $this->readDir($this->dir);		
		$n = count($this->files);

		try{

			if($n==0){
				throw new Exception("There are no files in the directory!!");				
			}

			for($i=2; $i<$n; $i++){
			
			$this->fileInfo = pathinfo("$this->dir".DIRECTORY_SEPARATOR.$this->files[$i]);

			switch($this->fileInfo['extension']){

				case "csv":
					new CsvToArray($this->fileInfo);
				break;

				case"json";
					new JsonToArray($this->fileInfo);
				break;
				
				default:
					throw new Exception("File extension is not supported !!");
				}

			}

		}catch(Exception $e){
			echo $e->getMessage();
		}	
		
	}
}