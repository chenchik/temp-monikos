<?php

/* Created by Danila Chenchik Monikos LLC  */

class Controller {

	public function model($model){
		//echo $model;

		//maybe include file check

		$modelFile = INC_ROOT . '/app/models/' . $model . '.php';
		if(file_exists($modelFile)){
			require_once $modelFile;
			//creates new model
			return new $model();
		}
	}

	//$data = [] automatically defines a variable
	public function view($view, $data = []){
		require_once INC_ROOT . '/app/views/' . $view . '.php';
	}
	
}

?>