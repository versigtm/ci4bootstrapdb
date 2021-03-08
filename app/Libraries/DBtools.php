<?php namespace App\Libraries;

class DBtools
{

  //database connector
  protected $db;

  //selected table
  protected $table;

  //custom database
	protected $customDB = [
		'DSN'      => '',
		'hostname' => 'localhost',
		
// uncomment the section below after entering the username, password and database
/*		'username' => 'user',
    'password' => 'password',
    'database' => 'database',
*/
		'DBDriver' => 'MySQLi',

		'DBPrefix' => '',
		'pConnect' => false,
		'DBDebug'  => (ENVIRONMENT !== 'production'),
		'cacheOn'  => false,
		'cacheDir' => '',
		'charset'  => 'utf8',
		'DBCollat' => 'utf8_general_ci',
		'swapPre'  => '',
		'encrypt'  => false,
		'compress' => false,
		'strictOn' => false,
		'failover' => [],
		'port'     => 3306,
	];

  public function __construct($tab = '_no_table')
  {

    //DB connection
		try {
			$this->db = \Config\Database::connect($this->customDB);
		}
		catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

		//select table - if parameter in list of tables
		if (in_array($tab, $this->db->listTables()))
			$this->table = $tab;
		else
			$this->table = false;
  }

  //--------------------------------------------------------------

  public function getAvailableTables() {
  	//get available tables
		return $this->db->listTables();
  }

  //--------------------------------------------------------------

  public function getSelectedTable() {
  	//get available tables
		return $this->table;
  }

  //--------------------------------------------------------------

  public function getHeadData() {
  	//get available tables
		$head['tables'] = $this->db->listTables();
		$head['tables'][] = '_no_table';

		//selected table
		if ($this->table)
			$head['selectedTable'] = $this->table;
		else
			$head['selectedTable'] = '_no_table';

		return $head;
  }

  //--------------------------------------------------------------

  public function getTableData() {

  	//database
		$selectedDB = $this->customDB['database'];
		$data['database'] = $selectedDB;

		//selected table
		$selectedTable = $this->table;

		//fields data
		$fields = $this->db->getFieldData($selectedTable);
		$data['fields'] = $fields;

		//extended fields data
		$query = $this->db->query ("SHOW FULL COLUMNS FROM ".$selectedTable);
		$df = $query->getResultArray();

		foreach ($df as $value) {
			$data['fieldsExt'][$value['Field']] = $value;
		}

		//indexes
		$data['indexes'] = $this->db->getIndexData($selectedTable);

		//foreign keys
		$data['foreignKeys'] = $this->db->getForeignKeyData($selectedTable);

		//extended foreign keys
		$query = $this->db->query ("SELECT c.*, cl.FOR_COL_NAME, cl. REF_COL_NAME FROM INFORMATION_SCHEMA.INNODB_FOREIGN c join INFORMATION_SCHEMA.INNODB_FOREIGN_COLS cl on c.ID=cl.ID
				where FOR_NAME = '".$selectedDB."/".$selectedTable."'");
		$data['foreignKeysExt'] = $query->getResultArray();

		//note: the fkdef comment in the table referenced by the foreign key will indicate the column that will be displayed to identify the record (for example in a dropdown list)

		//primary key
		$primaryKey = [];
		foreach ($fields as $field) {
			if ($field->primary_key == 1)
				$primaryKey[]=$field->name;
		}
		$data['primaryKey'] = $primaryKey;

		//create statement
		$query = $this->db->query ("SHOW CREATE TABLE ".$selectedTable);
		$createStatement = $query->getResult()[0];
		if (isset($createStatement->Table)) {
			$data['createStatement'] = $createStatement->{'Create Table'};
			$data['tableType'] = 'TABLE';
		}
		else {
			$data['createStatement'] = $createStatement->{'Create View'};
			$data['tableType'] = 'VIEW';
		}

		return $data;

	}

}

?>
