<?php namespace App\Controllers\Forms;

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

		//constructing the form
		$code='<form> <!-- replace with form_open() function from the form helper library -->
  <div class="form-row">'."\n"."\n";

		foreach ($data['fields'] as $field) {
			
			//skip primary key and timestamps
			if (in_array($field->name,[$primaryKey,'created_at','updated_at','deleted_at']))
				continue;

			$code.='    <div class="form-group col-md-6">
      <label for="'.$field->name.'">'.$field->name;
      if ($field->nullable != 1)
      	$code.=' *';
      $code.='</label>'."\n";

    	//field types
			switch ($field->type) {

				//integers
				case 'tinyint':
				case 'smallint':
				case 'mediumint':
				case 'int':
				case 'bigint':

					$code.='      <input type="number" class="form-control" id="'.$field->name.'" name="'.$field->name.'" value="<?=$formData[\''.$field->name.'\']?>" step="1"';
					if ($field->nullable != 1)
      			$code.=' required=""';
					$code.='>'."\n";

				break;

				//float
				case 'decimal':
				case 'float':
				case 'double':
				case 'real':

					$code.='      <input type="number" class="form-control" id="'.$field->name.'" name="'.$field->name.'" value="<?=$formData[\''.$field->name.'\']?>" step="0.0001"';
					if ($field->nullable != 1)
      			$code.=' required=""';
					$code.='>'."\n";

				break;

				//date time - same as text
				case 'datetime':
				case 'date':
				case 'timestamp':

				//text
				case 'char':
				case 'varchar' :

					$code.='      <input type="text" class="form-control" id="'.$field->name.'" name="'.$field->name.'" value="<?=$formData[\''.$field->name.'\']?>"';
					if ((int)$field->max_length > 0)
						$code.=' maxlength="'.$field->max_length.'"';
					if ($field->nullable != 1)
      			$code.=' required=""';
					$code.='>'."\n";

				break;

				//textarea
				case 'tinytext':
				case 'text':
				case 'mediumtext':
				case 'longtext':
				case 'tinyblob':
				case 'mediumblob':
				case 'blob':
				case 'longblob':

					$code.='      <textarea class="form-control" name="'.$field->name.'" id="'.$field->name.'" rows="3"><?=$formData[\''.$field->name.'\']?></textarea>'."\n";

				break;

				//dropdown
				case 'enum':
					$code.='      <select class="form-control" name="'.$field->name.'" id="'.$field->name.'">'."\n";

					$allowedEnum = $data['fieldsExt'][$field->name]['Type'];
					$allowedEnum = trim($allowedEnum,'enum()');
					$allowedEnum = str_replace("'",'', $allowedEnum);
					//check for comments in DB
					if (!empty($data['fieldsExt'][$field->name]['Comment'])) {
						$dopt = explode(';', $data['fieldsExt'][$field->name]['Comment']);
						foreach ($dopt as $item) {
							$option = explode(':',$item);
							$code.='        <option value="'.$option[0].'" <?php if($formData[\''.$field->name.'\'] == \''.$option[0].'\') echo \'selected\' ?>>'.$option[1].'</option>'."\n";
						}
					}
					else {
						$dropOptions = explode(',',$allowedEnum);
						foreach ($dropOptions as $option) {
							$code.='        <option value="'.$option.'" <?php if($formData[\''.$field->name.'\'] == \''.$option.'\') echo \'selected\' ?>>'.$option.'</option>'."\n";
						}
					}
					$code.='      </select>'."\n";
				break;
			}

			//error line
			$code.='      <p class="help-block text-danger"><?php if (isset($formErrors[\''.$field->name.'\'])) echo "Error '.$field->name.'"; ?></p>'."\n";

			$code.='    </div>'."\n"."\n";

		}

		$code.='  </div>

  <button class="btn btn-primary" type="submit">Submit</button>
  
</form>';

		$data['selectedTable'] = $selectedTable;
		$data['code']=htmlspecialchars($code);

		echo view('theme_web/head',$head);
		echo view('forms/index',$data);
		echo view('theme_web/footer');
	}

	//--------------------------------------------------------------------

}
