<?php
/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class B3it_CmsHistory_Model_Resource_History_Page extends Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        // Note that the id refers to the key field in your database table.
        $this->_init('b3it_cmshistory/history_page', 'id');
    }

    public function updateVersion($object)
    {
        if($object){
            $exp = new Zend_Db_Expr("(SELECT MAX(version)+1 FROM {$this->getMainTable()} WHERE page_id= {$object->getPageId()})");
            $this->_getWriteAdapter()->update($this->getMainTable(), ['version' => $exp], 'id=' . $object->getId());
        }
    }
}
