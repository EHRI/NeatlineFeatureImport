<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */


class NeatlineCsvImport_Job_ImportItems extends Omeka_Job_AbstractJob
{


    /**
     * Import Omeka items.
     */
    public function perform()
    {

        $filename = $this->_options['filename'];
        $exhibitid = $this->_options['exhibit_id'];
        $exhibitsTable = $this->_db->getTable('NeatlineExhibit');
        $exhibit = $exhibitsTable->find($exhibitid);

                $file = fopen($filename, 'r');

        $rows = array();
        while (($row = fgetcsv($file, 4096)) !== false) {
          $rows[] = $row;
        }

        $keys = array_shift($rows);
      
        foreach ($rows as $i => $row) {

          $row = array_combine($keys, $row);

          $record = new NeatlineRecord($exhibit);
          $record->setArray($row);
          $record->save();

        }
       

    }
}