<?php 

namespace App\Core;

/**
 * Class Request
 */
final class Request
{
	private $path;
	private $paramStartPos;
	private $method;
	
	public function getPath()
	{
		$this->path = $_SERVER['REQUEST_URI'] ?? '/';
		$this->paramStartPos = strpos($this->path,'?');

		if($this->paramStartPos === false){

			return $this->path;
		}
		
		$this->path = substr($this->path,0,$this->paramStartPos);
		return $this->path;

	}

	public function getMethod()
	{
		$this->method = strtolower($_SERVER['REQUEST_METHOD']);
		return $this->method;
	}

	public function getBody()
	{
		$body = [];

		// print_r($_POST);

		if($this->getMethod() === 'get'){
			
			foreach ($_GET as $key => $value) {
				$body[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}

		if($this->getMethod() === 'post'){
			
			foreach ($_POST as $key => $value) {
				$body[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}

		if($this->getMethod() === 'get'){
			
			foreach ($_GET as $key => $value) {
				$body[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}

		return $body;
	}

	public function getParams()
	{
		$this->path = $_SERVER['REQUEST_URI'] ?? '/';
		$this->paramStartPos = strpos($this->path,'?');

		$params = [];

		if($this->paramStartPos === false){

			return $params;
		}
		
		$paramStr = substr($this->path,$this->paramStartPos+1);

		if($paramArray = explode('&',$paramStr)){
			
		}

		$singleParamDividerPos = strpos($paramStr,'=');

		$params[substr($paramStr,0,$singleParamDividerPos)] = substr($paramStr,$singleParamDividerPos+1);

		return $params;
	}
}
?>