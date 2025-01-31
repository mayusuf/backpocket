<?php 

namespace App\Controller;

use App\Core\Controller;
use App\Model\CsvToCarModel;

/**
 * Class CsvToArray
 */
final class CsvToArray extends Controller
{
	public $fileInfo = array();
	public $data = array();

	public function __construct($fileInfo){

		$this->fileInfo = $fileInfo;
		$this->readCsvFile();
	}

	public function readCsvFile()
	{	
		
		try{			

			// Read a CSV file
			$handle = fopen($this->fileInfo['dirname'].DIRECTORY_SEPARATOR.$this->fileInfo['basename'], "r");

			if(!$handle){
				throw new Exception("Error in file opening!!");				
			}

			$startLineNumber = 1;

			// Iterate over every line of the file
			while (($raw_string = fgets($handle)) !== false) {	

				if($startLineNumber === 2){

					$row = str_getcsv($raw_string);
		    		$this->data = $this->setData($row);

		    		$model = new CsvToCarModel();
		    		$model->loadData($this->data);

		    		if($model->save($model) === true){

						$res['success']= "Successfully Created New Car";
						$res['status']= 201;
						echo json_encode($res);
					}else{

						echo json_encode("Error");
					}
				}
	    		
	    		$startLineNumber= 2;
			}

			fclose($handle);			

		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	private function setData($row):array 
	{
		$data = array();

		$data['location'] = $row[0] ? $row[0] :"";
		$data['brand'] = $row[1] ? $row[1] :"";
		$data['model'] = $row[2] ? $row[2] :"";
		$data['plate_no'] = $row[3] ? $row[3] : "";
		$data['car_year'] = $row[4] ? $row[4] :"";
		$data['doors'] = $row[5] ? $row[5] :"";
		$data['seats'] = $row[6] ? $row[6] :"";
		$data['fuel_type'] = $row[7] ? $row[7] :"";
		$data['transmission'] = $row[8] ? $row[8] :"";
		$data['car_type_group'] = $row[9] ? $row[9] :"";
		$data['car_type'] = $row[10] ? $row[10] :"";

		return $data;
	}
}