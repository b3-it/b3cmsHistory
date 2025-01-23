<?php
/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class B3it_CmsHistory_Block_Adminhtml_History_Block extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_history_block';
        $this->_blockGroup = 'b3it_cmshistory';
        $this->_headerText = Mage::helper('cms')->__('History');
//        $this->_addButtonLabel = Mage::helper('cms')->__('Add New Block');

        parent::__construct();
        $this->removeButton('add');
    }

}
