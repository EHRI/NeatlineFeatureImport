<?php

/**
 * @package     omeka
 * @subpackage  neatline-FeaturesImport
 * @copyright   2012 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */
class NeatlineFeaturesImport_IndexController extends Omeka_Controller_AbstractActionController
{
    public function indexAction()
    {
        $form = new NeatlineFeaturesImport_Form_Import;

        if ($this->_request->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $db = get_db();

                $itemId = $form->getValue('item');
                $item = $db->getTable('Item')->find($itemId);

                // Get or create a coverage column for the item
                $elemId = $db->fetchOne($db->select()
                    ->from(array('e' => $db->prefix . 'elements'), array('e.id'))
                    ->where('e.name = "Coverage"'));

                $textId = $db->fetchOne($db->select()
                    ->from(array('e' => $db->prefix . 'element_texts'), array('e.id'))
                    ->where('e.record_id = ?', $itemId)
                    ->where('e.element_id = ?', $elemId));

                // When a coverage field is a geo feature the data
                // is serialized into a pipe-delimited string.
                $elemTextValue = sprintf("%s|%s|%s|%s|%s\n",
                    $form->getValue('geo'),
                    $form->getValue('zoom'),
                    $form->getValue('lon'),
                    $form->getValue('lat'),
                    $form->getValue('layer')
                );
                if (empty($textId)) {
                    $elemText = new ElementText();
                    $elemText->record_id = $itemId;
                    $elemText->record_type = 'Item';
                    $elemText->element_id = $elemId;
                    $elemText->text = $elemTextValue;
                    $elemText->save();
                    $textId = $elemText->id;
                } else {
                    $elemText = $db->getTable('ElementText')->find($textId);
                    $elemText->text = $elemTextValue;
                    $elemText->save();
                }

                $featureId = $db->fetchOne(
                    $db->select()
                        ->from(array('e' => $db->prefix . 'neatline_features'), array('e.id'))
                        ->where('e.item_id = ?', $itemId)
                        ->where('e.element_text_id = ?', $textId)
                        ->where('e.is_map = 1')
                        ->order('e.added ASC')
                );

                $feature = empty($featureId)
                    ? new NeatlineFeature($item)
                    : $db->getTable('NeatlineFeature')->find($featureId);

                $feature->setArray(array(
                    'added' => null, // populated automatically!
                    'element_text_id' => $textId,
                    'is_map' => true,
                    'geo' => $form->getValue('geo'),
                    'zoom' => $form->getValue('zoom'),
                    'center_lon' => $form->getValue('lon'),
                    'center_lat' => $form->getValue('lat'),
                    'base_layer' => $form->getValue('layer')
                ));
                $feature->save();

                // Flash success.
                $this->_helper->flashMessenger(
                    __('The feature was successfully imported!'), 'success'
                );

                // Redirect to browse.
                $this->_redirect('/items/show/' . $itemId);
            }
        }

        $this->view->form = $form;
    }
}
