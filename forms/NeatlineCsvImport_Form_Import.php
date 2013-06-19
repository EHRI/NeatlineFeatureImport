<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * @package     omeka
 * @subpackage  neatline-CsvImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

class NeatlineCsvImport_Form_Import extends Omeka_Form
{

    public function init()
    {
    
        parent::init();

        // The pick-an-exhibit drop-down select:
        
        $this->addElement('select', 'exhibit', array(
            'label' => __('Exhibit'),
            'description' => __('Select the exhibit that you want to import records into.'),
            'multiOptions' => nlcsv_getExhibitsForSelect()
            // More attributes here, see:
            // https://github.com/scholarslab/Neatline/blob/develop/forms/Neatline_Form_Exhibit.php#L129
        ));
        
        // The file upload form:
        
        $this->addElement('file', 'csv', array(
            'label' => __('CSV File'),
            'description' => __('Select the CSV file.')
        ));
        
        // The submit button:
        
        $this->addElement('submit', 'submit', array(
            'label' => __('Import Records')
        ));
        
    }

}