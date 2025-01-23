<?php
/**
 *
 * @category   	B3it
 * @package    	B3it_CmsHistory
 * @copyright  	Copyright (c) 2024 B3 It Systeme GmbH - http://www.b3-it.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class B3it_CmsHistory_Block_Adminhtml_History_Block_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('history_blockGrid');
      $this->setDefaultSort('history_block_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

    protected function _getModel(){
        return Mage::registry('cms_block');
    }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('b3it_cmshistory/history_block')->getCollection();
      $this->setCollection($collection);

      $tmp = ['id','title', 'identifier', 'content', 'version', 'status','created_at','user'];
      $cols = [];
      foreach ($tmp as $item) {
          $cols['history_'.$item] = $item;
      }

      $collection->getSelect()
          ->reset(Zend_Db_Select::COLUMNS)
          ->columns($cols)
          ->where('block_id=?',  $this->_getModel()->getId());

      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {


//      $this->addColumn('history_title', array(
//          'header'    => Mage::helper('b3it_cmshistory')->__('Title'),
//          //'align'     =>'left',
//          //'width'     => '150px',
//          'index'     => 'history_title',
//          'filter_index'     => 'title',
//      ));

      $this->addColumn('history_identifier', array(
          'header'    => Mage::helper('b3it_cmshistory')->__('Identifier'),
          //'align'     =>'left',
          //'width'     => '150px',
          'index'     => 'history_identifier',
          'filter_index'     => 'identifier',
      ));


      $this->addColumn('history_content', [
          'header'    => Mage::helper('egovs_modelhistory')->__('Diff'),
          'align'     =>'left',
          'index'     => 'history_content',
//          'width'     => '150px',
          'renderer'  => 'b3it_cmshistory/adminhtml_widget_grid_column_renderer_diff',
          'column_css_class' => 'finediff',
          'short_diff' => false
      ]);

      $this->addColumn('history_version', array(
          'header'    => Mage::helper('b3it_cmshistory')->__('Version'),
          //'align'     =>'left',
          //'width'     => '150px',
          'index'     => 'history_version',
          'filter_index'     => 'version',
      ));

//      $this->addColumn('status', array(
//          'header'    => Mage::helper('b3it_cmshistory')->__('Status'),
//          //'align'     =>'left',
//          //'width'     => '150px',
//          'index'     => 'status',
//      ));

//      $this->addColumn('content', array(
//          'header'    => Mage::helper('b3it_cmshistory')->__('Content'),
//          //'align'     =>'left',
//          //'width'     => '150px',
//          'index'     => 'content',
//      ));
//
//      $this->addColumn('diff', array(
//          'header'    => Mage::helper('b3it_cmshistory')->__('Diff'),
//          //'align'     =>'left',
//          //'width'     => '150px',
//          'index'     => 'diff',
//      ));

      $this->addColumn('user', array(
          'header'    => Mage::helper('b3it_cmshistory')->__('User'),
          //'align'     =>'left',
          //'width'     => '150px',
          'index'     => 'history_user',
          'filter_index'     => 'user',
      ));


		$this->addColumn('created_at', array(
          'header'    => Mage::helper('b3it_cmshistory')->__('Created At'),
          //'align'     =>'left',
          //'width'     => '150px',
          'type' => 'Datetime',
          'index'     => 'history_created_at',
          'filter_index'     => 'created_at',
		));
//		$this->addColumn('updated_at', array(
//          'header'    => Mage::helper('b3it_cmshistory')->__('Updated At'),
//          //'align'     =>'left',
//          //'width'     => '150px',
//          'type' => 'Datetime',
//          'index'     => 'updated_at',
//		));
      $this->addColumn('action',
          array(
              'header'    =>  Mage::helper('b3it_cmshistory')->__('Action'),
              'width'     => '100',
              'type'      => 'action',
              'getter'    => 'getHistoryId',
              'actions'   => array(
                  array(
                      'caption'   => Mage::helper('b3it_cmshistory')->__('Restore'),
                      'url'       => array('base'=> '*/cmshistory_history_block/restore', 'params' => ['block_id' => $this->_getModel()->getId()]),
                      'field'     => 'history_block_id'
                  ),
              ),
              'filter'    => false,
              'sortable'  => false,
              'index'     => 'stores',
              'is_system' => true,
          ));
      $this->addColumn('action2',
          array(
              'header'    =>  Mage::helper('b3it_cmshistory')->__('Action'),
              'width'     => '100',
              'type'      => 'action',
              'getter'    => 'getHistoryId',
              'actions'   => array(
                  array(
                      'caption'   => Mage::helper('b3it_cmshistory')->__('Delete'),
                      'url'       => array('base'=> '*/cmshistory_history_block/delete', 'params' => ['block_id' => $this->_getModel()->getId()]),
                      'field'     => 'history_block_id'
                  )
              ),
              'filter'    => false,
              'sortable'  => false,
              'index'     => 'stores',
              'is_system' => true,
          ));



      return parent::_prepareColumns();
  }



    public function xgetGridUrl()
    {
        return $this->getUrl('*/cmshistory_history_block/grid', array('_current' => true));
    }




}
