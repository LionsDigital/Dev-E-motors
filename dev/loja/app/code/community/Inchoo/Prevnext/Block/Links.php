<?php
/**
 * INCHOO's FREE EXTENSION DISCLAIMER
 *
 * Please do not edit or add to this file if you wish to upgrade Magento
 * or this extension to newer versions in the future.
 *
 * Inchoo developers (Inchooer's) give their best to conform to
 * "non-obtrusive, best Magento practices" style of coding.
 * However, Inchoo does not guarantee functional accuracy of specific
 * extension behavior. Additionally we take no responsibility for any
 * possible issue(s) resulting from extension usage.
 *
 * We reserve the full right not to provide any kind of support for our free extensions.
 *
 * You are encouraged to report a bug, if you spot any,
 * via sending an email to bugreport@inchoo.net. However we do not guaranty
 * fix will be released in any reasonable time, if ever,
 * or that it will actually fix any issue resulting from it.
 *
 * Thank you for your understanding.
 */

/**
 * @category Inchoo
 * @package Inchoo_Prevnext
 * @author Branko Ajzele <ajzele@gmail.com, http://foggyline.net>
 * @copyright Inchoo <http://inchoo.net>
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Prevnext_Block_Links extends Mage_Core_Block_Template
{
    protected function _construct()
    {
        parent::_construct();
    }
    
    /**
     * @return Mage_Catalog_Model_Product
     */
    public function getPreviousProduct()
    {
        return $this->helper('inchoo_prevnext')->getPreviousProduct();
    }

    /**
     * @return Mage_Catalog_Model_Product
     */
    public function getNextProduct()
    {
        return $this->helper('inchoo_prevnext')->getNextProduct();
    }    
}
