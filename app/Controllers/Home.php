<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{		

		//head data from BaseController
		$head = $this->getHead();

		//initial data
		$data = ['selectedTable'=>'_no_table'];
		//check for selected table data
		$tabledata = $this->getTableData($head['selectedTable']);
		if ($tabledata !== false)
			$data = $tabledata;


		echo view('theme_web/head',$head);
		echo view('index',$data);
		echo view('theme_web/footer');

	}

	//--------------------------------------------------------------------

}
