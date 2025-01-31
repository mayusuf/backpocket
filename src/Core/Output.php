<?php 

namespace App\Core;
/**
 * Class Output
 */
class Output
{
	
	public function renderView($view,$data = [])
	{
		$layoutContent = $this->layoutContent();
		$viewContent = $this->renderOnlyView($view,$data);
		return str_replace('{{content}}',$viewContent,$layoutContent);
		
	}

	protected function layoutContent()
	{
		ob_start();
		include_once Application::$SRC_DIR."/views/layouts/main.php";
		return ob_get_clean();
	}

	protected function renderOnlyView($view,$data)
	{
		ob_start();
		extract($data);
		include_once Application::$SRC_DIR."/views/$view.php";
		return ob_get_clean();	
	}

	public function renderContent($viewContent)
	{
		$layoutContent = $this->layoutContent();
		return str_replace('{{content}}',$viewContent,$layoutContent);	
	}
}
?>