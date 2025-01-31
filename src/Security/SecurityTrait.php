<?php

namespace App\Security;

use App\Core\Db\MysqlDatabaseConn;

trait SecurityTrait{

 	public function xss(string $value){

 	}

 	public function escapeSQLinjection(string $value){
 		 return MysqlDatabaseConn::$conn->real_escape_string($value);
 	}
 }
?>