<?php  

namespace App\Core;

/**
 * Class Router
 * 
 */
final class Router 
{
	
	public Request $request;
	public Response $response;
	public Output $output;

	protected $routes = [];

	public function __construct(Request $request, Response $response)
	{
		$this->request = $request;
		$this->response = $response;
		$this->output = new Output();
	}

	public function get($path, $callback)
	{
		$this->routes['get'][$path] = $callback;
	}

	public function post($path, $callback)
	{
		$this->routes['post'][$path] = $callback;
	}

	public function delete($path, $callback)
	{
		$this->routes['delete'][$path] = $callback;
	}
	
	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->getMethod();

		//print_r($this->routes);

		$callback = $this->routes[$method][$path] ?? false;
		
		//print_r($callback);

		
		if($callback === false){
			$this->response->setStatusCode(404);

			return $this->output->renderView("_404");
			
		}

		if(is_string($callback)){
			return $this->output->renderView($callback);
		}

		return call_user_func($callback,$this->request);
	}

	
}

?>