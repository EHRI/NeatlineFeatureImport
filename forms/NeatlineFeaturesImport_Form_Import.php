<?php

/**
 * @package     omeka
 * @subpackage  neatline-FeaturesImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */
class NeatlineFeaturesImport_Form_Import extends Omeka_Form {

    public function init() {

        parent::init();

        $this->setMethod('post');
        $this->setAttrib('id', 'features-import-form');

        // The pick an item drop-down select:
        $this->addElement('select', 'item', array(
            "required" => true,
            'label' => __('Item'),
            'description' => __('Select the item that you want to import geo into.'),
            'multiOptions' => $this->getItemsForSelect(),
        ));

        $this->addElement('textarea', 'geo', array(
            'label' => __('Geo Data'),
            'description' => __('Add encoded geo data.'),
            'required' => true

        ));

        $this->addElement('text', 'zoom', array(
            'label' => __('Zoom'),
            'description' => __('Set map zoom.'),
            'required' => true,
            'validators' => array('Digits')

        ));

        $this->addElement('text', 'lon', array(
            'label' => __('Longitude'),
            'description' => __('Set map longitude position.'),
            'required' => true,
            'validators' => array('Float')
        ));

        $this->addElement('text', 'lat', array(
            'label' => __('Latitude'),
            'description' => __('Set map latitude position.'),
            'required' => true,
            'validators' => array('Float')
        ));

        $this->addElement('select', 'layer', array(
            'required' => true,
            'label' => __('Base Layer'),
            'description' => __('The map base layer'),
            'multiOptions' => array(
                'osm' => 'Open Street Map',
                'gphy' => 'Google Physical',
                'gmap' => 'Google Streets',
                'ghyb' => 'Google Hybrid',
                'gsat' => 'Google Satellite'
            )
        ));

        // The submit button:

        $this->addElement('submit', 'submit', array(
            'label' => __('Import Feature')
        ));

        $this->addDisplayGroup(
            array('item', 'geo', 'zoom', 'lon', 'lat', 'layer'),
            'featuresimport_info'
        );

        $this->addDisplayGroup(array('submit'), 'featuresimport_submit');
    }

    private function getItemsForSelect() {
        $options = array("" => "");
        foreach (get_db()->getTable("Item")->findAll() as $item) {
            $options[$item->id] = metadata($item, array('Dublin Core', 'Title'));
        }
        return $options;
    }
}