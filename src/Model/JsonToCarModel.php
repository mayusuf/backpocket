<?php 

namespace App\Model;

use App\Core\Db\MysqlDatabaseConn;
use App\Core\Model;
use App\Security\SecurityTrait;

final class JsonToCarModel extends Model
{
	use SecurityTrait;
	
	private $table = "cars";
	
	public string $plate_no;
	public string $brand;
	public string $model;
	public string $location;
	public string $car_year;
	public string $doors;
	public string $seats;
	public string $fuel_type;
	public string $transmission;
	public string $car_type_group;
	public string $car_type;
	public string $distance;
	public string $inside_height;
	public string $inside_length;
	public string $inside_width;
	public $created_date;
	public $update_date;
	public $is_active;

	public function __construct(){

		$this->created_date = date("Y-m-d H:i:s");
		$this->update_date = date("Y-m-d H:i:s");
		$this->is_active = 0;
	}

	public function rules():array
	{
		return[
			'firstName' => [self::RULE_REQUIRED],
			'lastName' => [self::RULE_REQUIRED],
			'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
			'uuid' => [self::RULE_REQUIRED],
			'regNumber' => [self::RULE_REQUIRED],
			'pass' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
			'passWordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'pass']],
		];
	}
	
	public function save($model):bool
	{
		$properties = array_keys(get_object_vars($model));
		$properties = array_slice($properties, 1, count($properties)-2);		

		$columns = implode(",",$properties);		

		$colStr = " ($columns) ";		

		$values = array();

		foreach ($properties as $key => $value) {
			$colVal =  $this->escapeSQLinjection($model->$value);
			array_push($values,"'".$colVal."'");
		}

		$valStr = "VALUES(". implode(",",$values) .")";	

		$sql = "INSERT INTO $this->table $colStr $valStr";		

		if(MysqlDatabaseConn::$conn->query($sql) === TRUE)
			return true;
	}
}