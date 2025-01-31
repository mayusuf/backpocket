<?php 

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Model\CarModel;

/**
 * Class CarController
 */
final class CarController extends Controller
{
	
	public function getCars()
	{

		$model = new CarModel();
		$carList = $model->getCars();

		if($carList){

			$data['cars'] = $carList;
			$data['status']= 200;
			echo json_encode($data);

		}else{

			$data['cars'] = "No Car";
			echo json_encode($data);
		}
		
	}

	public function getSingleCar(Request $request)
	{
		try{

			if(!isset($request->getParams()['id'])){

				throw new Exception("No Valid Parameters");
			}

			$model = new CarModel();
			$res = $model->getSingleCar($request->getParams()['id']);	
		
			if($res){

				$data['car']= $res;
				$data['status']= 200;
				echo json_encode($data);

			}else{

				$data['car']= "No Car";
				echo json_encode($data);
			}	

		}catch(Exception $e){
			echo $e->getMessage();
		}			
		
	}

	public function create(Request $request)
	{
		$model = new CarModel();
	
		$model->loadData($request->getBody());		
		
		if($model->save($model) === true){

			$data['success']= "Successfully Created New Scooter";
			$data['status']= 201;
			echo json_encode($data);

		}else{

			echo json_encode("Error");
		}	
		
	}

}