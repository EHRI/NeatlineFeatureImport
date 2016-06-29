<?php

/**
 * @package     omeka
 * @subpackage  neatline-FeaturesImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

if (!defined('NL_FEAT_DIR')) {
    define('NL_FEAT_DIR', dirname(__FILE__));
}

// Plugin
require_once NL_FEAT_DIR . '/NeatlineFeaturesImportPlugin.php';

// Forms
require_once NL_FEAT_DIR . '/forms/NeatlineFeaturesImport_Form_Import.php';

$nfimport = new NeatlineFeaturesImportPlugin();
$nfimport->setUp();
