<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * @package     omeka
 * @subpackage  neatline-CsvImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

if (!defined('NL_CSV_DIR')) {
	define('NL_CSV_DIR', dirname(__FILE__));
}

// Plugin
require_once NL_CSV_DIR . '/NeatlineCsvImportPlugin.php';

// Forms	
require_once NL_CSV_DIR.'/forms/NeatlineCsvImport_Form_Import.php';

// Helpers
require_once NL_CSV_DIR.'/helpers/NeatlineCsvImportHelpers.php';


$csvimport = new NeatlineCsvImportPlugin();
$csvimport->setUp();
