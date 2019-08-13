<?php

class Olegnax_Ajaxcart_Block_Cart_Item_Renderer extends Mage_Checkout_Block_Cart_Item_Renderer
{

    /**
     * Get item delete url
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        if ($this->hasDeleteUrl())
		{				
            return $this->getData('delete_url');
        }
		$url = $this->getUrl('checkout/cart/delete', array('id'=>$this->getItem()->getId(), Mage_Core_Controller_Front_Action::PARAM_NAME_URL_ENCODED => $this->helper('core/url')->getEncodedUrl(Mage::getSingleton('core/session', array('name' => 'frontend'))->getData('oxajax_referrer'))));		
		if(strpos($url, '__SID') !== false)
		{
			$url = preg_replace_callback('#(\?|&amp;|&)___SID=([SU])(&amp;|&)?#', array(Mage::getModel('core/url'), "sessionVarCallback"), $url);
		}		
        return $url;
    }

}
