<?php 

class Payment extends Controller {
	protected $user;
	public function __construct(){
		$this->user = $this->model('User');
	}
	public function index($name = '', $otherName = ''){
		
		//creates the user
		$user = $this->model('User');
		$user->name = $name;
		//directory path
		$this->view('payment/pricing', ['name' => $user->name]);
	}
}

?>