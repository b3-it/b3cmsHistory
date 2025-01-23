<?php
/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class B3it_CmsHistory_Adminhtml_CmsHistory_History_PageController extends Mage_Adminhtml_Controller_action
{

    public function gridAction()
    {
        $this->getResponse()->setBody($this->getLayout()->createBlock('b3it_cmshistory/adminhtml_history_page_grid')->toHtml());
    }

    public function restoreAction(){
        $page_id = (int)$this->getRequest()->getParam('page_id');
        $history_id = (int)$this->getRequest()->getParam('history_page_id');

        if($page_id && $history_id){
            $history = Mage::getModel('b3it_cmshistory/history_page')->load($history_id);
            /** Mage_Cms_Model_Page **/
            $page = Mage::getModel('cms/page')->load($history->getPageId());
            $page->setContent($history->getContent());
            $page->setIdentifier($history->getIdentifier());
            $page->setTitle($history->getTitle());
            $page->save();
        }
        $this->_redirect('*/cms_page/edit', array('page_id' => $page_id));
    }

    public function deleteAction(){
        $page_id = (int)$this->getRequest()->getParam('page_id');
        $history_id = (int)$this->getRequest()->getParam('history_page_id');

        if($page_id && $history_id){
           $history = Mage::getModel('b3it_cmshistory/history_page')->load($history_id);
           $history->delete();
        }
        $this->_redirect('*/cms_page/edit', array('page_id' => $page_id));
    }

}
