<?php 

require_once __DIR__.'/../vendor/autoload.php';

use App\Core\Application;
use App\Controller\readCarsController;
use App\Controller\CarController;

$rootDirectory = dirname(__DIR__);
$srcDirectory = $rootDirectory.'\src';

// Loading for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable($rootDirectory);
$dotenv->load();

$app = new Application($srcDirectory);

$app->router->get('/api/oscar_read', [new readCarsController(),'readCarsFromFile']);
$app->router->get('/api/cars', [new CarController(),'getCars']);
$app->router->get('/api/car', [new CarController(),'getSingleCar']);
$app->router->post('/api/car', [new CarController(),'create']);

$app->run();

?>