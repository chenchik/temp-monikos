<?php

/* Created by Danila Chenchik Monikos LLC  */

class Home extends Controller {

	protected $user;

	public function __construct(){
		$this->user = $this->model('User');
	}


	public function index($name = '', $otherName = ''){

		//refers to user model
		//we can do $this->model becuase this class extends Controller, and ->model is incliuded in controller

		//creates the user
		$user = $this->model('User');
		$user->name = $name;

		//directory path
		$this->view('payment/index', ['name' => $user->name]);
	}

	public function test($param){
		echo " : " . $param . " : ";
	}
}

?>
