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

        $path = $form->csv->getFilename();
        $file = fopen($path, 'r');

        $rows = array();
        while (($row = fgetcsv($file, 4096)) !== false) {
          $rows[] = $row;
        }

        $keys = array_shift($rows);

        // Get exhibit id.
        $exhibitsTable = $this->_helper->db->getTable('NeatlineExhibit');
        $exhibit = $exhibitsTable->find($form->getValue('exhibit'));

        foreach ($rows as $i => $row) {

          $rows[$i] = array_combine($keys, $row);

          $record = new NeatlineRecord($exhibit);
          $record->setArray($values);
          $record->save();

        }

        print_r($rows);

				exit;
			}
		}

		$this->view->form = $form;

	}

}
