<?php

/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class B3it_CmsHistory_Model_Observer_Page extends B3it_CmsHistory_Model_Observer_Abstract
{
    /**
     * @param $observer
     * @throws Mage_Core_Model_Store_Exception
     */
    public function onSaveAfter($observer)
    {
        /** @var Mage_Cms_Model_Page $page */
        $page = $observer->getObject();

        if (!($page instanceof Mage_Cms_Model_Page) || !$page->getId()) {
            return;
        }

        $orig_content = "";
        if($page->getOrigData('content')){
            $orig_content = $page->getOrigData('content');
        }

        if($orig_content == $page->getContent()){
            return;
        }

        $history = Mage::getModel('b3it_cmshistory/history_page');
        $history->setContent($page->getContent());
        $history->setOrigContent($orig_content);
        $history->setPageId($page->getId());
        $history->setUser($this->getOperator());
        $history->setCreatedAt(now());
        $history->setUpdatedAt(now());
        $history->setIdentifier($page->getIdentifier());
        $history->setTitle($page->getTitle());
        $history->save();
        $history->updateVersion();
    }


}
