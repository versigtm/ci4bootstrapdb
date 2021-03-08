<?php namespace App\Controllers\Datatables;

class Test extends \App\Controllers\BaseController
{
	public function index() {

		helper ('form');

		//head data from BaseController
		$head = $this->getHead();
		$selectedTable = $head['selectedTable'];

		//table data from BaseController
		$data = $this->getTableData($selectedTable);

		$modelClients = new \App\Models\Clients();
		$data['dataTable'] = $modelClients->getAllClients();

		//$modelUsers = new \App\Models\Users();
		//$data['dataTable'] = $modelUsers->getAllUsers();

		echo view('theme_web/head',$head);
		echo view('datatables/test',$data);
		echo view('theme_web/footer');
	}

	//--------------------------------------------------------------------

}
