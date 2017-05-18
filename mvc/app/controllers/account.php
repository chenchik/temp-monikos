<?php 

/* Created by Danila Chenchik Monikos LLC  */

class Account extends Controller {

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
		//echo "\n echoing user name " . $user->name;


		//directory path
		//$this->view('account/index', ['name' => $user->name]);
		$this->view('account/login');
	}

	public function test($param){
		echo " : " . $param . " : ";
	}

	public function create($username = '', $email = '', $password = ''){
		$this->view('account/create', ['name' => $user->name, 
									'username' => $username,
									'email' => $email,
									'password' => $password]);	

	}
	public function login(){
		$this->view('account/login');
	}

	public function loginSuccess(){
		$this->view('home/index');
	}

	public function loginCallback(){
		$this->view('account/login-callback');
	}



}

?>