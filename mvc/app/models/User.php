<?php 

/* Created by Danila Chenchik Monikos LLC  */
/* Currently not in use  */

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent{
	public $name;

	public $timestamps =[];

	protected $fillable = ['username','email'];
}

?>