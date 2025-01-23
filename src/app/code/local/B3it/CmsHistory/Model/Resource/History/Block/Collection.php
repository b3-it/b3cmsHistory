<?php
/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class B3it_CmsHistory_Model_Resource_History_Block_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('b3it_cmshistory/history_block');
    }
}
