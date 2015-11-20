<?php

/**
 * Copyright (c) 2015 sippsolutions
 * All rights reserved
 *
 * This product includes proprietary software developed at sippsolutions
 * For more information see http://www.sippsolutions.de/
 */

/**
 * Size selector functionality for reCAPTCHA.
 *
 * @category   Sippsolutions
 * @package    Sippsolutions_Recaptcha
 * @subpackage Model
 * @author     Simon Sippert <s.sippert@sippsolutions.de>
 * @copyright  Copyright (c) 2015 sippsolutions (http://www.sippsolutions.de)
 * @version    1.0.0
 * @link       http://www.sippsolutions.de/
 */
class Sippsolutions_Recaptcha_Model_Source_Size
{
    /**
     * Get available options
     *
     * @return array
     */
    public function toOptionArray()
    {
        /** @var $helper Sippsolutions_Recaptcha_Helper_Data */
        $helper = Mage::helper('sippsolutions_recaptcha');

        return array(
            array('value' => 'normal', 'label' => $helper->__('Normal')),
            array('value' => 'compact', 'label' => $helper->__('Compact')),
        );
    }
}
