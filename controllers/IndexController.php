<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * @package     omeka
 * @subpackage  neatline-CsvImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

class NeatlineCsvImport_IndexController extends Omeka_Controller_AbstractActionController
{

	public function indexAction ()
	{
		$form = new NeatlineCsvImport_Form_Import;
		if ($this->_request->isPost()){
			if ($form->isValid($this->_request->getPost())){
				$form->csv->receive();
				$csv = new CsvImport_File($form->csv->getFilename(), ',');
				$csv->parse();
				print_r($csv->getColumnNames());
				exit;
			}
		}
		$this->view->form = $form;
	}
}