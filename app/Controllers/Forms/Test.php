<?php namespace App\Controllers\Forms;

class Test extends \App\Controllers\BaseController
{
	public function index() {

		helper ('form');

		//head data from BaseController
		$head = $this->getHead();
		$selectedTable = $head['selectedTable'];

		//table data from BaseController
		$data = $this->getTableData($selectedTable);

		foreach ($data['fields'] as $field) {
			$data['formData'][$field->name] = $field->default;
		}

		echo view('theme_web/head',$head);
		echo view('forms/test',$data);
		echo view('theme_web/footer');
	}

	//--------------------------------------------------------------------

}
