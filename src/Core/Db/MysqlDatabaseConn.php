<?php 

namespace App\Core\Db;

interface DBConntectionInterface{

	public static function connection();
}

class MysqlDatabaseConn implements DBConntectionInterface
{
	
	private $data = [];
	
	private static $servername;
	private static $username;
	private static $password;
	private static $db;

	public static $conn;

	// public function __construct(){

	// 	self::connection();
		
	// }

	public static function connection(){

		self::$servername = $_ENV['DATABASE_HOST'];
		self::$username = $_ENV['DATABASE_USER'];
		self::$password = $_ENV['DATABASE_PASSWORD'];
		self::$db = $_ENV['DATABASE_DBNAME'];

		self::$conn = mysqli_connect(self::$servername, self::$username, self::$password, self::$db);

		// Check connection
		if (self::$conn->connect_error) {
		  die("Connection failed: " . self::$conn->connect_error);
		}

		 // echo "Connected successfully";

		if(isset(self::$conn)){

		        self::$conn;
		}else{
		        self::$conn = self::connection();		        
		        
		}
		
	}
	
}

?>