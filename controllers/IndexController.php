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

       // Import items.
            Zend_Registry::get('job_dispatcher')->sendLongRunning(
                'NeatlineCsvImport_Job_ImportItems', array(
                    'exhibit_id'    => $form->getValue('exhibit'),
                    'filename'         => $path
                )
            );

         // Flash success.
          $this->_helper->flashMessenger(
            $this->_getImportStartedMessage(), 'success'
          );

           // Redirect to browse.
            $this->_redirect('/neatline/browse');
      }
    }

    $this->view->form = $form;

  }

     /**
     * Set the import started message.
     */
    protected function _getImportStartedMessage()
    {
        return __('The item import was successfully started!');
    }

}
