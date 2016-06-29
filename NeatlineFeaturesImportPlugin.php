<?php

/**
 * @package     omeka
 * @subpackage  neatline-FeaturesImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */
class NeatlineFeaturesImportPlugin extends Omeka_Plugin_AbstractPlugin
{
    const ID = 'featuresimport';

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
        $args['router']->addConfig(new Zend_Config_Ini(NL_FEAT_DIR . '/routes.ini'));
    }

    /**
     * Register admin navigation menu
     *
     * @param array $tabs Array of tabs
     * @return array Returns modified array with Neatline Features Import tab
     */
    public function filterAdminNavigationMain($tabs)
    {
        $tabs[] = array('label' => 'Features Import', 'uri' => url('features-import'));
        return $tabs;
    }
}
