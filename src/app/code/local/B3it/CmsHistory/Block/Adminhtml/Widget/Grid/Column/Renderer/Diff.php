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

        $sum = $this->getSummary($oldValue,$opCodes);
        return "<details><summary><span>{$sum}</span></summary><pre>{$html}</pre></details>";
    }

    private function getSummary($from, $opcodes)
    {
        $result = [];
        $opcodes_len = strlen($opcodes);
        $from_offset = $opcodes_offset = 0;
        while ($opcodes_offset < $opcodes_len) {
            $opcode = substr($opcodes, $opcodes_offset, 1);
            $opcodes_offset++;
            $n = intval(substr($opcodes, $opcodes_offset));
            if ($n) {
                $opcodes_offset += strlen(strval($n));
            } else {
                $n = 1;
            }
            if ($opcode === 'c') { // copy n characters from source
//                $result[] = "++".substr($from, $from_offset,$n);
                $from_offset += $n;
            } else if ($opcode === 'd') { // delete n characters from source
                $result[] = "<del>".htmlentities(substr($from, $from_offset,$n),ENT_COMPAT)."</del>";
                $from_offset += $n;
            } else /* if ( $opcode === 'i' ) */ { // insert n characters from opcodes
                $result[] = "<ins>".htmlentities(substr($opcodes, $opcodes_offset+1,$n),ENT_COMPAT)."</ins>";
                $opcodes_offset += 1 + $n;
            }
        }

        return implode(", ",$result);
    }
}
