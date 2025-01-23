<?php

/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class  B3it_CmsHistory_Block_Adminhtml_Widget_Grid_Column_Renderer_Diff extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{

    public function render(Varien_Object $row)
    {
//        $newValue = $this->_getValue($row);

        $newValue = $row->getData('history_content');
        $oldValue = $row->getData('history_orig_content');

        $config = $this->getColumn()->getConfig();
        $shortDiff = $this->getColumn()->getShortDiff();


        $opCodes = FineDiff::getDiffOpcodes($oldValue, $newValue, $config ? FineDiff::$characterGranularity : FineDiff::$paragraphGranularity);

        // need to make the section pre formatted to keep the spaced from pretty print
        $html = FineDiff::renderDiffToHTMLFromOpcodes($oldValue, $opCodes);

        // deletion does insert new line character
        $html = str_replace('\r', "\r", $html);
        $html = str_replace('\n', "\n", $html);

        return "<pre>" . $html . "</pre>";
    }
}
