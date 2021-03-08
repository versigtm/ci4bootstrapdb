<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		$this->session = \Config\Services::session();

		//check post data - selected table
		if ($this->request->getMethod()=='post' && $this->request->getPost('selectTable') === 'YES')
			$this->session->set(['selectedTable'=>$this->request->getPost('table')]);

	}

	public function getHead() {

		$head = new \App\Libraries\DBtools($this->session->get('selectedTable'));
		return $head->getHeadData();

	}

	//--------------------------------------------------------------

	public function getTableData($selectedTable) {

		$data = new \App\Libraries\DBtools($selectedTable);

		//check to see if the selected table is in the database
		if ($data->getSelectedTable())
			return $data->getTableData();
		else 
			return false;

	}

	//--------------------------------------------------------------

}
