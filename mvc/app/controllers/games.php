<?php

/* Created by Danila Chenchik Monikos LLC  */

class Games extends Controller {

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
		$this->view('games/gamemenu');
	}

	public function names(){
		$this->view('games/names');
	}

	public function menu($lid = ''){
		$this->view('games/gamemenu', ['lid'=> $lid]);
	}

	public function game1($lid = '', $challengeFlag = '', $game = '', $user1 = '', $user2 = '', $bet = '', $challengeid = ''){
		$this->view('games/game1',['lid'=> $lid, 'challengeFlag'=> $challengeFlag, 'game'=> $game,'user1'=> $user1, 'user2'=> $user2,'bet'=> $bet, 'challengeid'=> $challengeid]);
	}

	public function game2($lid = '', $challengeFlag = '', $game = '', $user1 = '', $user2 = '', $bet = '', $challengeid = ''){
		$this->view('games/game2',['lid'=> $lid, 'challengeFlag'=> $challengeFlag, 'game'=> $game, 'user1'=> $user1, 'user2'=> $user2,'bet'=> $bet, 'challengeid'=> $challengeid]);
	}

	public function flashcard($lid = '', $challengeFlag = '', $game = '', $user1 = '', $user2 = '', $bet = '', $challengeid = ''){
		$this->view('games/flashcard',['lid'=> $lid, 'challengeFlag'=> $challengeFlag, 'game'=> $game, 'user1'=> $user1, 'user2'=> $user2,'bet'=> $bet, 'challengeid'=> $challengeid]);
	}
}

?>
