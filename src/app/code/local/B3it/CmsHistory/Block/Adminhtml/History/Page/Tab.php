<?php
/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class B3it_CmsHistory_Block_Adminhtml_History_Page_Tab
extends Mage_Adminhtml_Block_Widget_Grid_Container
implements Mage_Adminhtml_Block_Widget_Tab_Interface
{


    public function __construct()
    {
        $this->_controller = 'adminhtml_history_page';
        $this->_blockGroup = 'b3it_cmshistory';
        $this->_headerText = Mage::helper('b3it_cmshistory')->__('History');
        parent::__construct();


        $this->removeButton('add');

    }



    /**
     * Retrieve tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('b3it_cmshistory')->__('History');
    }

    /**
     * Retrieve tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('b3it_cmshistory')->__('History');
    }

    /**
     * Check whether can show tab
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Check whether tab is hidden
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
