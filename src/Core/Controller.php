<?php 

namespace App\Core;


/**
 * Class Controller
 */
abstract class Controller
{
	
	public function render($view, $data=[])
	{
		
		return Application::$app->output->renderView($view,$data);
	}
}

?>