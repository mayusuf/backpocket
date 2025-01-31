<?php 

namespace App\Controller;

use App\Core\Controller;
use App\Model\JsonToCarModel;

/**
 * Class JsonToArray
 */
final class JsonToArray extends Controller
{
	public $fileInfo = array();
	public $data = array();

	public function __construct($fileInfo){

		$this->fileInfo = $fileInfo;
		$this->readJsonFile();
	}

	public function readJsonFile()
	{	
		
		try{			

			// Read a Json file
			$handle = fopen($this->fileInfo['dirname'].DIRECTORY_SEPARATOR.$this->fileInfo['basename'], "r");

			if(!$handle){
				throw new Exception("Error in file opening!!");				
			}

			// Read the JSON file 
			$json = file_get_contents($this->fileInfo['dirname'].DIRECTORY_SEPARATOR.$this->fileInfo['basename']);
			  
			// Decode the JSON file
			$json_data = json_decode($json,true);

			fclose($handle);
			// Iterate over every array of the file
			foreach($json_data as $key=>$item) {	

		    		$model = new JsonToCarModel();
		    		$model->loadData($item);

		    		if($model->save($model) === true){

						$res['success']= "Successfully Created New Car";
						$res['status']= 201;
						echo json_encode($res);
					}else{

						echo json_encode(["Error"]);
					}
				}				

		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
}