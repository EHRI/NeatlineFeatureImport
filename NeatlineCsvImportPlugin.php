<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4 cc=76; */

/**
 * @package     omeka
 * @subpackage  neatline-CsvImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */


class NeatlineCsvImportPlugin extends Omeka_Plugin_AbstractPlugin
{


    const ID = 'csvimport';


    protected $_hooks = array(
       'define_routes'
    );


    protected $_filters = array(
        'admin_navigation_main'
    );

    /**
     * Register admin navigation menu
     *
     * @param array $args Contains routes
     */
    public function hookDefineRoutes($args)
    {
        $args['router']->addConfig(new Zend_Config_Ini(NL_CSV_DIR . '/routes.ini'));  
    }

    /**
     * Register admin navigation menu
     *
     * @param array $tabs Array of tabs
     * @return array Returns modified array with Neatline CSV Import tab
     */
    public function filterAdminNavigationMain($tabs)
    {
        $tabs[] = array('label' => 'Neatline CSV', 'uri' => url('neatline-csv'));
        return $tabs;
    }


}
