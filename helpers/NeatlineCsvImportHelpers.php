<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * @package     omeka
 * @subpackage  neatline-CsvImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

function nlcsv_getExhibitsForSelect()
{
   	$exhibits = get_db()->getTable("NeatlineExhibit")->findAll();
    $options = array();
    foreach($exhibits as $exhibit){
    	$options[$exhibit->id]=$exhibit->title;
    }
    return $options;
}