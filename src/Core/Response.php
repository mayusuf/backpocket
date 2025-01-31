<?php 
namespace App\Core;

/**
 * Class Response
 */
class Response
{
	
	public function setStatusCode(int $code)
	{
		http_response_code($code);
	}
}
?>