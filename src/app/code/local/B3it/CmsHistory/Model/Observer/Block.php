<?php

/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class B3it_CmsHistory_Model_Observer_Block extends B3it_CmsHistory_Model_Observer_Abstract
{
    /**
     * @param $observer
     * @throws Mage_Core_Model_Store_Exception
     */
    public function onSaveAfter($observer)
    {
        /** @var Mage_Cms_Model_Page $block */
        $block = $observer->getObject();

        if (!($block instanceof Mage_Cms_Model_Block) || !$block->getId()) {
            return;
        }
        $orig_content = "";
        if($block->getOrigData('content')){
            $orig_content = $block->getOrigData('content');
        }

        $history = Mage::getModel('b3it_cmshistory/history_block');
        $history->setContent($block->getContent());
        $history->setOrigContent($orig_content);
        $history->setBlockId($block->getId());
        $history->setUser($this->getOperator());
        $history->setCreatedAt(now());
        $history->setUpdatedAt(now());
        $history->setIdentifier($block->getIdentifier());
        $history->setTitle($block->getTitle());
        $history->save();
        $history->updateVersion();
    }


}
