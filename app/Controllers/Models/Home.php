<?php namespace App\Controllers\Models;

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

		//calculate fields list and check for timestamps
		$fieldList = "";
		$timestamps = false;
		foreach ($data['fields'] as $field) {
			//field list
			if (!in_array($field->name,[$primaryKey,'created_at','updated_at']))
				$fieldList.='\''.$field->name.'\',';
			//timestamps
			if (in_array($field->name,['created_at','updated_at','deleted_at']))
				$timestamps = true;
		}
		$fieldList = trim($fieldList,',');

		//constructing the model code
		$code='';
		$code.='<?php namespace App\Models;

use CodeIgniter\Model;

class '.ucfirst($selectedTable).' extends Model
{
    protected $table      = \''.$selectedTable.'\';
';

  if ($primaryKey !== false)
   	$code.='    protected $primaryKey = \''.$primaryKey.'\';';

$code.='  
    protected $returnType    = \'array\';
    protected $allowedFields = ['.$fieldList.'];';

  if ($timestamps === true)
  	$code.=
'

    //timestamps
    protected $useTimestamps = true;
    protected $createdField  = \'created_at\';
    protected $updatedField  = \'updated_at\';
    protected $deletedField  = \'deleted_at\';


    //validation';
	
	$validationRules = [];
	foreach ($data['fields'] as $field) {
		
		//skip primary key and timestamps
		if (in_array($field->name, [$primaryKey,'created_at','updated_at','deleted_at']))
			continue;

		//init
		$validationRules[$field->name] = '';

		//required
		if ($field->nullable == '')
			$validationRules[$field->name].='required';
		else
			$validationRules[$field->name].='permit_empty';

		//data types
		switch ($field->type) {
			//integers
			case 'tinyint':
			case 'smallint':
			case 'mediumint':
			case 'int':
			case 'bigint': $validationRules[$field->name].='|integer'; break;
			//float
			case 'decimal':
			case 'float':
			case 'double':
			case 'real': $validationRules[$field->name].='|decimal'; break;
			//date time
			case 'datetime':
			case 'date':
			case 'timestamp': $validationRules[$field->name].='|valid_date'; break;
			//limited strings
			case 'char':
			case 'varchar' : $validationRules[$field->name].='|max_length['.$field->max_length.']'; break;
			//enum
			case 'enum':
				$allowedEnum = $data['fieldsExt'][$field->name]['Type'];
				$allowedEnum = trim($allowedEnum,'enum()');
				$allowedEnum = str_replace("'",'', $allowedEnum);
				$validationRules[$field->name].='|in_list['.$allowedEnum.']';
			break;
		}

		//try for email field
		if (strpos(strtolower($field->name),'email') !== false)
			$validationRules[$field->name].='|valid_email';

	}

$code.= '
    protected $validationRules    = [
';
  foreach ($validationRules as $key => $value) {
  	$code.='      \''.$key.'\' => \''.$value."',\n";
  }
$code.=
    '    ];';

$code.='
    //protected $validationMessages = [];
    protected $skipValidation     = false;';

  //standard function to retrieve one record by primary key
  if ($primaryKey !== false) {
  	$code.= '

  //------------------------------------------------------------

  //get one record by primary key

  public function get'.ucfirst($selectedTable).' ($primaryKey = NULL) {

    if ($primaryKey)
      return $this->find($primaryKey);
    else
      return false;

  }
  	';
  }

  //get all records
    $code.= '	
  //------------------------------------------------------------

  //get all records

  public function getAll'.ucfirst($selectedTable).' () {

    return $this->findAll();

  }
	';

/*
	//function to get full data, including referenced foreign key tables
	//preparing the query
	if (count($data['foreignKeys'])) {
		$noFK = 0;
  	//count get all foreign key columns
  	$fkColumns = [];

  	foreach ($data['foreignKeys'] as $key) {
  		$noFK++;
  		$fkColumns[$noFK]['column'] = $key->column_name;
  		$fkColumns[$noFK]['ref_table'] = $key->foreign_table_name;
  		$fkColumns[$noFK]['ref_column'] = $key->foreign_column_name;
  		$fkColumns[$noFK]['replaced_by'] = '';
  		if (substr($data['fieldsExt'][$key->column_name]['Comment'],0,6) == 'fkcol:')
  			$fkColumns[$noFK]['replaced_by'] = substr($data['fieldsExt'][$key->column_name]['Comment'],6);
		}

		$data['fkColumns'] = $fkColumns;
	}
	*/

		$code.='
}';

		$data['selectedTable'] = $selectedTable;
		$data['code']=htmlspecialchars($code);

		echo view('theme_web/head',$head);
		echo view('models/index',$data);
		echo view('theme_web/footer');
	}

	//--------------------------------------------------------------------

}
