<?php namespace App\Controllers\Datatables;

class Home extends \App\Controllers\BaseController
{
	public function index()
	{

		//head data from BaseController
		$head = $this->getHead();
		$selectedTable = $head['selectedTable'];

		//table data from BaseController
		$data = $this->getTableData($selectedTable);

		if ($data === false) //no table selected
			return redirect()->to('/')->with('error', 'Select a table from the current database!');

		//get the primary key
		//assume no primary key
		$primaryKey = false;
		if (count($data['primaryKey']))
			$primaryKey = implode(',', $data['primaryKey']);


		//constructing the model code
		$code='<table class="table table-bordered table-striped table-sm table-responsive dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">

  <thead>
    <tr>
      <th>Select</th>'."\n";

		foreach ($data['fields'] as $field) {

			//skip primary key and timestamps
			if (in_array($field->name,[$primaryKey,'created_at','updated_at','deleted_at']))
				continue;

			$code.='      <th>'.$field->name.'</th>'."\n";
		}

		$code.='      <th>Actions</th>
    </tr>
  </thead>

  <tbody>'."\n"."\n";

	$code.='    <?php foreach ($dataTable as $row) : ?>

    <tr>'."\n";

  //select column
	$code.='      <td>X</td>'."\n";

	foreach ($data['fields'] as $field) {

			//skip primary key and timestamps
			if (in_array($field->name,[$primaryKey,'created_at','updated_at','deleted_at']))
				continue;

			$code.='      <td><?=$row[\''.$field->name.'\']?></td>'."\n";

		}

	//actions column
	$code.='      <td>A</td>'."\n";

	$code.='    </tr>

    <?php endforeach; ?>'."\n";

	$code.='
  </tbody>

</table>';


		$data['selectedTable'] = $selectedTable;
		$data['code']=htmlspecialchars($code);

		echo view('theme_web/head',$head);
		echo view('datatables/index',$data);
		echo view('theme_web/footer');
	}

	//--------------------------------------------------------------------

}
