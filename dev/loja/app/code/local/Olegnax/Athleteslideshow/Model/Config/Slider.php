<?php
/**
 * @version   1.0 12.0.2012
 * @author    Olegnax http://www.olegnax.com <mail@olegnax.com>
 * @copyright Copyright (C) 2010 - 2012 Olegnax
 */

class Olegnax_Athleteslideshow_Model_Config_Slider
{
    public function toOptionArray()
    {
	    $options = array();
	    $options[] = array(
            'value' => 'athlete',
            'label' => 'Athlete slider',
        );
        if(Mage::helper('athleteslideshow')->isRevoulutionActive())
		{
			$options[] = array(
            'value' => 'revolution',
            'label' => 'Revolution Slider',
			);
		}        

        return $options;
    }

}
