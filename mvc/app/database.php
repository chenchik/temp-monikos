<?php  

/* Created by Danila Chenchik Monikos LLC  */

//namespacing
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
	'driver' => 'mysql',
	'host' => 'monikosdb.ci7ganrx1sxe.us-east-1.rds.amazonaws.com:3306',
	'username' => 'monikosdbun',
	'password' => 'monikosdbpw',
	'database' => 'monikosdb',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => '',
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();

?>