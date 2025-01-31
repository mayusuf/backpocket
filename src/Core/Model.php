<?php 

namespace App\Core;

/**
 * Class Model
 */
abstract class Model
{
	public const RULE_REQUIRED = 'required';
	public const RULE_EMAIL = 'email';
	public const RULE_MIN = 'min';
	public const RULE_MAX = 'max';
	public const RULE_MATCH = 'match';

	public function loadData($data)
	{
		foreach ($data as $key => $value) {
			
			if(property_exists($this,$key)){
				
				$this->{$key} = $value;

			}
		}
	}

	abstract public function rules();

	public $errors = [];

	public function validate()
	{
		foreach ($this->rules() as $attribute => $rules) {
			
			$value = $this->{$attribute};

			foreach ($rules as $rule) {
				
				$ruleName = $rule;
				
				if(!is_string($ruleName)){
					$ruleName = $rule[0];
				}

				if($ruleName === self::RULE_REQUIRED && !$value){
					
					$this->addError($attribute, self::RULE_REQUIRED);
				}

				if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
					
					$this->addError($attribute, self::RULE_EMAIL);
				}

				if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']){
					
					$this->addError($attribute, self::RULE_MIN, $rule);
				}

				if($ruleName === self::RULE_MATCH && strlen($value) != strlen($this->{$rule['match']})){

					$this->addError($attribute, self::RULE_MATCH, $rule);
				}


			}
		}

		return empty($this->errors);
	}

	public function addError(string $attribute, string $rule, $params = [])
	{
		$message = $this->errorMessage()[$rule] ?? '';
		
		foreach ($params as $key => $value) {
			$message = str_replace("{{$key}}",$value, $message);	
		}

		$this->errors[$attribute][] = $message;
	}

	public function errorMessage()
	{
		return[
			self::RULE_REQUIRED => 'This field is required',
			self::RULE_EMAIL => 'This field must be valid email address',
			self::RULE_MIN => 'Minimum length of this field must be {min}',
			self::RULE_MATCH => 'This field must match with {match}'
		];
	}

	protected function apiKeyGenerator($key)
	{

		return crypt($key,$_ENV['SALT']);
	}

	protected function passWordGenerator($pass)
	{
		
		return crypt($pass,$_ENV['SALT']);
	} 
}

?>