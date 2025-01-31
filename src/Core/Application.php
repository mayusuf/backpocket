<?php

namespace App\Core;

use App\Core\Db\MysqlDatabaseConn;

/**
 * Class Application
 */
class Application
{
	
	public static string $SRC_DIR;
	public Router $router;
	public Request $request;
	public Response $response;
	public Output $output;
	public static Application $app;

	public function __construct($srcPath)
	{
		self::$SRC_DIR = $srcPath;
		self::$app = $this;
		$this->request = new Request();
		$this->response = new Response();
		$this->output = new Output();
		$this->router = new Router($this->request,$this->response);
		MysqlDatabaseConn::connection();
	}

	public function run()
	{
		// To do
		echo $this->router->resolve();
	}

}
?>