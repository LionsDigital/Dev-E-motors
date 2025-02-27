<?php
/**
 * @version   1.0 12.0.2012
 * @author    Olegnax http://www.olegnax.com <mail@olegnax.com>
 * @copyright Copyright (C) 2010 - 2012 Olegnax
 */

class Olegnax_Athleteslideshow_Block_Adminhtml_Athleteslideshow_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('athleteslideshow_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('athleteslideshow')->__('Athlete Slide Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('athleteslideshow')->__('Athlete Slide Information'),
          'title'     => Mage::helper('athleteslideshow')->__('Athlete Slide Information'),
          'content'   => $this->getLayout()->createBlock('athleteslideshow/adminhtml_athleteslideshow_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}